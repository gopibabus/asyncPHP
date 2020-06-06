<?php
require __DIR__ . '/vendor/autoload.php';

use \React\EventLoop\Factory;
use \React\Stream\WritableResourceStream;
use \React\Stream\ReadableResourceStream;
use \React\Stream\CompositeStream;

$loop = Factory::create();

$out = new WritableResourceStream(STDOUT, $loop);
$in = new ReadableResourceStream(STDIN, $loop);
$composite = new CompositeStream($in, $out);

$composite->on('data', function ($data) use ($composite) {
    $composite->write('This is output: ' . strtoupper($data));
});

$loop->run();