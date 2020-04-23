<?php

require '../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class SendMessage extends BaseModel implements BaseInterface
{
	/**
     * The Slack api url for sending chat message.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/chat.postMessage?';

    /** @inheritdoc */
	public function response($params = null): ?object
	{
		try {
			if (! $params['text'] || ! $params['channel']) {
				throw new Exception('Send both text and channel as parameters.');
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&text=' . $params['text'];

			return $this->fetchData($this->url, $data);
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}

function sendMessage()
{
	try {
		$message = (new SendMessage)->response($_POST);
		die(json_encode($message));
	} catch (Exception $e) {
		echo $e->getMessage(); die;
	}
}

sendMessage();
