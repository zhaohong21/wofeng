<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/5
 * Time: 9:47
 */

require_once 'db.php';
require_once 'functions.php';
header("Access-Control-Allow-Origin: *");//
header("Content-Type:application/json;charset=utf-8");

if (isset($_POST['name'])) $name = sanitizeString($_POST['name']);
if (isset($_POST['phone'])) $phone = sanitizeString($_POST['phone']);
if (isset($_POST['email'])) $email = sanitizeString($_POST['email']);
if (isset($_POST['content'])) $content = sanitizeString($_POST['content']);

if (queryMysql("INSERT INTO message(name,phone,email,content) VALUES ('$name','$phone','$email','$content')"))
{
    $result = true;

    $query = queryMysql("SELECT LAST_INSERT_ID()");
    $row = $query->fetch_row();
    $user_id = $row[0];
}
else $result = false;
if (isset($user_id))
    $json = compact('result','user_id');
else
    $json = compact('result');
$json = json_encode($json);
echo $json;

