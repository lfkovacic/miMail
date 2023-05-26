<?php

class Mail
{
    protected $recipient, $subject, $body, $headers;

    public function __construct($dto)
    {
        $this->recipient = $dto->recipient;
        $this->subject = $dto->subject;
        $this->body = $dto->body;
        $this->headers = $dto->headers;
    }

    public function send()
    {
        //if (mail($this->recipient, $this->subject, $this->body, $this->headers)){
        //    echo "Mail sent!";
        //} else echo "Failed to send mail!";

        // SMTP server details
        $smtpServer = '127.0.0.1';
        $port = 25;

        // Sender and recipient details
        $from = 'test@mimail.org';
        $to = 'Papercut@papercut.com';

        // Message details
        $subject = 'Your Subject';
        $message = 'Umoran sam prijatelju, umoran.\nI od žena, i od vina, umoran.';

        // Connect to the SMTP server
        $socket = fsockopen($smtpServer, $port, $errno, $errstr, 10);
        if (!$socket) {
            echo "Failed to connect to SMTP server: $errstr ($errno)";
            exit;
        }

        // Read the welcome message from the server
        $response = fgets($socket);
        echo "Server: $response";

        // Send the EHLO command
        fputs($socket, "EHLO example.com\r\n");
        $response = fgets($socket);
        echo "Server: $response";

        // Send the MAIL FROM command
        fputs($socket, "MAIL FROM: <$from>\r\n");
        $response = fgets($socket);
        echo "Server: $response";

        // Send the RCPT TO command
        fputs($socket, "RCPT TO: <$to>\r\n");
        $response = fgets($socket);
        echo "Server: $response";

        // Send the DATA command
        fputs($socket, "DATA\r\n");
        $response = fgets($socket);
        echo "Server: $response";

        // Send the email headers and body
        fputs($socket, "Subject: $subject\r\n");
        fputs($socket, "From: $from\r\n");
        fputs($socket, "To: $to\r\n");
        fputs($socket, "\r\n");
        fputs($socket, "$message\r\n");
        fputs($socket, ".\r\n");
        $response = fgets($socket);
        echo "Server: $response";

        // Send the QUIT command
        fputs($socket, "QUIT\r\n");
        $response = fgets($socket);
        echo "Server: $response";

        // Close the socket
        fclose($socket);
    }
}
