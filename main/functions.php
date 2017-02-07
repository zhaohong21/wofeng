<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/1/30
 * Time: 15:58
 */

function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlspecialchars($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
}

