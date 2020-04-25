<?php

require __DIR__ . '/../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class ChannelMessages extends BaseModel
{
	/**
     * The Slack api url for getting conversations history.
     *
     * @var string
     */
	protected $url = 'https://slack.com/api/conversations.history?';

    /**
     * Preparing data for making request to Slack api.
     *
     * @param string|null $params
	 * 
	 * @return null|array
     */
	public function response(string $params = null): ?array
	{
		try {
			if (! $params) {
				throw new Exception("Send channel as parameter.");
			}

			$params = '&channel=' . $params;

			return array_reverse($this->fetchData($this->url, $params)->messages);
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}
