<?php

require '../BaseModel.php';

class ChannelInfo extends BaseModel implements BaseInterface
{
	public $url = 'https://slack.com/api/channels.info?';

	public function response($params = null) {
		$params = '&channel=' . $params;

		return $this->fetchData($this->url, $params);
	}
}

function getInfo() {
	$channelInfo = (new ChannelInfo)->response($_GET['channel']);

	print_r($channelInfo);
}

getInfo();
