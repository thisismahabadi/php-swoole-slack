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
	public $url = 'https://slack.com/api/channels.replies?';

    /**
     * Preparing data for making request to Slack api.
     *
     * @param array|string|null $params
	 * 
	 * @return null|array
     */
	public function response($params = null): ?array
	{
		try {
			if (! $params['channel'] || ! $params['thread']) {
				throw new Exception("Send channel and thread as parameters.");
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&thread_ts=' . $params['thread'];

			return $this->fetchData($this->url, $data)->messages;
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}
