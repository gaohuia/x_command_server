<?php
/**
 * User: jiaozi<jiaozi@iyenei.com>
 * Date: 2018/7/20/020
 * Time: 22:45
 */

require_once __DIR__ . "/vendor/autoload.php";

$connection = new \pjs\ClientConnection("127.0.0.1:1000");
$connection->connect();
$connection->send(['target' => 'hello']);
$response = $connection->recv();
$connection->send(['target' => 'hello']);
$response = $connection->recv();
$connection->send(['target' => 'hello']);
$response = $connection->recv();
$connection->send(['target' => 'hello']);
$response = $connection->recv();
$connection->send(['target' => 'hello']);
$response = $connection->recv();
$connection->send(['target' => 'hello']);
$response = $connection->recv();
var_dump($response);

