<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 08/01/2018
 * Time: 12:06 PM
 */

$_SESSION['done'] = false;
include '../includes/config.php';
if (isset($_POST['staff'])) {

    if ($_POST['end']==""){
        $end = $_POST['customend'];
    }else{
        $end = $_POST['end'];
    }


    $start = $_POST['start'];



    $color = '';
    if ( $_POST['priority'] == '1'){
        $color = '#f6856c';
    }elseif ($_POST['priority'] == '2'){
        $color = '#cace1e';
    }elseif ($_POST['priority'] == '3'){
        $color = '#068e12';
    }

    $freq = $_POST['ftype'];
    if ($freq=='2')
    {
        echo $color;


        $start = strtotime($start);
        $end = strtotime($end);

        $diff=$end - $start;
        echo $days = floor($diff / (60*60*24) );
        $numberoftime = ($days/7);
        $start = date("Y-m-d H:i:s", $start);
        for ($i = 0; $i<$numberoftime; $i++)
        {
            $end = $start;
            $sql = "INSERT INTO schedule(assetid, frequencytype, staffid, prioritytype, maintenancetype, cost, startdate, enddate, color) VALUES(:assetname, :frequency, :staff, :priority, :type, :cost, :start, :end, :color) ";
            $param = array(':assetname' => $_POST['assetname'],
                ':priority' => $_POST['priority'],
                ':frequency' => $_POST['ftype'],
                ':staff' => $_POST['staff'],
                ':type' => $_POST['mtype'],
                ':cost' => $_POST['cost'],
                ':start' => $start,
                ':end' => $end,
                ':color' => $color);
            if(!$user->insert($sql, $param))
                echo "No";
            $start=strftime("%Y-%m-%d %H:%M:%S", strtotime("$start +7 day"));
            $end = $start;
        }


        header('Location: '.$_SERVER['HTTP_REFERER']);
    }elseif ($freq=='1')
    {
        echo $color;
        $start = strtotime($start);
        $end = strtotime($end);

        $diff=$end - $start;
        echo $days = floor($diff / (60*60*24) );
        $numberoftime = ($days/1);
        $start = date("Y-m-d H:i:s", $start);
        for ($i = 0; $i<$numberoftime; $i++)
        {
            $end = $start;
            $sql = "INSERT INTO schedule(assetid, frequencytype, staffid, prioritytype, maintenancetype, cost, startdate, enddate, color) VALUES(:assetname, :frequency, :staff, :priority, :type, :cost, :start, :end, :color) ";
            $param = array(':assetname' => $_POST['assetname'],
                ':priority' => $_POST['priority'],
                ':frequency' => $_POST['ftype'],
                ':staff' => $_POST['staff'],
                ':type' => $_POST['mtype'],
                ':cost' => $_POST['cost'],
                ':start' => $start,
                ':end' => $end,
                ':color' => $color);
            if(!$user->insert($sql, $param))
                echo "No";
            $start=strftime("%Y-%m-%d %H:%M:%S", strtotime("$start +1 day"));
            $end = $start;
        }

        header('Location: '.$_SERVER['HTTP_REFERER']);
    }elseif ($freq=='3')
    {
        echo $color;
        $start = strtotime($start);
        $end = strtotime($end);

        $diff=$end - $start;
        echo $days = floor($diff / (60*60*24) );
        $numberoftime = ($days/30);
        $start = date("Y-m-d H:i:s", $start);
        for ($i = 0; $i<$numberoftime; $i++)
        {
            $end = $start;
            $sql = "INSERT INTO schedule(assetid, frequencytype, staffid, prioritytype, maintenancetype, cost, startdate, enddate, color) VALUES(:assetname, :frequency, :staff, :priority, :type, :cost, :start, :end, :color) ";
            $param = array(':assetname' => $_POST['assetname'],
                ':priority' => $_POST['priority'],
                ':frequency' => $_POST['ftype'],
                ':staff' => $_POST['staff'],
                ':type' => $_POST['mtype'],
                ':cost' => $_POST['cost'],
                ':start' => $start,
                ':end' => $end,
                ':color' => $color);
            if(!$user->insert($sql, $param))
                echo "No";
            $start=strftime("%Y-%m-%d %H:%M:%S", strtotime("$start +30 day"));
            $end = $start;
        }

        header('Location: '.$_SERVER['HTTP_REFERER']);
    }else{
        echo $color;
        $sql = "INSERT INTO schedule(assetid, frequencytype, staffid, prioritytype, maintenancetype, cost, startdate, enddate, color) VALUES(:assetname, :frequency, :staff, :priority, :type, :cost, :start, :end, :color) ";
        $param = array(':assetname' => $_POST['assetname'],
            ':priority' => $_POST['priority'],
            ':frequency' => $_POST['ftype'],
            ':staff' => $_POST['staff'],
            ':type' => $_POST['mtype'],
            ':cost' => $_POST['cost'],
            ':start' => $start,
            ':end' => $end,
            ':color' => $color);
        if(!$user->insert($sql, $param))
            echo "Nope";
        else
            if (isset($_POST['req']) && $_POST['req'] != ''){
                $stmt = 'UPDATE request SET isactive = :one WHERE requestid = :requestid';
                $param = array(':one' => '0', ':requestid' => $_POST['req']);
                $user->update($stmt, $param);
                header('Location: ../index.php?request=approved');
                exit;
            }
            header('Location: '.$_SERVER['HTTP_REFERER']);


    }

}
//