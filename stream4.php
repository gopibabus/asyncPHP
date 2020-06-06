<?php
require __DIR__ . '/vendor/autoload.php';

use \React\EventLoop\Factory;
use \React\Stream\WritableResourceStream;
use \React\Stream\ReadableResourceStream;

$loop = Factory::create();

// We can built interactive console applications using Streams
$out = new WritableResourceStream(STDOUT, $loop);
$in = new ReadableResourceStream(STDIN, $loop, 1);

$in->on('data', function ($data) use ($out, $in, $loop) {
    $out->write('This is output: ' . strtoupper($data) . PHP_EOL);

    $in->pause();

    $loop->addTimer(1, function () use ($in) {
        $in->resume();
    });
});

$loop->run();