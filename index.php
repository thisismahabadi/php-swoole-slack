<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\ChannelController;
use App\Controllers\MessageController;

switch ($_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI']) {
	case '/':
	case '/channels':
	case '/channels/':
		return (new ChannelController)->getList();
		break;

	case '/channels/info':
	case '/channels/info/':
		return (new ChannelController)->getInfo();
		break;

	case '/channels/messages':
	case '/channels/messages/':
		return (new ChannelController)->getMessages();
		break;

	case '/channels/leave':
	case '/channels/leave/':
		return (new ChannelController)->leaveFrom();
		break;

	case '/channels/join':
	case '/channels/join/':
		return (new ChannelController)->joinTo();
		break;

	case '/messages/delete':
	case '/messages/delete/':
		return (new MessageController)->delete();
		break;

	case '/messages/thread':
	case '/messages/thread/':
		return (new MessageController)->getThread();
		break;

	case '/messages/reply':
	case '/messages/reply/':
		return (new MessageController)->reply();
		break;

	case '/messages/send':
	case '/messages/send/':
		return (new MessageController)->send();
		break;

	default:
		echo 'Page not found.';
}
