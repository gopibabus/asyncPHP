<?php

require __DIR__ . '/vendor/autoload.php';

use \React\EventLoop\Factory;
use \React\Http\Server;
use \React\Http\Response;
use \Psr\Http\Message\ServerRequestInterface;
use \React\Socket\Server as SocketServer;

$loop = Factory::create();

$counter = 0;

$server = new Server(function (ServerRequestInterface $request) use (&$counter) {
    return new Response(
        200,
        ['Content-Type' => 'text/plain'],
        'Hello, you are lucky visitor number: ' . $counter++
    );
});

$socketServer = new SocketServer(8000, $loop);
$server->listen($socketServer);

$loop->run();