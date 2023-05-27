<?php

class Socket
{

    protected $ip, $port;
    private $conn;
    public function __construct($ip, $port)
    {
        // Set IP and port

        $this->ip = $ip;
        $this->port = $port;

        // Try to establish connection

        $this->conn = fsockopen($this->ip, $this->port, $errno, $errstr, 10);

        if (!$this->conn) throw new Exception("Error trying to establish connection to $this->ip on port $this->port! Aborting!");
        $response = fgets($this->conn);
        echo "Server: $response";
    }
    public function send($msg)
    {
        // Send message, get reply
        fputs($this->conn, $msg);
        return fgets($this->conn);
    }

    public function put($msg){
        // Send message, no reply
        fputs($this->conn, $msg);
    }

    public function get(){
        // Get reply
        return fgets($this->conn);
    }

    public function close(){
        fclose($this->conn);
    }
}
