<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/3
 * Time: 11:26
 */
//header.php
//验证是否登录

session_start();


if (isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr = "($user)";
}
else $loggedin = FALSE;
