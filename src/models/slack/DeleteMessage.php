<?php

require __DIR__ . '/../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class DeleteMessage extends BaseModel
{
	/**
     * The Slack api url for deleting chat.
     *
     * @var string
     */
	protected $url = 'https://slack.com/api/chat.delete?';

    /**
     * Preparing data for making request to Slack api.
     *
     * @param array|null $params
	 * 
	 * @return null|object
     */
	public function response(array $params = null): ?object
	{
		try {
			if (! $params['channel'] || ! $params['ts']) {
				throw new Exception("Send channel and ts as parameters.");
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&ts=' . $params['ts'];

			return $this->fetchData($this->url, $data);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}
}
