<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
require_once($rootDirectory."/php/mailServer/Socket.php");

class Mail
{
    protected $socket;
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
        // Create new Socket for SMTP communication
        try {
            $smtp_conn = new Socket('127.0.0.1', 25);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // Sender and recipient details
        $from = 'test@mimail.org';
        $to = $this->recipient;

        // Message details
        $subject = $this->subject;
        $message = $this->body;

        // Send the EHLO command
        echo "Server:". $smtp_conn->send("EHLO mimail.org");

        // Send the MAIL FROM command
        echo "Server:". $smtp_conn->send("MAIL FROM: <$from>\r\n");

        // Send the RCPT TO command
        echo "Server:". $smtp_conn->send("RCPT TO: <$to>\r\n");

        // Send the DATA command
        echo "Server:". $smtp_conn->send("DATA\r\n");

        // Send the email headers and body
        $smtp_conn->put("Subject: $subject\r\n");
        $smtp_conn->put("From: $from\r\n");
        $smtp_conn->put("To: $to\r\n");
        $smtp_conn->put("\r\n");
        $smtp_conn->put("$message\r\n");
        // End data, get response
        echo "Server:". $smtp_conn->send(".\r\n");

        // Send the QUIT command
        echo "Server:". $smtp_conn->send("QUIT\r\n");

        // Close the socket
        $smtp_conn->close();
    }
}
