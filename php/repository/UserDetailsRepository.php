<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/Repository.php");

class UserDetailsRepository extends Repository
{
    public function __construct()
    {
        parent::__construct("USER_DETAILS"); // Naziv tablice
    }
 

    public function insertUserDetails($user_id, $drzava, $adresa, $kucni_broj, $grad, $postanski_broj, $broj_telefona, $email_adresa, $oib)
    {
        $sql = "INSERT INTO user_details (USER_ID, DRZAVA, ADRESA_STANOVANJA, KUCNI_BROJ, GRAD, POSTANSKI_BROJ, BROJ_TELEFONA, E_MAIL_ADRESA, OIB) " .
            "VALUES ('".$user_id."', '".$drzava."', '".$adresa."', '".$kucni_broj."', '".$grad."', '".$postanski_broj."', '".$broj_telefona."', '".$email_adresa."', '".$oib."')";
         $conn = parent::connect();
        $result = $conn->query($sql);



        return $result;
    }

    public function getUserDetailsByUserId($user_id)
    {

        $sql = "SELECT u.USERNAME, ud.DRZAVA, ud.ADRESA_STANOVANJA, ud.KUCNI_BROJ, ud.GRAD, ud.POSTANSKI_BROJ, ud.BROJ_TELEFONA, ud.E_MAIL_ADRESA, ud.OIB
            FROM USER u
            LEFT JOIN USER_DETAILS ud ON u.USER_ID = ud.USER_ID
            WHERE u.USER_ID = " . $user_id ." ORDER BY 1;";

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
}
