<?php

require '../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class ChannelInfo extends BaseModel implements BaseInterface
{
	/**
     * The Slack api url for getting channels info.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/channels.info?';

    /** @inheritdoc */
	public function response($params = null): ?object
	{
		$params = '&channel=' . $params;

		return $this->fetchData($this->url, $params);
	}
}

function getInfo()
{
	$channelInfo = (new ChannelInfo)->response($_GET['channel']);

	print_r($channelInfo);
}

getInfo();
