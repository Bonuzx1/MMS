<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 19/04/2018
 * Time: 9:02 PM
 */
include "../includes/config.php";
if (isset($_GET['id']) && $_GET['id'] != '')
{
    $d = array();

    $updateschedule = "UPDATE schedule SET isdone = '1' WHERE scheduleid = ".$_GET['id'];

    $schedule = $user->showone('schedule', 'scheduleid', $_GET['id']);

    $updaterequest = "UPDATE request SET isactive = '0' WHERE requestid = ".$schedule['requestid'];

    print_r($updateschedule);print_r($schedule);print_r($updaterequest);exit;




}