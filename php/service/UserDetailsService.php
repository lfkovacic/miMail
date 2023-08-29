<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/repository/UserRepository.php");
include_once($rootDirectory . '/php/jwt/Jwt.php');

class UserDetailsService
{
    private $userDetailsRepository;

    public function __construct()
    {
        $this->userDetailsRepository = new UserDetailsRepository();
    }

    public function getUserDetailsByUserId($user_id)
    {
        $sql_response = $this->userDetailsRepository->getUserDetailsByUserId($user_id);
         print_r ($sql_response);
         return $sql_response;
    }

    public function insertUserDetails($user_id, $drzava, $adresa, $kucni_broj, $grad, $postanski_broj, $broj_telefona, $email_adresa, $oib)
    {
        $sql_response = $this->userDetailsRepository->insertUserDetails($user_id, $drzava, $adresa, $kucni_broj, $grad, $postanski_broj, $broj_telefona, $email_adresa, $oib);

        if ($sql_response == 1) {
            return "Detalji o korisniku uspješno uneseni.";
        } else {
            return "Greška kod unosa detalja o korisniku.";
        }
    }

}
?>
