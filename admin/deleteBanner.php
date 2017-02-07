<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/3
 * Time: 18:24
 */
require_once 'functions.php';
require_once 'header.php';
if (!$loggedin)
{
    header("Location: ./login");
    exit();
}

header("Content-Type:application/json;charset=utf-8");

$data = array();

if (isset($_POST['id']))
{
    $id = sanitizeString($_POST['id']);
    if ($query = queryMysql("SELECT * FROM banner WHERE id='$id'"))
    {
        $query = $query->fetch_array(MYSQLI_ASSOC);
        $path = $query['banner_address'];
        unlink("../$path");

        queryMysql("DELETE FROM banner WHERE id='$id'");
        $data['result'] = true;
    }
}
else $data['message'] = 'Something happened!';


$json = json_encode($data);
echo $json;
