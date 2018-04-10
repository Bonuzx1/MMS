<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 10/04/2018
 * Time: 3:00 PM
 */
include "../includes/config.php";
if (isset($_GET['id'])&&$_GET['id']!='')
{
    $sql = "UPDATE request SET isactive = '0' WHERE requestid = ".$_GET['id'];
    if ($user->updatetabl($sql))
    {
        header('Location: sendDeleteSms.php?customer='.$_GET['cusid']);
    }else{
        echo "Error";
    }
}