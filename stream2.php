<?php
require __DIR__ . '/vendor/autoload.php';

use \React\EventLoop\Factory;
use \React\Stream\WritableResourceStream;
use \React\Stream\ReadableResourceStream;
use \React\Stream\ThroughStream;

$loop = Factory::create();

// We can built interactive console applications using Streams
$out = new WritableResourceStream(STDOUT, $loop);
$in = new ReadableResourceStream(STDIN, $loop);

$through = new ThroughStream(function ($data) {
    return 'This is output: ' . strtoupper($data);
});

$in->pipe($through)->pipe($out);

$loop->run();