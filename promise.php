<?php

require __DIR__ . '/vendor/autoload.php';

use \React\Promise\Deferred;

function get($uri)
{
    $deferred = new Deferred();
    $responseData = null;
    if ($responseData) {
        $deferred->resolve($responseData);
    } else {
        $deferred->reject(new Exception('no response'));
    }
    return $deferred->promise();
}

get('https://gopibabu.live')
    ->then(function ($data) {
        return strtoupper($data);
    })
    ->then(
        function ($data) {
            echo "Received Data: " . $data;
        },
        function (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    );