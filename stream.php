<?php
require __DIR__ . '/vendor/autoload.php';

use \React\EventLoop\Factory;
use \React\Stream\WritableResourceStream;
use \React\Stream\ReadableResourceStream;

$loop = Factory::create();

$out = new WritableResourceStream(STDOUT, $loop);
$in = new ReadableResourceStream(STDIN, $loop);

$in->on('data', function ($data) use ($out) {
    $out->write('This is output' . $data);
});

$loop->run();