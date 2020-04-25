<?php

class ChannelController extends Controller
{
    public function getList()
    {
        try {
            $channels = $this->model('ChannelsList')->response();
            return $this->view('channels-list', ['channels' => $channels]);
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    public function getInfo()
    {
        try {
            $channelInfo = $this->model('ChannelInfo')->response($_GET['channel']);
            return $this->view('channel-info', ['channelInfo' => $channelInfo]);
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    public function getMessages(): ?array
    {
        try {
            $channelMessages = $this->model('ChannelMessages')->response($_GET['channel']);
            return $this->view('channel-messages', ['channelMessages' => $channelMessages]);
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    public function joinChannel()
    {
        try {
            $channelInfo = $this->model('JoinChannel')->response($_GET['channelName']);
            die(json_encode($channelInfo));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    public function leaveChannel()
    {
        try {
            $channelInfo = $this->model('LeaveChannel')->response($_GET['channel']);
            die(json_encode($channelInfo));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }
}
