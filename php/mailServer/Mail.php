<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
require_once($rootDirectory . "/php/mailServer/Socket.php");

class Mail
{
    protected $socket;
    protected $sender, $recipient, $subject, $body, $headers;
    public function __construct($dto)
    {
        $this->sender = $dto->sender;
        $this->recipient = $dto->recipient;
        $this->subject = $dto->subject;
        $this->body = $dto->body;
        $this->headers = $dto->headers;
    }

    public function send()
    {

        // Sender and recipient details
        $from = $this->sender;
        $to = $this->recipient;

        // Message details
        $subject = $this->subject;
        $message = $this->body;

        $host = "";

        // Get host from the recipient's address
        if (preg_match("/[\x00-\x7f`]+@(.+)/", $to, $matches)) {
            $host = $matches[1];
        } else throw new Exception("Error: invalid address!");

        if ($host != "localhost")
            $mxRecords = $this->mxLookup($host);
        else $mxRecords = array("localhost");

        // Create new Socket for SMTP communication
        try {
            $smtp_conn = new Socket($mxRecords[0], 25);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        echo "Send the EHLO command:\n";
        echo "Server:" . $smtp_conn->send("EHLO mimail.org\r\n");

        // Wait for the server to shut up.

        do {
            $response = $smtp_conn->get();
            echo "Server: " . $response;
        } while ($response);


        echo "Send the MAIL FROM command:\n";
        echo "Server:" . $smtp_conn->send("MAIL FROM: <$from>\r\n");
        echo "MAIL FROM: \"$from\"\r\n";

        echo "Send the RCPT TO command:\n";
        echo "Server:" . $smtp_conn->send("RCPT TO: <$to>\r\n");
        echo "RCPT TO: \"$to\"\r\n";

        echo "Send the DATA command:\n";
        echo "Server:" . $smtp_conn->send("DATA\r\n");
        echo "DATA\r\n";

        echo "Send the email headers and body...\n";
        $smtp_conn->put("Subject: $subject\r\n");
        $smtp_conn->put("From: $from\r\n");
        $smtp_conn->put("To: $to\r\n");
        $smtp_conn->put("\r\n");
        $smtp_conn->put("$message\r\n");
        //TODO: blob
        echo "End data, get response:\n";
        echo "Server:" . $smtp_conn->send(".\r\n");

        // Wait for the server to shut up.

        do {
            $response = $smtp_conn->get();
            echo "Server: " . $response;
        } while ($response);

        echo "Send the QUIT command:\n";
        echo "Server:" . $smtp_conn->send("QUIT\r\n");

        // Close the socket
        $smtp_conn->close();
    }

    private function mxLookup($host)
    {
        $mxRecords = [];
        if (getmxrr($host, $mxRecords)) {
            echo "MX records for $host:\n";
            foreach ($mxRecords as $record) {
                echo "\t$record\n";
            }
        } else throw new Exception("No MX records found for $host!\n");
        return $mxRecords;
    }
}
