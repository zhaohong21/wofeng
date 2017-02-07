<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/3
 * Time: 18:49
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
    if (isset($_POST['b_title'])) $b_title = sanitizeString($_POST['b_title']);
    if (isset($_POST['s_title'])) $s_title = sanitizeString($_POST['s_title']);
    if (isset($_POST['id'])) $id = sanitizeString($_POST['id']);

    if ($tempfile = $_FILES['file']['tmp_name'])
    {
        $targetpath = "../upload/banner/" . $_FILES['file']['name'];
        if (move_uploaded_file($tempfile,$targetpath))
        {
            if ($query = queryMysql("SELECT * FROM banner WHERE id='$id'")) {
                $query = $query->fetch_array(MYSQLI_ASSOC);
                $path = $query['banner_address'];
                unlink("../$path");

            }
            $banner_address = "upload/banner/" . $_FILES['file']['name'];
            queryMysql("UPDATE banner SET banner_address='$banner_address',b_title='$b_title',s_title='$s_title' WHERE id=$id");
        }
    }
    else
    {
        queryMysql("UPDATE banner SET b_title='$b_title',s_title='$s_title' WHERE id=$id");
    }


}

header("Location: ./getBannerList");