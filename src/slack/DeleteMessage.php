<?php

require '../BaseModel.php';

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
	public $url = 'https://slack.com/api/chat.delete?';

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
			if (! $params['channel'] || ! $params['ts']) {
				throw new Exception("Send channel and ts as parameters.");
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&ts=' . $params['ts'];

			return $this->fetchData($this->url, $data);
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}

function deleteMessage()
{
	try {
		$message = (new DeleteMessage)->response($_GET);
		die(json_encode($message));
	} catch (Exception $e) {
		echo $e->getMessage(); die;
	}
}

deleteMessage();
