<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 08/01/2018
 * Time: 12:17 PM
 */
$data = array();
include '../includes/config.php';

if (isset($_POST['Event'][0]))
{


    $id = $_POST['Event'][0];
    $staff = $_POST['Event'][1];
    $priority = $_POST['Event'][2];
    $ftype = $_POST['Event'][3];
    $mtype = $_POST['Event'][4];
    $cost = $_POST['Event'][6];



    //$staffid = $st[''];


    $color = '';
    if ( $priority == '1'){
        $color = '#f6856c';
    }elseif ($priority == '2'){
        $color = '#cace1e';
    }elseif ($priority == '3'){
        $color = '#068e12';
    }

    $sql = "UPDATE schedule SET frequencytype = '$ftype', staffid = '$staff', prioritytype = '$priority', maintenancetype = '$mtype',  cost = '$cost', color = '$color' WHERE scheduleid = $id";
    if ($user->updatetabl($sql))
    {
        echo "yes";
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }else {
        echo 'no';
    }

}if (isset($_POST['vent'][0]) && isset($_POST['vent'][1]) && isset($_POST['vent'][2])){


    $id = $_POST['vent'][0];
    $start = $_POST['vent'][1];
    $end = $_POST['vent'][2];

    $sql = "UPDATE schedule SET  startdate = '$start', enddate = '$end' WHERE scheduleid = $id ";
    if ($user->updatetabl($sql))
    {
        echo "yes";
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }else {
        echo 'no';
    }

}