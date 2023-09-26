<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/repository/UserRepository.php");
include_once($rootDirectory . "/php/repository/MailRepository.php");

class MailService
{
    private $userRepository, $mailRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->mailRepository = new MailRepository();
    }

    public function insertMail($username, $from, $subject, $content)
    {
        $user = $this->userRepository->getUser($username);
        if ($user[0]) {
            $sql_response  = $this->mailRepository->insertMail($user[0]["UID"], $subject, $from, $content);
            if ($sql_response == 1)
                return "Mail zaprimljen.";
            else
                return "Greška kod upisa mail-a!";
        } else
            return "Korisnik nije pronađen!";
    }

    public function getAllMail($username){
        $user = $this->userRepository->getUser($username);
        $response = $this->mailRepository->getMailByUserId($user[0]['UID']);
        if ($response == array()){
            return "Nema mailova za prikaz";
        } else return $response;
    }

    public function getMail($mail_id){
        $response = $this->mailRepository->getMailByMailId($mail_id);
        if ($response == array()){
            return "Nema mailova za prikaz";
        } else return $response;
    }

    public function deleteMail($mail_id){
        $response = $this->mailRepository->deleteMail($mail_id);
        if ($response == 1){
            return "Mail uspješno obrisan";
        } else return $response;
    }

    public function getMailByKeyWord($user_id, $key_word) {
        $response = $this -> mailRepository -> getMailByKeyWord($user_id, $key_word);
        if ($response !== null){
            return $response;  
        }
        else return "Mail nije pronađen!";
    }
}
