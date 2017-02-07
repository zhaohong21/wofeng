<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/3
 * Time: 17:35
 */

require_once 'functions.php';
require_once 'header.php';
if (!$loggedin)
{
    header("Location: ./login");
    exit();
}

$b_title = $s_title = $banner_address = '';
if (isset($_FILES['file']))
{
    if (isset($_POST['b_title'])) $b_title = $_POST['b_title'];
    if (isset($_POST['s_title'])) $s_title = $_POST['s_title'];

    if ($tempfile = $_FILES['file']['tmp_name'])
    {
        $targetpath = "../upload/banner/" . $_FILES['file']['name'];
        if (move_uploaded_file($tempfile,$targetpath))
        {
            $banner_address = "upload/banner/" . $_FILES['file']['name'];
        }
    }
    queryMysql("INSERT INTO banner(banner_address,b_title,s_title) VALUES ('$banner_address','$b_title','$s_title')");
}

header("Location: ./getBannerList");