<?php

require_once __DIR__ . '/src/core/Controller.php';

switch ($_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI']) {
	case '/':
	case '/channels':
	case '/channels/':
		require_once __DIR__ . '/src/controllers/ChannelController.php';
		return (new ChannelController)->getList();
		break;

	case '/channels/info':
	case '/channels/info/':
		require_once __DIR__ . '/src/controllers/ChannelController.php';
		return (new ChannelController)->getInfo();
		break;

	case '/channels/messages':
	case '/channels/messages/':
		require_once __DIR__ . '/src/controllers/ChannelController.php';
		return (new ChannelController)->getMessages();
		break;

	case '/channels/leave':
	case '/channels/leave/':
		require_once __DIR__ . '/src/controllers/ChannelController.php';
		return (new ChannelController)->leaveChannel();
		break;

	case '/channels/join':
	case '/channels/join/':
		require_once __DIR__ . '/src/controllers/ChannelController.php';
		return (new ChannelController)->joinChannel();
		break;

	case '/messages/delete':
	case '/messages/delete/':
		require_once __DIR__ . '/src/controllers/MessageController.php';
		return (new MessageController)->deleteMessage();
		break;

	case '/messages/thread':
	case '/messages/thread/':
		require_once __DIR__ . '/src/controllers/MessageController.php';
		return (new MessageController)->getThread();
		break;

	case '/messages/reply':
	case '/messages/reply/':
		require_once __DIR__ . '/src/controllers/MessageController.php';
		return (new MessageController)->replyMessage();
		break;

	case '/messages/send':
	case '/messages/send/':
		require_once __DIR__ . '/src/controllers/MessageController.php';
		return (new MessageController)->sendMessage();
		break;

	default:
		echo 'Page not found.';
}
