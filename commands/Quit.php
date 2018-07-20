<?php
/**
 * User: jiaozi<jiaozi@iyenei.com>
 * Date: 2018-07-16
 * Time: 17:43
 */

namespace xcommand\commands;


use xcommand\core\AbstractCommand;

class Quit extends AbstractCommand
{

    public function execute()
    {
        $this->getClient()->close();
    }
}