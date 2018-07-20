<?php
/**
 * User: jiaozi<jiaozi@iyenei.com>
 * Date: 2018-07-13
 * Time: 14:23
 */

namespace xcommand\core;

use Workerman\Connection\ConnectionInterface;
use xcommand\core\exceptions\Exception;

class Client
{
    /**
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * 用户加入系统的时间戳
     * @var int
     */
    private $joinedAt;

    /**
     * @var CommandFactory
     */
    private $commandFactory;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
        $this->joinedAt = time();

        $this->commandFactory = new CommandFactory();
    }

    public function onConnect()
    {
    }

    public function onClose()
    {
    }

    public function getConnection()
    {
        return $this->connection;
    }

    protected function onCommand($target, $headers, $params)
    {
        try {
            $command = $this->commandFactory->createCommandTarget($target);
            $result = $command->setClient($this)
                ->setHeaders($headers)
                ->setParams($params)
                ->execute();

            $this->response($result);
        } catch (Exception $exception) {
            $this->response(null, $exception->getCode(), $exception->getMessage());
        }
    }

    protected function response($data, $code = 0, $message = 'success')
    {
        $response = [
            'data' => $data,
            'code' => $code,
            'message' => $message,
        ];

        $this->connection->send($response);
    }

    /**
     * @param $chunk
     * @throws \Exception
     * @author jiaozi<jiaozi@iyenei.com>
     *
     */
    public function onMessage($request)
    {
        $target = $request['target'];
        $header = $request['header'] ?? [];
        $params = $request['params'] ?? [];

        $this->onCommand($target, $header, $params);
    }

    public function close()
    {
        $this->onClose();
        $this->getConnection()->close();
    }
}