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
	public function response($params = null): ?object
	{
		try {
			if (! $params) {
				throw new Exception("Send name as parameter.");
			}

			$params = '&name=' . $params;

			return $this->fetchData($this->url, $params);
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}

function joinChannel()
{
	try {
		$channelInfo = (new JoinChannel)->response($_GET['channelName']);
		die(json_encode($channelInfo));
	} catch (Exception $e) {
		echo $e->getMessage(); die;
	}
}

joinChannel();
