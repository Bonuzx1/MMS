<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 08/01/2018
 * Time: 12:17 PM
 */
$data = array();
include '../includes/config.php';
if (isset($_POST['staff'])) {
    $assetid = $_POST['assetname'];
    $priority = $_POST['priority'];
    $staff = $_POST['staff'];
    $type = $_POST['ftype'];
    $mtype = $_POST['mtype'];
    $sdate = $_POST['start'];
    $edeate = $_POST['end'];
    $data = array(
        'a' => $assetid,
        'b' => $priority,
        'c' => $staff,
        'e' => $type,
        'f' => $mtype,
        'g' => $sdate,
        'h' => $edeate
    );
    echo json_encode($data);
    exit;



    $sql="update schedule set assetid= '$assetid', frequencytype = '$type', maintenancetype ='$mtype', prioritytype='$priority', startdate='$sdate', enddate = '$edeate' WHERE scheduleid = ". $_POST['scheduleid'];
    if ($user->updatetabl($sql))
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }else {
        echo "<script> alert('no')</script>";
    }

}