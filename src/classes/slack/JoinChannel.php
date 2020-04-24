<?php

require __DIR__ . '/../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class JoinChannel extends BaseModel
{
	/**
     * The Slack api url for joining to channels.
     *
     * @var string
     */
	protected $url = 'https://slack.com/api/channels.join?';

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
				throw new Exception("Send name as parameter.");
			}

			$params = '&name=' . $params;

			return $this->fetchData($this->url, $params);
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}
