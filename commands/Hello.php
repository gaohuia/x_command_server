<?php
/**
 * User: jiaozi<jiaozi@iyenei.com>
 * Date: 2018-07-16
 * Time: 17:21
 */

namespace xcommand\commands;


use xcommand\core\AbstractCommand;

class Hello extends AbstractCommand
{
    public function execute()
    {
        static $index = 0;
        return $index ++ ;
    }
}