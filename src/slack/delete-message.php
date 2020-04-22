<?php

require '../BaseModel.php';

class DeleteMessage extends BaseModel implements BaseInterface
{
	public $url = 'https://slack.com/api/chat.delete?';

	public function response($params = null) {
		$data = '&channel=' . $params['channel'];
		$data .= '&ts=' . $params['ts'];

		return $this->fetchData($this->url, $data);
	}
}

function deleteMessage() {
	$message = (new DeleteMessage)->response($_GET);

	print_r($message);
}

deleteMessage();
