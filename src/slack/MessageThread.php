<?php

require '../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class MessageThread extends BaseModel implements BaseInterface
{
	/**
     * The Slack api url for getting channels replies.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/channels.replies?';

    /** @inheritdoc */
	public function response($params = null): ?array
	{
		try {
			if (! $params['channel'] || ! $params['thread']) {
				throw new Exception("Send channel and thread as parameters.");
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&thread_ts=' . $params['thread'];

			return $this->fetchData($this->url, $data)->messages;
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}

function getThread(): ?array
{
	try {
		return (new MessageThread)->response($_GET);
	} catch (Exception $e) {
		echo $e->getMessage(); die;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Replying Message</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
</head>
<body>

    <div class="container">
        <div class="row">
            <a href="ChannelMessages.php?channel=<?= $_GET['channel'] ?>">&#8592; Back</a>
        </div>
    </div>

    <hr />

    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Message</th>
                        <th>Delete Message</th>
                    </tr>
                </thead>
                <tbody>
					<?php foreach(getThread() as $key) { ?>
                        <tr>
                            <td><?= $key->user ?? $key->username ?></td>
                            <td><?= $key->text ?></td>
							<td><button class="btn btn-danger deleteMessage" data-ts="<?= $key->ts ?>">Remove this message.</button></td>
						</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

	<hr />

	<div class="container">
		<form>
			<div class="row">
				<div class="col-10">
					<input class="form-control" type="text" id="text" name="text" placeholder="Type your reply...">
				</div>
				<div class="col-2">
					<button class="btn btn-success" id="replyMessage">Send Reply</button>
				</div>
			</div>
		</form>
	</div>

	<br />

	<script>
		replyWs = new WebSocket('ws:127.0.0.1:9503');
		deleteWs = new WebSocket('ws:127.0.0.1:9504');

		replyWs.onopen = function() {
			console.log('User has been connected.');
		}

		replyWs.onmessage = function(event) {
			console.log('There is a new reply.');
			$('tbody').append(
				`<tr>
					<td>${JSON.parse(event.data).message.user ?? JSON.parse(event.data).message.username}</td>
					<td>${JSON.parse(event.data).message.text}</td>
					<td><button class="btn btn-danger deleteMessage" data-ts="${JSON.parse(event.data).ts}">Remove this message.</button></td>
				</tr>`
			);
		}

		deleteWs.onmessage = function(event) {
			console.log('Message has been deleted.');
			const tr = JSON.parse(event.data).ts;
			$(`[data-ts='${tr}']`).parent().parent().remove();
		}

		replyWs.onclose = function(event) {
			console.log('User has been disconnected.');
		}

		$('#replyMessage').click(function(e) {
			e.preventDefault();
            $.ajax({
                url: 'ReplyMessage.php',
                data: {
					channel: '<?= $_GET['channel'] ?>',
					text: $('#text').val(),
                    thread: '<?= $_GET['thread'] ?>'
                },
                type: 'post',
                dataType: 'json',
                success: function(result) {
					replyWs.send(JSON.stringify(result));
					$('#text').val(null);
                },
                error: function(result) {
					if (result.responseText) {
						alert(result.responseText);
					}

					console.log(result);
                }
            });
		});

		$('tbody').on('click', '.deleteMessage', function(e) {
            $.ajax({
                url: 'DeleteMessage.php',
                data: {
					channel: '<?= $_GET['channel'] ?>',
                    ts: $(this).data('ts')
                },
                type: 'get',
                dataType: 'json',
                success: function(result) {
					deleteWs.send(JSON.stringify(result));
                },
                error: function(result) {
					if (result.responseText) {
						alert(result.responseText);
					}

					console.log(result);
                }
            });
		});
	</script>

</body>
</html>
