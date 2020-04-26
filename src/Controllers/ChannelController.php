<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Slack\Channel;

/**
 * @author @thisismahabadi
 */
class ChannelController extends Controller
{
    /**
     * Get the channel's info.
     *
	 * @see src/Models/Slack/Channel::getInfo(string|null $params)
     */
    public function getInfo()
    {
        try {
            $channelInfo = (new Channel)->getInfo($_GET['channel']);
            return $this->setView('channel-info', ['channelInfo' => $channelInfo]);
        } catch (Exception $e) {
            return $this->setView('channel-info', ['error' => $e]);
        }
    }

    /**
     * Get the channel's messages.
     *
	 * @see src/Models/Slack/Channel::getMessages(string|null $params)
     */
    public function getMessages()
    {
        try {
            $channelMessages = (new Channel)->getMessages($_GET['channel']);
            return $this->setView('channel-messages', ['channelMessages' => $channelMessages]);
        } catch (Exception $e) {
            return $this->setView('channel-messages', ['error' => $e]);
        }
    }

    /**
     * Get the channels list.
     *
	 * @see src/Models/Slack/Channel::getList()
     */
    public function getList()
    {
        try {
            $channels = (new Channel)->getList();
            return $this->setView('channels-list', ['channels' => $channels]);
        } catch (Exception $e) {
            return $this->setView('channels-list', ['error' => $e]);
        }
    }

    /**
     * Join to a channel.
     *
	 * @see src/Models/Slack/Channel::joinTo(string|null $params)
     *
	 * @return void
     */
    public function joinTo(): void
    {
        try {
            $channelInfo = (new Channel)->joinTo($_GET['channelName']);
            die(json_encode($channelInfo));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    /**
     * Leave from a channel.
     *
	 * @see src/Models/Slack/Channel::leaveFrom(string|null $params)
     *
	 * @return void
     */
    public function leaveFrom(): void
    {
        try {
            $channelInfo = (new Channel)->leaveFrom($_GET['channel']);
            die(json_encode($channelInfo));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }
}
