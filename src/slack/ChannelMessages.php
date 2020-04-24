<?php

require '../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class ChannelMessages extends BaseModel implements BaseInterface
{
	/**
     * The Slack api url for getting conversations history.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/conversations.history?';

    /** @inheritdoc */
	public function response($params = null): ?array
	{
		try {
			if (! $params) {
				throw new Exception("Send channel as parameter.");
			}

			$params = '&channel=' . $params;

			return array_reverse($this->fetchData($this->url, $params)->messages);
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}

function getMessages(): ?array
{
	try {
		return (new ChannelMessages)->response($_GET['channel']);
	} catch (Exception $e) {
		echo $e->getMessage(); die;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
</head>
<body>

	<div class="container">
		<div class="row">
			<a href="ChannelsList.php">&#8592; Back</a>
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
						<th>Reply Message</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach (getMessages() as $key) { ?>
						<tr>
							<td><?= $key->user ?? null ?></td>
							<td><?= $key->text ?></td>
							<td><?= '<a class="btn btn-danger"  target="_blank" href="DeleteMessage.php?channel=' . $_GET['channel'] . '&ts=' . $key->ts . '">Remove this message.</a>' ?></td>
		                    <td><?= '<a class="btn btn-primary" target="_blank" href="MessageThread.php?channel=' . $_GET['channel'] . '&thread=' . $key->ts . '">Reply to this message and create or continue thread.</a>' ?></td>
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
				<div class="col-11">
					<input class="form-control" type="text" name="text" id="text" placeholder="Type your message...">
				</div>
				<div class="col-1">
					<button class="btn btn-success" id="sendButton">Send</button>
				</div>
			</div>
		</form>
	</div>

	<br />

	<script>
		ws = new WebSocket('ws:127.0.0.1:9502');

		ws.onopen = function() {
			console.log('User has been connected.');
		}

		ws.onmessage = function(event) {
			console.log('There is a new message.');
			$('tbody').append(
				`<tr>
					<td>${JSON.parse(event.data).message.user ?? ''}</td>
					<td>${JSON.parse(event.data).message.text}</td>
					<td><a class="btn btn-danger" target="_blank" href="DeleteMessage.php?channel=${JSON.parse(event.data).channel}&ts=${JSON.parse(event.data).ts}">Remove this message.</a></td>
					<td><a class="btn btn-primary" target="_blank" href="MessageThread.php?channel=${JSON.parse(event.data).channel}&thread=${JSON.parse(event.data).ts}">Reply to this message and create or continue thread.</a></td>
				</tr>`
			);
		}

		ws.onclose = function(event) {
			console.log('User has been disconnected.');
		}

		$('#sendButton').click(function(e) {
			e.preventDefault();
            $.ajax({
                url: 'SendMessage.php',
                data: {
					channel: '<?= $_GET['channel'] ?>',
					text: $('#text').val()
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
