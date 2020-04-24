<?php

require '../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class ChannelsList extends BaseModel
{
	/**
     * The Slack api url for getting channels list.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/channels.list?';

    /**
     * Preparing data for making request to Slack api.
     *
     * @param array|string|null $params
	 * 
	 * @return null|array
     */
	public function response($params = null): ?array
	{
		try {
			return $this->fetchData($this->url)->channels;
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}

function getList(): ?array
{
	try {
		return (new ChannelsList)->response();
	} catch (Exception $e) {
		echo $e->getMessage(); die;
	}
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
					<td><?= '<a class="btn btn-primary" target="_blank" href="ChannelInfo.php?channel=' . $key->id . '">Click to visit channel\'s info.</a>' ?></td>
					<td><?= '<a class="btn btn-danger" target="_blank" href="LeaveChannel.php?channel=' . $key->id . '">Click to leave this channel.</a>' ?></td>
					<td><?= '<a class="btn btn-success" target="_blank" href="JoinChannel.php?channelName=' . $key->name . '">Click to join this channel.</a>' ?></td>
					<td><?= '<a class="btn btn-info" target="_blank" href="ChannelMessages.php?channel=' . $key->id . '">Click here to manage messages in the channel.</a>' ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

</body>
</html>
