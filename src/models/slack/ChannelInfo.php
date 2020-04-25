<?php

require __DIR__ . '/../BaseModel.php';

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
	protected $url = 'https://slack.com/api/channels.info?';

    /**
     * Preparing data for making request to Slack api.
     *
     * @param string|null $params
	 * 
	 * @return null|object
     */
	public function response(string $params = null): ?object
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
