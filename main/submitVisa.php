<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/1/30
 * Time: 15:18
 */

require_once 'db.php';
require_once 'functions.php';

header("Access-Control-Allow-Origin: *");//

if (isset($_POST['visa_type'])) {
    if ($_POST['visa_type'] == 0) {
        $current_visa = sanitizeString($_POST['current_visa']);
        $email = sanitizeString($_POST['email']);
        $expire_date = sanitizeString($_POST['expire_date']);
        $name = sanitizeString($_POST['name']);
        $passport_type = sanitizeString($_POST['passport_type']);
        $phone = sanitizeString($_POST['phone']);
        $search_visa = sanitizeString($_POST['search_visa']);

        queryMysql("INSERT INTO submit_visa_type0(current_visa,email,expire_date,name,passport_type,phone,search_visa) 
VALUES ('" . $current_visa . "','" . $email . "','" . $expire_date . "','" . $name . "','" . $passport_type . "','" . $phone . "','" . $search_visa . "')");
    }

    if ($_POST['visa_type'] == 1) {
        $destination = sanitizeString($_POST['destination']);
        $email = sanitizeString($_POST['email']);
        $purpose = sanitizeString($_POST['purpose']);
        $name = sanitizeString($_POST['name']);
        $passport_type = sanitizeString($_POST['passport_type']);
        $phone = sanitizeString($_POST['phone']);
        $residence = sanitizeString($_POST['residence']);

        queryMysql("INSERT INTO submit_visa_type1(destination,email,purpose,name,passport_type,phone,residence) 
VALUES ('" . $destination . "','" . $email . "','" . $purpose . "','" . $name . "','" . $passport_type . "','" . $phone . "','" . $residence . "')");
    }
}
