<?php
/**
 * User: jiaozi<jiaozi@iyenei.com>
 * Date: 2018-07-13
 * Time: 14:21
 */

namespace xcommand\core;


use Workerman\Connection\ConnectionInterface;

class ClientManager
{
    /**
     * @var \SplObjectStorage
     */
    private $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    /**
     * @param ConnectionInterface $connection
     * @return Client
     * @author jiaozi<jiaozi@iyenei.com>
     *
     */
    public function newClient(ConnectionInterface $connection)
    {
        $this->clients->attach($connection, $client = new Client($connection));
        return $client;
    }

    /**
     * @param ConnectionInterface $connection
     * @return Client
     * @author jiaozi<jiaozi@iyenei.com>
     *
     */
    public function getClient(ConnectionInterface $connection)
    {
        return $this->clients[$connection];
    }

    public function deleteClient(ConnectionInterface $connection)
    {
        $this->clients->detach($connection);
    }
}