<?php

require __DIR__ . '/vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

//addTimer is equivalent to setTimeout() in chrome Web API
$loop->addTimer(2, function () {
    echo "World" . PHP_EOL;
});
$loop->addTimer(1, function () {
    echo "Hello" . PHP_EOL;
});

//addPeriodicTimer is equivalent to setInterval() in chrome Web API
$loop->addPeriodicTimer(1, function () {
    echo "I will repeat every 1 second!!" . PHP_EOL;
});

$loop->run();