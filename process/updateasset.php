<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 30/01/2018
 * Time: 6:31 PM
 */
include "../includes/config.php";
if (isset($_POST['a'])){
    echo $_POST['a'];
    if($user->updateone('schedule', 'notified', '1', 'assetid', $_POST['a'])){
        echo 'gh';
    }

}