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
	public function response($params = null): ?object
	{
		try {
			$params = '&channel=' . $params;

			return $this->fetchData($this->url, $params);
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}

function leaveChannel()
{
	try {
		$channelInfo = (new LeaveChannel)->response($_GET['channel']);
		die(json_encode($channelInfo));
	} catch (Exception $e) {
		echo $e->getMessage(); die;
	}
}

leaveChannel();
