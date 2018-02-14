<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 13/02/2018
 * Time: 7:09 PM
 */

include "../includes/config.php";
if (isset($_POST['id']))
{
    echo $_POST['id'];
    if ($user->updateone('schedule', 'notified', '1', 'scheduleid', $_POST['id'])){
        echo "ok";
    }

}