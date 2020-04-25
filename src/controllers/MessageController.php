<?php

/**
 * @author @thisismahabadi
 */
class MessageController extends Controller
{
    /**
     * Delete a message.
     *
	 * @see src/models/slack/Message::delete(array|null $params)
     *
	 * @return void
     */
    public function delete(): void
    {
        try {
            $message = $this->setModel('Message')->delete($_GET);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    /**
     * Get a thread.
     *
	 * @see src/models/slack/Message::getThread(array|null $params)
     */
    public function getThread(): ?array
    {
        try {
            $messageThread = $this->setModel('Message')->getThread($_GET);
            return $this->setView('message-thread', ['messageThread' => $messageThread]);
        } catch (Exception $e) {
            return $this->setView('message-thread', ['error' => $e]);
        }
    }

    /**
     * Reply to a message.
     *
	 * @see src/models/slack/Message::reply(array|null $params)
     *
	 * @return void
     */
    public function reply(): void
    {
        try {
            $message = $this->setModel('Message')->reply($_POST);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    /**
     * Send a message.
     *
	 * @see src/models/slack/Message::send(array|null $params)
     *
	 * @return void
     */
    public function send(): void
    {
        try {
            $message = $this->setModel('Message')->send($_POST);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }
}
