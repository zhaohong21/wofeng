<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/4
 * Time: 12:42
 */

require_once 'header.php';
require_once 'functions.php';
$group_id = '';

if (!$loggedin)
{
    header("Location: ./login");
    exit();
}

if (isset($_GET['id']))
{
    $id = sanitizeString($_GET['id']);

    if ($row = queryMysql("SELECT group_id FROM question WHERE id=$id")) {
        if ($row->num_rows)
        {
            $row = $row->fetch_array(MYSQLI_ASSOC);
            $group_id = $row['group_id'];
        }
    }
    $query = queryMysql("DELETE FROM question WHERE id=$id");
}
header("Location: ./getGroupProblem?group_id=$group_id");
exit();