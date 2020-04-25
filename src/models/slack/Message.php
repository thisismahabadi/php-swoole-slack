<?php

require_once __DIR__ . '/../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class Message extends BaseModel
{
	/**
     * The Slack api url for deleting chat.
     *
     * @var string
     */
	protected $deleteMessageUrl = 'https://slack.com/api/chat.delete?';

    /**
     * The Slack api url for getting channels replies.
     *
     * @var string
     */
	protected $messageThreadUrl = 'https://slack.com/api/channels.replies?';

    /**
     * The Slack api url for replying to chat messages.
     *
     * @var string
     */
	protected $replyMessageUrl = 'https://slack.com/api/chat.postMessage?';

    /**
     * The Slack api url for sending chat message.
     *
     * @var string
     */
	protected $sendMessageUrl = 'https://slack.com/api/chat.postMessage?';

    /**
     * Preparing data for making request to Slack api.
     *
	 * @throws \Exception
	 *
     * @param array|null $params
	 * 
	 * @return null|object
     */
	public function delete(array $params = null): ?object
	{
		try {
			if (! $params['channel'] || ! $params['ts']) {
				throw new Exception("Send channel and ts as parameters.");
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&ts=' . $params['ts'];

			return $this->fetchData($this->deleteMessageUrl, $data);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}

    /**
     * Preparing data for making request to Slack api.
     *
	 * @throws \Exception
	 *
     * @param array|null $params
	 * 
	 * @return null|array
     */
	public function getThread(array $params = null): ?array
	{
		try {
			if (! $params['channel'] || ! $params['thread']) {
				throw new Exception("Send channel and thread as parameters.");
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&thread_ts=' . $params['thread'];

			return $this->fetchData($this->messageThreadUrl, $data)->messages;
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}

    /**
     * Preparing data for making request to Slack api.
     *
	 * @throws \Exception
	 *
     * @param array|null $params
	 * 
	 * @return null|object
     */
	public function reply(array $params = null): ?object
	{
		try {
			if (! $params['channel'] || ! $params['text'] || ! $params['thread']) {
				throw new Exception('Send all text, channel and thread as parameters.');
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&text=' . $params['text'];
			$data .= '&thread_ts=' . $params['thread'];

			return $this->fetchData($this->replyMessageUrl, $data);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}

    /**
     * Preparing data for making request to Slack api.
     *
	 * @throws \Exception
	 *
     * @param array|null $params
	 * 
	 * @return null|object
     */
	public function send(array $params = null): ?object
	{
		try {
			if (! $params['text'] || ! $params['channel']) {
				throw new Exception('Send both text and channel as parameters.');
			}

			$data = '&channel=' . $params['channel'];
			$data .= '&text=' . $params['text'];

			return $this->fetchData($this->sendMessageUrl, $data);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}
}
