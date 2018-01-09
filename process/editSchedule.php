<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 08/01/2018
 * Time: 12:17 PM
 */
$data = array();
include '../includes/config.php';
if (isset($_POST['tytty'])) {
    //$assetid = $_POST['assetid'];
    $priority = $_POST['priority'];
    $staff = $_POST['staff'];
    $type = $_POST['ftype'];
    $mtype = $_POST['mtype'];
    $sdate = $_POST['start'];
    $edeate = $_POST['end'];

    $sql="update schedule set frequencytype = '$type', maintenancetype ='$mtype', prioritytype='$priority', startdate='$sdate', enddate = '$edeate' WHERE scheduleid = ". $_POST['id'];
    if ($sql) {
        echo json_encode($_POST);
        exit;
    }
    if ($user->updatetabl($sql))
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }else {
        echo "<script> alert('no')</script>";
    }

}elseif (isset($_POST['Event'][5]) && ($_POST['Event'][5] =='1') && isset($_POST['Event'][1])){


    $id = $_POST['Event'][0];

    $sql = "UPDATE schedule SET iscanceled = '1'  WHERE scheduleid = ".$id;
    if ($user->updatetabl($sql))
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }else {
        echo "<script> alert('no')</script>";
    }

}
elseif (isset($_POST['Event'][0]))
{


    $id = $_POST['Event'][0];
    $staff = $_POST['Event'][1];
    $priority = $_POST['Event'][2];
    $ftype = $_POST['Event'][3];
    $mtype = $_POST['Event'][4];

    $color = '';
    if ( $priority == '1'){
        $color = '#f6856c';
    }elseif ($priority == '2'){
        $color = '#cace1e';
    }elseif ($priority == '3'){
        $color = '#068e12';
    }

    $sql = "UPDATE schedule SET frequencytype = '$ftype', staffid = '$staff', prioritytype = '$priority', maintenancetype = '$mtype', color = '$color' WHERE scheduleid = $id";
    if ($user->updatetabl($sql))
    {
        die ('OK');
    }else {
        echo "fail";
    }

}if (isset($_POST['vent'][0]) && isset($_POST['vent'][1]) && isset($_POST['vent'][2])){


    $id = $_POST['vent'][0];
    $start = $_POST['vent'][1];
    $end = $_POST['vent'][2];

    $sql = "UPDATE schedule SET  startdate = '$start', enddate = '$end' WHERE scheduleid = $id ";
    $g = $user->updatetabl($sql);
    return $g;

}