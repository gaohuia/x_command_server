<?php
/**
 * User: jiaozi<jiaozi@iyenei.com>
 * Date: 2018-07-13
 * Time: 13:43
 */

require_once __DIR__ . "/vendor/autoload.php";

(new \xcommand\core\XCommandServer("127.0.0.1:1000", 1))->run();


