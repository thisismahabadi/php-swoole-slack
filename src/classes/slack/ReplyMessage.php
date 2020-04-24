<?php

require __DIR__ . '/../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class ReplyMessage extends BaseModel
{
	/**
     * The Slack api url for replying to chat messages.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/chat.postMessage?';

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
			if (! $params['channel'] || ! $params['text'] || ! $params['thread']) {
				throw new Exception('Send all text, channel and thread as parameters.');
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&text=' . $params['text'];
			$data .= '&thread_ts=' . $params['thread'];

			return $this->fetchData($this->url, $data);
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}
