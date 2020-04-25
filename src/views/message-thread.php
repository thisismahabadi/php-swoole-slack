<!DOCTYPE html>
<html>
<head>
    <title>Replying Message</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
</head>
<body>
	<a style="color: red"><?= $params['error'] ?></a>
    <div class="container">
        <div class="row">
            <a href="/channels/messages?channel=<?= $_GET['channel'] ?>">&#8592; Back</a>
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
					<?php foreach ($params['messageThread'] as $key) { ?>
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
			const data = JSON.parse(event.data);
			$('tbody').append(
				`<tr>
					<td>${data.message.user ?? data.message.username}</td>
					<td>${data.message.text}</td>
					<td><button class="btn btn-danger deleteMessage" data-ts="${data.ts}">Remove this message.</button></td>
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
                url: '/messages/reply',
                data: {
					channel: '<?= $_GET['channel'] ?>',
					text: encodeURI($('#text').val()),
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
