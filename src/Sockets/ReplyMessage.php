<?php

$server = new Swoole\Websocket\Server("127.0.0.1", 9503);

$server->on('open', function($server, $req) {
    echo "connection open: {$req->fd}\n";
});

$server->on('message', function($server, $frame) {
    echo "received message: {$frame->data}\n";

    foreach ($server->connections as $sv) {
        $server->push($sv, $frame->data);
    }
});

$server->on('close', function($server, $fd) {
    echo "connection close: {$fd}\n";
});

$server->start();
