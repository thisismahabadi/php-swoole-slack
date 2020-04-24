<?php

require '../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class ChannelInfo extends BaseModel
{
	/**
     * The Slack api url for getting channels info.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/channels.info?';

    /**
     * Preparing data for making request to Slack api.
     *
     * @param array|string|null $params
	 * 
	 * @return null|object
     */
	public function response($params = null): ?object
	{
		try {
			if (! $params) {
				throw new Exception("Send channel as parameter.");
			}

			$params = '&channel=' . $params;

			return $this->fetchData($this->url, $params);
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}

function getInfo()
{
	try {
		$channelInfo = (new ChannelInfo)->response($_GET['channel']);
		die(json_encode($channelInfo));
	} catch (Exception $e) {
		echo $e->getMessage(); die;
	}
}

getInfo();
