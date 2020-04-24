<?php
    require __DIR__ . '/../classes/slack/JoinChannel.php';

    function joinChannel()
    {
        try {
            $channelInfo = (new JoinChannel)->response($_GET['channelName']);
            die(json_encode($channelInfo));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    joinChannel();
?>
