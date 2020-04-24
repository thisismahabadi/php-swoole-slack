<?php
    require __DIR__ . '/../classes/slack/DeleteMessage.php';

    function deleteMessage()
    {
        try {
            $message = (new DeleteMessage)->response($_GET);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }
    
    deleteMessage();
?>
