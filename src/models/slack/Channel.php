<?php

require_once __DIR__ . '/../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class Channel extends BaseModel
{
	/**
     * The Slack api url for getting channels info.
     *
     * @var string
     */
	protected $channelInfoUrl = 'https://slack.com/api/channels.info?';

	/**
     * The Slack api url for getting conversations history.
     *
     * @var string
     */
	protected $channelMessagesUrl = 'https://slack.com/api/conversations.history?';

    /**
     * The Slack api url for getting channels list.
     *
     * @var string
     */
	protected $channelsListUrl = 'https://slack.com/api/channels.list?';

    /**
     * The Slack api url for joining to channels.
     *
     * @var string
     */
	protected $joinToChannelUrl = 'https://slack.com/api/channels.join?';

    /**
     * The Slack api url for leaving channels.
     *
     * @var string
     */
	protected $leaveFromChannelUrl = 'https://slack.com/api/channels.leave?';

    /**
     * Preparing data for making request to Slack api.
     *
	 * @throws \Exception
     *
     * @param string|null $params
	 * 
	 * @return null|object
     */
	public function getInfo(string $params = null): ?object
	{
		try {
			if (! $params) {
				throw new Exception("Send channel as parameter.");
			}

			$params = '&channel=' . $params;

			return $this->fetchData($this->channelInfoUrl, $params);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}

    /**
     * Preparing data for making request to Slack api.
     *
	 * @throws \Exception
	 *
     * @param string|null $params
	 * 
	 * @return null|array
     */
	public function getMessages(string $params = null): ?array
	{
		try {
			if (! $params) {
				throw new Exception("Send channel as parameter.");
			}

			$params = '&channel=' . $params;

			return array_reverse($this->fetchData($this->channelMessagesUrl, $params)->messages);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}

    /**
     * Preparing data for making request to Slack api.
     *
	 * @throws \Exception
	 *
	 * @return null|array
     */
	public function getList(): ?array
	{
		try {
			return $this->fetchData($this->channelsListUrl)->channels;
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}

    /**
     * Preparing data for making request to Slack api.
     *
	 * @throws \Exception
	 *
     * @param string|null $params
	 * 
	 * @return null|object
     */
	public function joinTo(string $params = null): ?object
	{
		try {
			if (! $params) {
				throw new Exception("Send name as parameter.");
			}

			$params = '&name=' . $params;

			return $this->fetchData($this->joinToChannelUrl, $params);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}

    /**
     * Preparing data for making request to Slack api.
     *
	 * @throws \Exception
	 *
     * @param string|null $params
	 * 
	 * @return null|object
     */
	public function leaveFrom(string $params = null): ?object
	{
		try {
			if (! $params) {
				throw new Exception("Send channel as parameter.");
			}

			$params = '&channel=' . $params;

			return $this->fetchData($this->leaveFromChannelUrl, $params);
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}
}
