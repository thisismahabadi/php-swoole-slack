<?php

require '../BaseModel.php';

class ReplyMessage extends BaseModel implements BaseInterface
{
	public $url = 'https://slack.com/api/chat.postMessage?';

	public function response($params = null) {
		$data = '&channel=' . $params['channel'];
		$data .= '&text=' . $params['text'];
		$data .= '&thread_ts=' . $params['thread'];

		return $this->fetchData($this->url, $data);
	}
}

function replyMessage() {
	$message = (new ReplyMessage)->response($_POST);

	print_r($message);
}

replyMessage();
