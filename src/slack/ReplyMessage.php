<?php

require '../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class ReplyMessage extends BaseModel implements BaseInterface
{
	/**
     * The Slack api url for replying to chat messages.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/chat.postMessage?';

    /** @inheritdoc */
	public function response($params = null): ?object
	{
		try {
			$data = '&channel=' . $params['channel'];
			$data .= '&text=' . $params['text'];
			$data .= '&thread_ts=' . $params['thread'];

			return $this->fetchData($this->url, $data);
		} catch (Exception $e) {
			echo $e->getMessage(); die;
		}
	}
}

function replyMessage()
{
	try {
		$message = (new ReplyMessage)->response($_POST);

		print_r($message);
	} catch (Exception $e) {
		echo $e->getMessage(); die;
	}
}

replyMessage();
