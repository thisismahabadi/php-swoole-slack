<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Slack\Message;

/**
 * @author @thisismahabadi
 */
class MessageController extends Controller
{
    /**
     * Delete a message.
     *
	 * @see src/Models/Slack/Message::delete(array|null $params)
     *
	 * @return void
     */
    public function delete(): void
    {
        try {
            $message = (new Message)->delete($_GET);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    /**
     * Get a thread.
     *
	 * @see src/Models/Slack/Message::getThread(array|null $params)
     */
    public function getThread(): ?array
    {
        try {
            $messageThread = (new Message)->getThread($_GET);
            return $this->setView('message-thread', ['messageThread' => $messageThread]);
        } catch (Exception $e) {
            return $this->setView('message-thread', ['error' => $e]);
        }
    }

    /**
     * Reply to a message.
     *
	 * @see src/Models/Slack/Message::reply(array|null $params)
     *
	 * @return void
     */
    public function reply(): void
    {
        try {
            $message = (new Message)->reply($_POST);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }

    /**
     * Send a message.
     *
	 * @see src/Models/Slack/Message::send(array|null $params)
     *
	 * @return void
     */
    public function send(): void
    {
        try {
            $message = (new Message)->send($_POST);
            die(json_encode($message));
        } catch (Exception $e) {
            echo $e->getMessage(); die;
        }
    }
}
