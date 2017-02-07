<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/1/30
 * Time: 19:55
 */

require_once 'db.php';
require_once 'functions.php';
header("Content-Type:application/json;charset=utf-8");

$result = true;
$data = array();

if (isset($_GET['keyword']))
{
    $keyword = sanitizeString($_GET['keyword']);
    $group_id = queryMysql("SELECT group_id FROM question_group WHERE keyword='" .$keyword . "'");
    $group_id = $group_id->fetch_array(MYSQLI_ASSOC);
    $group_id = $group_id['group_id'];
}
else $result = false;

$data = array();
if ($result)
{
    $v = queryMysql("SELECT * FROM question WHERE group_id='" . $group_id . "'");
    if ($v == null)
    {
        $result = false;
    }
    else {
        while ($row = $v->fetch_array(MYSQLI_ASSOC)) {
            $row['answer'] = json_decode($row['answer']);
            $data[] = $row;
        }
    }
}

$json = compact('result','data');
$json = json_encode($json);
echo $json;
?>