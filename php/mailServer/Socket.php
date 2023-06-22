<?php

class Socket
{

    protected $ip, $port, $ttl;
    private $conn;
    public function __construct($ip, $port)
    {
        // Give up after 10 seconds...

        $this->ttl = 5;

        // Set IP and port

        $this->ip = $ip;
        $this->port = $port;

        // Try to establish connection

        $this->conn = fsockopen($this->ip, $this->port, $errno, $errstr, $this->ttl);

        if (!$this->conn)
            throw new Exception("Error trying to establish connection to $this->ip on port $this->port! Aborting!");
        $response = fgets($this->conn);
        echo "Server: $response";
    }
    public function send($msg)
    {
        // Send message, get reply
        fputs($this->conn, $msg);
        return fgets($this->conn);
    }

    public function put($msg)
    {
        // Send message, no reply
        fputs($this->conn, $msg);
        sleep(1);
    }

    public function get()
    {
        stream_set_timeout($this->conn, $this->ttl);
        // Get reply
        $reply = fgets($this->conn);
        return $reply;
    }

    public function close()
    {
        fclose($this->conn);
    }
}
