<?php
/**
 * Created by PhpStorm.
 * User: zhaoh
 * Date: 2017/2/1
 * Time: 12:23
 */

$row = '[[&quot;26&quot;,[&quot;A&quot;]],[&quot;27&quot;,[&quot;A&quot;]],[&quot;28&quot;,[&quot;A&quot;]],[&quot;29&quot;,[&quot;A&quot;]]]';
$row = htmlspecialchars_decode($row);
echo $row;
$row = json_decode($row);
print_r($row);