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
		$params = '&channel=' . $params;

		return array_reverse($this->fetchData($this->url, $params)->messages);
	}
}

function getMessages(): ?array
{
	return (new ChannelMessages)->response($_GET['channel']);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
					<?php foreach(getMessages() as $key) { ?>
						<tr>
							<td><?= $key->user ?></td>
							<td><?= $key->text ?></td>
							<td><?= '<a class="btn btn-danger" target="_blank" href="DeleteMessage.php?channel=' . $_GET['channel'] . '&ts=' . $key->ts . '">Remove this message.</a>' ?></td>
		                    <td><?= '<a class="btn btn-primary" target="_blank" href="MessageThread.php?channel=' . $_GET['channel'] . '&thread=' . $key->ts . '">Reply to this message and create or continue thread.</a>' ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<hr />

	<div class="container">
		<form method="post" action="SendMessage.php">
			<div class="row">
				<div class="col-11">
					<input class="form-control" type="text" name="text" placeholder="Type your message...">
					<input type="hidden" name="channel" value="<?= $_GET['channel'] ?>">
				</div>
				<div class="col-1">
					<button class="btn btn-success">Send</button>
				</div>
			</div>
		</form>
	</div>

</body>
</html>
