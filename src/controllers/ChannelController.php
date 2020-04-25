<?php

/**
 * @author @thisismahabadi
 */
class ChannelController extends Controller
{
    /**
     * Get the channel's info.
     *
	 * @see src/models/slack/Channel::getInfo(string|null $params)
     */
    public function getInfo()
    {
        try {
            $channelInfo = $this->setModel('Channel')->getInfo($_GET['channel']);
            return $this->setView('channel-info', ['channelInfo' => $channelInfo]);
        } catch (Exception $e) {
            return $this->setView('channel-info', ['error' => $e]);
        }
    }

    /**
     * Get the channel's messages.
     *
	 * @see src/models/slack/Channel::getMessages(string|null $params)
     */
    public function getMessages()
    {
        try {
            $channelMessages = $this->setModel('Channel')->getMessages($_GET['channel']);
            return $this->setView('channel-messages', ['channelMessages' => $channelMessages]);
        } catch (Exception $e) {
            return $this->setView('channel-messages', ['error' => $e]);
        }
    }

    /**
     * Get the channels list.
     *
	 * @see src/models/slack/Channel::getList()
     */
    public function getList()
    {
        try {
            $channels = $this->setModel('Channel')->getList();
            return $this->setView('channels-list', ['channels' => $channels]);
        } catch (Exception $e) {
            return $this->setView('channels-list', ['error' => $e]);
        }
    }

    /**
     * Join to a channel.
     *
	 * @see src/models/slack/Channel::joinTo(string|null $params)
     *
	 * @return void
     */
    public function joinTo(): void
    {
        try {
            $channelInfo = $this->setModel('Channel')->joinTo($_GET['channelName']);
            die(json_encode($channelInfo));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    /**
     * Leave from a channel.
     *
	 * @see src/models/slack/Channel::leaveFrom(string|null $params)
     *
	 * @return void
     */
    public function leaveFrom(): void
    {
        try {
            $channelInfo = $this->setModel('Channel')->leaveFrom($_GET['channel']);
            die(json_encode($channelInfo));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }
}
