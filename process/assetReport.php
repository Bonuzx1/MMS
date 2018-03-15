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
                $sql = "SELECT assetid, staffid, cost FROM schedule WHERE assetid = ".$asset;
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
    foreach ($all as $item) {
        $useData = "<tr><td>".$item['assetid']."</td><td>".$item['staffid']."</td><td>".$item['cost']."</td></tr>";
        echo $useData;
    }

}