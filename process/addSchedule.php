<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 08/01/2018
 * Time: 12:06 PM
 */
include '../includes/config.php';
if (isset($_POST['staff'])) {
    $sql = "INSERT INTO schedule(assetid, frequencytype, staffid, prioritytype, maintenancetype, startdate, enddate) VALUES(:assetname, :frequency, :staff, :priority, :type, :start, :end) ";
    $param = array(':assetname' => $_POST['assetname'],
        ':priority' => $_POST['priority'],
        ':frequency' => $_POST['ftype'],
        ':staff' => $_POST['staff'],
        ':type' => $_POST['mtype'],
        ':start' => $_POST['start'],
        ':end' => $_POST['end']);
    if ($user->insert($sql, $param))
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
}
//header('Location: '.$_SERVER['HTTP_REFERER']);