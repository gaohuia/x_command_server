<?php
/**
 * User: jiaozi<jiaozi@iyenei.com>
 * Date: 2018-07-16
 * Time: 13:01
 */

namespace xcommand\core;


use xcommand\core\exceptions\BadCommandImplementationException;
use xcommand\core\exceptions\CommandNotFoundException;

class CommandFactory
{
    private $namespace = "\\xcommand\\commands\\";

    /**
     * @param $commandName
     * @return AbstractCommand
     * @throws BadCommandImplementationException
     * @throws CommandNotFoundException
     * @author jiaozi<jiaozi@iyenei.com>
     *
     */
    public function createCommandTarget($commandName)
    {
        $class = $this->namespace . ucfirst($commandName);
        if (class_exists($class)) {
            $reflect = new \ReflectionClass($class);
            if (!$reflect->isSubclassOf(AbstractCommand::class)) {
                throw new BadCommandImplementationException("Command应当是AbstractCommand的子类");
            }

            return $reflect->newInstance();
        } else {
            throw new CommandNotFoundException("命令未找到, command={$commandName}");
        }
    }
}