<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/3
 * Time: 11:45
 */
require_once 'db.php';

function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlspecialchars($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
}