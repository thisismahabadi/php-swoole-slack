<?php

require '../BaseModel.php';

class SendMessage extends BaseModel implements BaseInterface
{
	public $url = 'https://slack.com/api/chat.postMessage?';

	public function response($params = null) {
		$data = '&channel=' . $params['channel'];
		$data .= '&text=' . $params['text'];

		return $this->fetchData($this->url, $data);
	}
}

function sendMessage() {
	$message = (new SendMessage)->response($_POST);

	print_r($message);
}

sendMessage();
