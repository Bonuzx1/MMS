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
            }else {
                $end = $_POST['end'];
                $useData = [
                    'asset' => $asset,
                    'start' => $start,
                    'end' => $end
                ];
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
            }else {
                $end = $_POST['end'];
                $useData = [
                    'asset' => $asset,
                    'staff' => $staff,
                    'start' => $start,
                    'end' => $end
                ];
            }
        }
    }


    foreach ($all as $item) {
        $useData = [
            'asset' => $item['assetid'],
            'staff' => $item['staffid'],
            'cost' => $item['cost']
        ];
        echo json_encode($useData);
    }
}

