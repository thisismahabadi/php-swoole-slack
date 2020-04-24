<?php
    require __DIR__ . '/../classes/slack/SendMessage.php';

    function sendMessage()
    {
        try {
            $message = (new SendMessage)->response($_POST);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    sendMessage();
?>
