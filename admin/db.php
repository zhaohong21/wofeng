<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/1/30
 * Time: 15:19
 */

$dbhost = 'localhost';
$dbname = 'wofeng';
$dbuser = 'jim';
$dbpass = '12345';

$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if ($connection->connect_error)
{
    die($connection->connect_error);
}
$connection->set_charset('utf8');
function queryMysql($query)
{
    global $connection;
    $result1 = $connection->query($query);
    return $result1;
}