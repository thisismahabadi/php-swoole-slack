<?php

require __DIR__ . '/../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class MessageThread extends BaseModel
{
	/**
     * The Slack api url for getting channels replies.
     *
     * @var string
     */
	protected $url = 'https://slack.com/api/channels.replies?';

    /**
     * Preparing data for making request to Slack api.
     *
     * @param array|null $params
	 * 
	 * @return null|array
     */
	public function response(array $params = null): ?array
	{
		try {
			if (! $params['channel'] || ! $params['thread']) {
				throw new Exception("Send channel and thread as parameters.");
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&thread_ts=' . $params['thread'];

			return $this->fetchData($this->url, $data)->messages;
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}
}
