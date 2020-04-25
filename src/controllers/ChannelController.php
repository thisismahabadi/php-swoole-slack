<?php

/**
 * @author @thisismahabadi
 */
class ChannelController extends Controller
{
    /**
     * Get the channels list.
     *
	 * @see src/models/slack/ChannelsList::response()
     */
    public function getList()
    {
        try {
            $channels = $this->model('ChannelsList')->response();
            return $this->view('channels-list', ['channels' => $channels]);
        } catch (Exception $e) {
            return $this->view('channels-list', ['error' => $e]);
        }
    }

    /**
     * Get the channel's info.
     *
	 * @see src/models/slack/ChannelInfo::response(array|string|null $params)
     */
    public function getInfo()
    {
        try {
            $channelInfo = $this->model('ChannelInfo')->response($_GET['channel']);
            return $this->view('channel-info', ['channelInfo' => $channelInfo]);
        } catch (Exception $e) {
            return $this->view('channel-info', ['error' => $e]);
        }
    }

    /**
     * Get the channel's messages.
     *
	 * @see src/models/slack/ChannelMessages::response(array|string|null $params)
     */
    public function getMessages()
    {
        try {
            $channelMessages = $this->model('ChannelMessages')->response($_GET['channel']);
            return $this->view('channel-messages', ['channelMessages' => $channelMessages]);
        } catch (Exception $e) {
            return $this->view('channel-messages', ['error' => $e]);
        }
    }

    /**
     * Join to a channel.
     *
	 * @see src/models/slack/JoinChannel::response(array|string|null $params)
     *
	 * @return void
     */
    public function joinChannel(): void
    {
        try {
            $channelInfo = $this->model('JoinChannel')->response($_GET['channelName']);
            die(json_encode($channelInfo));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    /**
     * Leave from a channel.
     *
	 * @see src/models/slack/LeaveChannel::response(array|string|null $params)
     *
	 * @return void
     */
    public function leaveChannel(): void
    {
        try {
            $channelInfo = $this->model('LeaveChannel')->response($_GET['channel']);
            die(json_encode($channelInfo));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }
}
