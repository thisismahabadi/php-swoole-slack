<?php

require '../BaseModel.php';

class JoinChannel extends BaseModel implements BaseInterface
{
	public $url = 'https://slack.com/api/channels.join?';

	public function response($params = null) {
		$params = '&name=' . $params;

		return $this->fetchData($this->url, $params);
	}
}

function joinChannel() {
	$channelInfo = (new JoinChannel)->response($_GET['channelName']);

	print_r($channelInfo);
}

joinChannel();
