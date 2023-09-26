<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/Repository.php");

class MailRepository extends Repository
{
    public function __construct()
    {
        parent::__construct("MAIL");
    }

    public function getMailByUserId($user_id)
    {
        $sql = "SELECT m.* FROM MAIL m WHERE m.USER_ID = " . $user_id. " ORDER BY 1";
        $conn = parent::connect();
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return array();
        }
    }

    public function getMailByMailId($mail_id)
    {
        $sql = "SELECT m.* FROM mail m WHERE m.MAIL_ID =  $mail_id ";
        $conn = parent::connect();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return array();
        }
    }

    public function insertMail($user_id, $subject, $from, $content)
    {
       
        $sql = "INSERT INTO mail (USER_ID, M_SUBJECT, M_FROM, M_CONTENT) " .
            "VALUES ('" . $user_id . "', '" . $subject . "', '" . $from . "', '" . $content . "')";
        $conn = parent::connect();
        $result = $conn->query($sql);

        return $result;
    }

    public function deleteMail($mail_id)
    {
        $sql = "DELETE FROM mail WHERE MAIL_ID = $mail_id";
        $conn = parent::connect();
        $result = $conn->query($sql);

        return $result;
    }

    public function getMailByKeyWord($user_id, $key_word){
        $sql = "SELECT FROM mail m WHERE m.USER_ID = $user_id
        AND (UPPER (m.M_SUBJECT) LIKE UPPER ('%$key_word%') OR UPPER(m.M_CONTENT) LIKE UPPER('%$key_word%'));";
        $conn = parent::connect();
        $result = $conn -> query($sql);

        return $result;
    }

}
