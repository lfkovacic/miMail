<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/repository/UserDetailsRepository.php");
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

    public function insertUserDetails($user_id, $drzava, $adresa, $kucni_broj, $grad, $postanski_broj, $broj_telefona, $email_adresa, $oib, $image)
    {
        $drzava = $this -> normalizeValue($drzava);
        $adresa = $this -> normalizeValue($adresa);
        $kucni_broj = $this -> normalizeValue($kucni_broj);
        $grad = $this -> normalizeValue($grad);
        $postanski_broj = $this -> normalizeValue($postanski_broj);
        $broj_telefona = $this -> normalizeValue($broj_telefona);
        $email_adresa = $this -> normalizeValue($email_adresa);
        $oib = $this -> normalizeValue($oib);
        $image = $this -> normalizeValue($image);
       

        $sql_response = $this->userDetailsRepository->insertUserDetails($user_id, $drzava, $adresa, $kucni_broj, $grad, $postanski_broj, $broj_telefona, $email_adresa, $oib, $image);

        if ($sql_response == 1) {
            return "Detalji o korisniku uspješno uneseni.";
        } else {
            return "Greška kod unosa detalja o korisniku.";
        }
    }

    private function normalizeValue ($value)
    {
        return ($value == ""||!$value)? null: $value;

    }

}
?>
