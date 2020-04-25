<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Channel Messages</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<a href="/channels">&#8592; Back</a>
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
					<?php foreach ($params['channelMessages'] as $key) { ?>
						<tr>
							<td><?= $key->user ?? $key->username ?></td>
							<td><?= $key->text ?></td>
							<td><button class="btn btn-danger deleteMessage" data-ts="<?= $key->ts ?>">Remove this message.</button></td>
		                    <td><?= '<a class="btn btn-primary" target="_blank" href="/messages/thread?channel=' . $_GET['channel'] . '&thread=' . $key->ts . '">Reply to this message and create or continue thread.</a>' ?></td>
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
		sendWs = new WebSocket('ws:127.0.0.1:9502');
		deleteWs = new WebSocket('ws:127.0.0.1:9504');

		sendWs.onopen = function() {
			console.log('User has been connected.');
		}

		sendWs.onmessage = function(event) {
			console.log('There is a new message.');
			$('tbody').append(
				`<tr>
					<td>${JSON.parse(event.data).message.user ?? JSON.parse(event.data).message.username}</td>
					<td>${JSON.parse(event.data).message.text}</td>
					<td><button class="btn btn-danger deleteMessage" data-ts="${JSON.parse(event.data).ts}">Remove this message.</button></td>
					<td><a class="btn btn-primary" target="_blank" href="/messages/thread?channel=${JSON.parse(event.data).channel}&thread=${JSON.parse(event.data).ts}">Reply to this message and create or continue thread.</a></td>
				</tr>`
			);
		}

		deleteWs.onmessage = function(event) {
			console.log('Message has been deleted.');
			const tr = JSON.parse(event.data).ts;
			$(`[data-ts='${tr}']`).parent().parent().remove();
		}

		sendWs.onclose = function(event) {
			console.log('User has been disconnected.');
		}

		$('#sendButton').click(function(e) {
			e.preventDefault();
            $.ajax({
                url: '/messages/send',
                data: {
					channel: '<?= $_GET['channel'] ?>',
					text: encodeURI($('#text').val())
                },
                type: 'post',
                dataType: 'json',
                success: function(result) {
					sendWs.send(JSON.stringify(result));
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
				url: '/messages/delete',
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
