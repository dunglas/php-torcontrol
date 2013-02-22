<?php

namespace TorControl;

use Exception\ConnectionError;

/**
 * TorControl
 *
 * @author dunglas
 */
class TorControl
{

    /**
     *
     * @var boolean
     */
    protected $connected = false;

    /**
     *
     * @var array
     */
    protected static $defautOptions = array(
        'hostname' => '127.0.0.1',
        'port' => -1,
        'timeout' => -1
    );

    /**
     *
     * @var array
     */
    protected $options;

    /**
     *
     * @var resource
     */
    protected $socket;

    /**
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->options = array_merge(static::$defautOptions, $options);
        if ($this->options['timeout'] === -1) {
            $this->options['timeout'] = ini_get('default_socket_timeout');
        }
    }

    public function __destruct()
    {
        $this->quit();
    }

    public function connect()
    {
        $this->socket = fsockopen($this->options['hostname'], $this->options['port'], $errno, $errstr, $this->options['timeout']);
        if (!$this->socket) {
            throw new ConnectionError('Connection error:' . $errno . ' - ' . $errstr);
        }

        $this->connected = true;
    }

    public function getConnected()
    {
        return $this->getConnected();
    }

    public function quit()
    {
        if ($this->connected && $this->socket) {
            fclose($this->socket);
        }

        $this->connected = false;
    }

    /**
     * Quotes and escapes to use in a command
     *
     * @param string $str
     * @return string
     */
    public static function quote($str)
    {
        $str = strtr($str, array('\\' => '\\\\', '"' => '\"'));

        return '"' . $str . '"';
    }

}
