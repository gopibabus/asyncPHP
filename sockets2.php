<?php

require __DIR__ . '/vendor/autoload.php';

use \React\EventLoop\Factory;
use \React\Socket\Server;
use \React\Socket\Connection;
use \React\Socket\LimitingServer;
use \React\Stream\WritableResourceStream;

$loop = Factory::create();

$out = new WritableResourceStream(STDOUT, $loop);
$server = new Server('0.0.0.0:8000', $loop);
$limitingServer = new LimitingServer($server, null);

//Two way connection
$limitingServer->on('connection', function (Connection $connection) use ($out, $limitingServer) {

    $out->write('New Connection' . PHP_EOL);
    $connection->on('data', function ($data) use ($out, $limitingServer) {
        foreach ($limitingServer->getConnections() as $connection) {
            $connection->write($data);
        }
    });
});

$loop->run();