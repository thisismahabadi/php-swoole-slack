<?php

require '../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class JoinChannel extends BaseModel implements BaseInterface
{
	/**
     * The Slack api url for joining to channels.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/channels.join?';

    /** @inheritdoc */
	public function response($params = null)
	{
		$params = '&name=' . $params;

		return $this->fetchData($this->url, $params);
	}
}

function joinChannel()
{
	$channelInfo = (new JoinChannel)->response($_GET['channelName']);

	print_r($channelInfo);
}

joinChannel();
