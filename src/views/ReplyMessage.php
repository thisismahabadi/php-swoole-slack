<?php
    require __DIR__ . '/../classes/slack/ReplyMessage.php';

    function replyMessage()
    {
        try {
            $message = (new ReplyMessage)->response($_POST);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    replyMessage();
?>
