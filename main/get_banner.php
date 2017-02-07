<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/1
 * Time: 17:07
 */

require_once 'db.php';

$value = queryMysql("SELECT * FROM banner");
if ($value == false)
    $result = false;
else {
    $data = array();

    while ($row = $value->fetch_array(MYSQLI_ASSOC)) {
        $data[] = $row;
    }
    $result =true;
}

$json = compact('result','data');
$json = json_encode($json);
echo $json;
