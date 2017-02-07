<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/1/30
 * Time: 21:39
 */

require_once 'db.php';
require_once 'functions.php';
header("Access-Control-Allow-Origin: *");//

if (isset($_POST['answer']))
{
    $name = sanitizeString($_POST['name']);
    $phone = sanitizeString($_POST['phone']);
    $email = sanitizeString($_POST['email']);
    $keyword = sanitizeString($_POST['keyword']);
    $answer = $_POST['answer'];
    $answer = json_encode($answer);
//    $answer = sanitizeString($answer);

    queryMysql("INSERT INTO answer(name,phone,email,keyword,answer) VALUES ('" . $name ."','" . $phone . "','" . $email . "','" . $keyword . "','" . $answer . "')");
}