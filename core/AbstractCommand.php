<?php
/**
 * User: jiaozi<jiaozi@iyenei.com>
 * Date: 2018-07-16
 * Time: 12:42
 */

namespace xcommand\core;


abstract class AbstractCommand
{
    protected $client;
    protected $headers;
    protected $params;

    public function __construct()
    {
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return AbstractCommand
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     * @return AbstractCommand
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     * @return AbstractCommand
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }


    abstract public function execute();
}