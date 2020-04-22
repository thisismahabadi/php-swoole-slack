<?php

require '../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class DeleteMessage extends BaseModel implements BaseInterface
{
	/**
     * The Slack api url for deleting chat.
     *
     * @var string
     */
	public $url = 'https://slack.com/api/chat.delete?';

    /** @inheritdoc */
	public function response($params = null): object
	{
		$data = '&channel=' . $params['channel'];
		$data .= '&ts=' . $params['ts'];

		return $this->fetchData($this->url, $data);
	}
}

function deleteMessage()
{
	$message = (new DeleteMessage)->response($_GET);

	print_r($message);
}

deleteMessage();
