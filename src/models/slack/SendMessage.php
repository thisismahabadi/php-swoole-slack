<?php

require __DIR__ . '/../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class SendMessage extends BaseModel
{
	/**
     * The Slack api url for sending chat message.
     *
     * @var string
     */
	protected $url = 'https://slack.com/api/chat.postMessage?';

    /**
     * Preparing data for making request to Slack api.
     *
	 * @throws \Exception
	 *
     * @param array|null $params
	 * 
	 * @return null|object
     */
	public function response(array $params = null): ?object
	{
		try {
			if (! $params['text'] || ! $params['channel']) {
				throw new Exception('Send both text and channel as parameters.');
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&text=' . $params['text'];

			return $this->fetchData($this->url, $data);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}
}
