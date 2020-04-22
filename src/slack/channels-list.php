<?php

require '../BaseModel.php';

class ChannelsList extends BaseModel implements BaseInterface
{
	public $url = 'https://slack.com/api/channels.list?';

	public function response($params = null) {
		return $this->fetchData($this->url)->channels;
	}
}

function getList() {
	return (new ChannelsList)->response();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Channels List</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

	<table class="table">
		<thead>
			<tr>
				<th>Channel Name</th>
				<th>Channel Info</th>
				<th>Leave Channel</th>
				<th>Join Channel</th>
				<th>Messages</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach(getList() as $key) { ?>
				<tr>
					<td><?= $key->name ?></td>
					<td><?= '<a class="btn btn-primary" href="channel-info.php?channel=' . $key->id . '">Click to visit channel\'s info.</a>' ?></td>
					<td><?= '<a class="btn btn-danger" href="leave-channel.php?channel=' . $key->id . '">Click to leave this channel.</a>' ?></td>
					<td><?= '<a class="btn btn-success" href="join-channel.php?channelName=' . $key->name . '">Click to join this channel.</a>' ?></td>
					<td><?= '<a class="btn btn-info" href="channel-messages.php?channel=' . $key->id . '">Click here to manage messages in the channel.</a>' ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

</body>
</html>
