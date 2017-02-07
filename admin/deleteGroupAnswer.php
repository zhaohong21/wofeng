<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/4
 * Time: 22:09
 */

require_once 'header.php';
require_once 'functions.php';
if (!$loggedin)
{
    header("Location: ./login");
    exit();
}

if (isset($_GET['id']))
{
    $id = sanitizeString($_GET['id']);

    $query = queryMysql("DELETE FROM answer WHERE id=$id");
}
header("Location: ./getUserInfo");
exit();