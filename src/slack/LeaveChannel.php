<?php

require '../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class LeaveChannel extends BaseModel implements BaseInterface
{
	/**
     * The Slack api url for leaving channels.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/channels.leave?';

    /** @inheritdoc */
	public function response($params = null): object
	{
		$params = '&channel=' . $params;

		return $this->fetchData($this->url, $params);
	}
}

function leaveChannel()
{
	$channelInfo = (new LeaveChannel)->response($_GET['channel']);

	print_r($channelInfo);
}

leaveChannel();
