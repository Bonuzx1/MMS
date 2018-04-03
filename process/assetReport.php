<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 20/02/2018
 * Time: 2:20 PM
 */

include "../includes/config.php";
$useData = array();
$all = null;
$format = 'Y-m-d';
$today = date('Y-m-d');

if (isset($_POST['asset']))
{

    $asset = $_POST['asset'];
    if(!isset($_POST['staff']))
    {

        if (!isset($_POST['start']))
        {
            if (!isset($_POST['end']))
            {
                $useData = [
                    ':asset' => $asset
                ];
                $sql = "SELECT * FROM schedule WHERE assetid = ".$asset;
                $all = $user->select($sql, $useData);

            }else {
                $end = $_POST['end'];
                $useData = [
                    'asset' => $asset,
                    'end' => $end
                ];
            }
        }else {
            $start = $_POST['start'];
            if (!isset($_POST['end']))
            {
                $useData = [
                    'asset' => $asset,
                    'start' => $start
                ];
                $sql = "SELECT * FROM schedule WHERE assetid = '$asset' AND startdate >= '$start'";
                $all = $user->select($sql, $useData);
            }else {
                $end = $_POST['end'];
                $useData = [
                    'asset' => $asset,
                    'start' => $start,
                    'end' => $end
                ];
                $sql = "SELECT * FROM schedule WHERE assetid = '$asset' AND startdate >= '$start' AND enddate <= '$end'";
                $all = $user->select($sql, $useData);
            }

        }
    }else {
        $staff = $_POST['staff'];
        if (!isset($_POST['start']))
        {
            if (!isset($_POST['end']))
            {
                $useData = [
                    'asset' => $asset,
                    'staff' => $staff
                ];
                $sql = "SELECT * FROM schedule WHERE assetid = '$asset' AND staffid = '$staff'";
                $all = $user->select($sql, $useData);
            }else {
                $end = $_POST['end'];
                $useData = [
                    'asset' => $asset,
                    'staff' => $staff,
                    'end' => $end
                ];
            }
        }else {
            $start = $_POST['start'];
            if (!isset($_POST['end']))
            {
                $useData = [
                    'asset' => $asset,
                    'staff' => $staff,
                    'start' => $start
                ];
                $sql = "SELECT * FROM schedule WHERE assetid = '$asset' AND staffid = '$staff' AND startdate >= '$start'";
                $all = $user->select($sql, $useData);
            }else {
                $end = $_POST['end'];
                $useData = [
                    'asset' => $asset,
                    'staff' => $staff,
                    'start' => $start,
                    'end' => $end
                ];
                $sql = "SELECT * FROM schedule WHERE assetid = '$asset' AND staffid = '$staff' AND startdate >= '$start' AND enddate <= '$end'";
                $all = $user->select($sql, $useData);
            }
        }
    }

//print_r($all); exit;
    /*

    $totalCost = null;

    $row2 = $user->showone('assets', 'assetid', $_POST['asset']);
    $useData = $row2['name'];
    echo $useData;
    foreach ($all as $item) {

        $assetid = $item['assetid'];
        $staffid = $item['staffid'];
        $row2 = $user->showone('assets', 'assetid', $assetid);
        $row3 = $user->showone('staff', 'staffid', $staffid);
        $useData = "<tr><td>".$row2['name']."</td><td>".$row3['name']."</td><td>".$item['cost']."</td></tr>";
        $totalCost += $item['cost'];
        echo $useData;
    }
    $useData .= "<tr><td colspan='2'><h4>TOTAL COST</h4></td><td><h3>".$totalCost."</h3></td>";
    echo $useData; */


//    echo array_count_values($all);
    $totalCost = null;
    foreach ($all as $item) {
        $assetid = $item['assetid'];
        $staffid = $item['staffid'];
        $row2 = $user->showone('assets', 'assetid', $assetid);
        $row3 = $user->showone('staff', 'staffid', $staffid);
        $useData[] = array(
            'date' => date($format, strtotime($item['startdate'])),
            'asset' => $row2['name'],
            'staff' => $row3['name'],
            'cost' => $item['cost']

        );
        $totalCost += $item['cost'];
    }
    $useData['total'] = $totalCost;
    echo json_encode($useData);


}