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
                            <td><?= $key->user ?? null ?></td>
                            <td><?= $key->text ?></td>
                            <td><?= '<a class="btn btn-danger" target="_blank" href="DeleteMessage.php?channel=' . $_GET['channel'] . '&ts=' . $key->ts . '">Remove this message.</a>' ?></td>
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
		ws = new WebSocket('ws:127.0.0.1:9503');

		ws.onopen = function() {
			console.log('User has been connected.');
		}

		ws.onmessage = function(event) {
			console.log('There is a new reply.');
			$('tbody').append(
				`<tr>
					<td>${JSON.parse(event.data).message.user ?? ''}</td>
					<td>${JSON.parse(event.data).message.text}</td>
					<td><a class="btn btn-danger" target="_blank" href="DeleteMessage.php?channel=${JSON.parse(event.data).channel}&ts=${JSON.parse(event.data).ts}">Remove this message.</a></td>
				</tr>`
			);
		}

		ws.onclose = function(event) {
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
					ws.send(JSON.stringify(result));
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
