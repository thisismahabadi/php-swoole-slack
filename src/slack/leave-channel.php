<?php

require '../BaseModel.php';

class LeaveChannel extends BaseModel implements BaseInterface
{
	public $url = 'https://slack.com/api/channels.leave?';

	public function response($params = null) {
		$params = '&channel=' . $params;

		return $this->fetchData($this->url, $params);
	}
}

function leaveChannel() {
	$channelInfo = (new LeaveChannel)->response($_GET['channel']);

	print_r($channelInfo);
}

leaveChannel();
