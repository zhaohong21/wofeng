<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/3
 * Time: 20:51
 */

require_once 'header.php';
require_once 'functions.php';
if (!$loggedin)
{
    header("Location: ./login");
    exit();
}

$id = '';

if (isset($_POST['id'])) $id = sanitizeString($_POST['id']);

if ($id != '')
{
    queryMysql("DELETE FROM question_group WHERE group_id=$id");
    queryMysql("DELETE FROM question WHERE group_id=$id");
}

header("Location: ./queryProblemGroup");
exit();