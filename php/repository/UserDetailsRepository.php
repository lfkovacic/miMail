<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/Repository.php");

class UserDetailsRepository extends Repository
{
    public function __construct()
    {
        parent::__construct("USERDETAILS"); // Naziv tablice
    }
 

    public function insertUserDetails($user_id, $drzava, $adresa, $kucni_broj, $grad, $postanski_broj, $broj_telefona, $email_adresa, $oib, $image)
    {
        $sql = "INSERT INTO userdetails (USER_ID, DRZAVA, ADRESA_STANOVANJA, KUCNI_BROJ, GRAD, POSTANSKI_BROJ, BROJ_TELEFONA, E_MAIL_ADRESA, OIB, IMAGE_BLOB) " .
            "VALUES ('".$user_id."', '".$drzava."', '".$adresa."', '".$kucni_broj."', '".$grad."', '".$postanski_broj."', '".$broj_telefona."', '".$email_adresa."', '".$oib."', '".$image."')";
         $conn = parent::connect();
        $result = $conn->query($sql);



        return $result;
    }

    public function getUserDetailsByUserId($user_id)
    {

        $sql = "SELECT 
            u.USERNAME, 
            CONCAT(
                ud.ADRESA_STANOVANJA, ' ',
                CAST(ud.KUCNI_BROJ AS char), ', ',
                CAST(ud.POSTANSKI_BROJ AS char), ' ',
                ud.GRAD, ', ',
                ud.DRZAVA) 
            as ADRESA,
            ud.BROJ_TELEFONA,
            ud.E_MAIL_ADRESA,
            ud.OIB,
            ud.IMAGE_BLOB
        FROM USERDETAILS ud
        LEFT JOIN USER u ON ud.USER_ID = u.UID
        WHERE ud.USER_ID = $user_id
        ORDER BY ud.DETAIL_ID DESC;";

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
