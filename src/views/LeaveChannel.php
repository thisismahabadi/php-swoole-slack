<?php
    require __DIR__ . '/../classes/slack/LeaveChannel.php';

    function leaveChannel()
    {
        try {
            $channelInfo = (new LeaveChannel)->response($_GET['channel']);
            die(json_encode($channelInfo));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    leaveChannel();
?>
