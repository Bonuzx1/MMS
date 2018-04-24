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
    $msg = '';
    $d = array();

    $updateschedule = "UPDATE schedule SET isdone = '1' WHERE scheduleid = ".$_GET['id'];

    $schedule = $user->showone('schedule', 'scheduleid', $_GET['id']);
    $request = $user->showone('request', 'requestid', $schedule['requestid']);
//    print_r($request);print_r($schedule);exit;

    $updaterequest = "UPDATE request SET isactive = '0' WHERE requestid = ".$schedule['requestid'];

    if ($ans = $user->updatetabl($updateschedule))
    {
        if ($ans = $user->updatetabl($updaterequest))
        {
            header("Location: sendCompleteSms.php?customerid=".$request['customerid']."&assetid="
                .$schedule['assetid']."&requestid=".$request['requestid']);
        }
        else{
            $msg = "Ok! We've heard you, but you have to tell the admin about it, or you wont be paid";
            header("Location: ../index.php?assignment&msg=".$msg);
        }
    }else{
        $msg = "Sorry, you have to click or tell the admin about it";
        header("Location: ../index.php?assignment&msg=".$msg);
    }




}