<?php

require __DIR__ . '/../BaseModel.php';

/**
 * @author @thisismahabadi
 */
class ChannelsList extends BaseModel
{
	/**
     * The Slack api url for getting channels list.
     *
     * @var string
     */
	protected $url = 'https://slack.com/api/channels.list?';

    /**
     * Preparing data for making request to Slack api.
     *
	 * @return null|array
     */
	public function response(): ?array
	{
		try {
			return $this->fetchData($this->url)->channels;
		} catch (Exception $e) {
			throw new Exception($e);
		}
	}
}
