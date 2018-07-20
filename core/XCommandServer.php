<?php
/**
 * User: jiaozi<jiaozi@iyenei.com>
 * Date: 2018-07-13
 * Time: 13:55
 */

namespace xcommand\core;


use pjs\protocols\JsonStreamProtocol;
use Workerman\Connection\ConnectionInterface;
use Workerman\Worker;

class XCommandServer
{
    private $listen;
    private $count;
    private $clientManager;

    public function __construct($listen, $amount)
    {
        $this->listen = $listen;
        $this->count = $amount;
    }

    public function getClientManager()
    {
        if ($this->clientManager == null) {
            $this->clientManager = new ClientManager();
        }
        return $this->clientManager;
    }

    public function setClientManager(ClientManager $clientManager)
    {
        $this->clientManager = $clientManager;
        return $this;
    }

    public function run()
    {
        $worker = new Worker("tcp://" . $this->listen);
        $worker->count = $this->count;
        $worker->protocol = JsonStreamProtocol::class;

        $worker->onConnect = [$this, 'onConnect'];
        $worker->onMessage = [$this, 'onMessage'];
        $worker->onClose = [$this, 'onClose'];

        Worker::runAll();
    }

    public function onConnect(ConnectionInterface $conn)
    {
        $this->getClientManager()->newClient($conn)->onConnect();
    }

    public function onMessage(ConnectionInterface $conn, $data)
    {
        // 如果处理数据出现异常， 直接关闭这个连接.
        $client = null;
        try {
            $client = $this->getClientManager()->getClient($conn);
            $client->onMessage($data);
        } catch (\Exception $e) {
            var_dump($e->getMessage());

            if ($client != null) {
                $client->close();
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->getClientManager()->deleteClient($conn);
    }
}