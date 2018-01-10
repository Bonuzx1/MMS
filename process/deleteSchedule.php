<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 10/01/2018
 * Time: 1:15 PM
 */
include '../includes/config.php';
if (isset($_POST['Event'][0])){


    $id = $_POST['Event'][0];

    $sql = "UPDATE schedule SET iscanceled = '1'  WHERE scheduleid = ".$id;
    if ($user->updatetabl($sql))
    {
        echo "yes";
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }else {
        echo 'no';
    }

}