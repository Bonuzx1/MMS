<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 20/02/2018
 * Time: 2:20 PM
 */

include "../includes/config.php";
if (isset($_POST['asset']))
{

    $asset = $_POST['asset'];
    $staff = $_POST['staff'];


    $startDate = $_POST['start'];
    $date = strtotime($startDate);
    $start_date = date('Y-m-d H-s-s', $date);
    echo $start_date;


    $endDate = $_POST['end'];
    $date = strtotime($endDate);
    $end_date = date('Y-m-d H-s-s', $date);
    echo $end_date;



    $data = array();


    $sql = "SELECT * FROM schedule WHERE assetid = ':asset' BETWEEN ':start_date' AND ':end_date'";
    $param = [':asset' => $asset, ':start_date' => $start_date, ':end_date' => $end_date];
    $all = $user->select($sql, $param);
    foreach ($all as $row){
        $data = [
            'assetid' => $row['assetid'],
            'staffid' => $row['staffid'],
            'start_date' => $row['startdate']
        ];
    }
    echo json_encode($data);
}