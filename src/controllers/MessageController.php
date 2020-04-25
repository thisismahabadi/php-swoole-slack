<?php

/**
 * @author @thisismahabadi
 */
class MessageController extends Controller
{
    /**
     * Delete a message.
     *
	 * @see src/models/slack/DeleteMessage::response(array|string|null $params)
     *
	 * @return void
     */
    public function deleteMessage(): void
    {
        try {
            $message = $this->model('DeleteMessage')->response($_GET);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    /**
     * Get a thread.
     *
	 * @see src/models/slack/MessageThread::response(array|string|null $params)
     */
    public function getThread(): ?array
    {
        try {
            $messageThread = $this->model('MessageThread')->response($_GET);
            return $this->view('message-thread', ['messageThread' => $messageThread]);
        } catch (Exception $e) {
            return $this->view('message-thread', ['error' => $e]);
        }
    }

    /**
     * Reply to a message.
     *
	 * @see src/models/slack/ReplyMessage::response(array|string|null $params)
     *
	 * @return void
     */
    public function replyMessage(): void
    {
        try {
            $message = $this->model('ReplyMessage')->response($_POST);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    /**
     * Send a message.
     *
	 * @see src/models/slack/SendMessage::response(array|string|null $params)
     *
	 * @return void
     */
    public function sendMessage(): void
    {
        try {
            $message = $this->model('SendMessage')->response($_POST);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }
}
