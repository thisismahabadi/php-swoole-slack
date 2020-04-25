<?php

class MessageController extends Controller
{
    public function deleteMessage()
    {
        try {
            $message = $this->model('DeleteMessage')->response($_GET);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    public function getThread(): ?array
    {
        try {
            $messageThread = $this->model('MessageThread')->response($_GET);
            return $this->view('message-thread', ['messageThread' => $messageThread]);
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    public function replyMessage()
    {
        try {
            $message = $this->model('ReplyMessage')->response($_POST);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    public function sendMessage()
    {
        try {
            $message = $this->model('SendMessage')->response($_POST);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }
}
