<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/3
 * Time: 14:41
 */

require_once 'header.php';
require_once 'functions.php';
if (!$loggedin)
{
    header("Location: ./login");
    exit();
}

$contact = $phone = $email = $address = $company_introduction = $qr_code_path = '';

if(isset($_POST['contact'])) $contact = $_POST['contact'];
if(isset($_POST['phone'])) $phone = $_POST['phone'];
if(isset($_POST['email'])) $email = $_POST['email'];
if(isset($_POST['address'])) $address = $_POST['address'];
if(isset($_POST['company_introduction'])) $company_introduction = $_POST['company_introduction'];

$qr_code_path = '';

if(isset($_FILES['QR_Code']))
{
    if ($tempfile = $_FILES['QR_Code']['tmp_name'])
    {
        $targetpath = "../upload/qr_code/" . $_FILES['QR_Code']['name'];
        if (move_uploaded_file($tempfile,$targetpath))
        {
            $qr_code_path = "upload/qr_code/" . $_FILES['QR_Code']['name'];
        }
    }
}

$query = queryMysql("SELECT * FROM info");
if (!$query->num_rows)
{
    queryMysql("INSERT INTO info(contact,phone,email,address,company_introduction,qr_code_path) VALUES ('" .
        $contact . "','" . $phone . "','" . $email . "','" .$address . "','" . $company_introduction . "','" . $qr_code_path . "')");
}
else
{
    if ($qr_code_path == '')
    {
        queryMysql("UPDATE info 
    SET contact='$contact',
    phone='$phone',
    email='$email',
    address='$address',
    company_introduction='$company_introduction'
    WHERE id=1");
    }
    else
    {
        queryMysql("UPDATE info 
    SET contact='$contact',
    phone='$phone',
    email='$email',
    address='$address',
    company_introduction='$company_introduction',
    qr_code_path='$qr_code_path' WHERE id=1");
    }
}

header("Location: ./getAboutUsInfo");
exit();