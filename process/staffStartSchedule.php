<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 19/04/2018
 * Time: 9:02 PM
 */
include "../includes/config.php";
if (isset($_GET['sch']) && $_GET['sch'] != '')
{
    $msg = '';
    $d = array();

    $updateschedule = "UPDATE schedule SET isdone = '2' WHERE scheduleid = ".$_GET['sch'];

    $schedule = $user->showone('schedule', 'scheduleid', $_GET['sch']);
    if ($schedule['requestid'] == NULL){
        if ($ans = $user->updatetabl($updateschedule))
        {
            $msg = "Sent successfully";
            header("Location: ../index.php?assignment&msg=".$msg);
        }else{
            $msg = "Sorry, you have to try again or tell the admin about it";
            header("Location: ../index.php?assignment&msg=".$msg);
        }
    }else {
        $request = $user->showone('request', 'requestid', $schedule['requestid']);
//    print_r($request);print_r($schedule);exit;

//    $updaterequest = "UPDATE request SET isactive = '0' WHERE requestid = ".$schedule['requestid'];

        if ($ans = $user->updatetabl($updateschedule)) {
            header("Location: sendStartSms.php?customerid=" . $request['customerid'] . "&assetid="
                . $schedule['assetid'] . "&requestid=" . $request['requestid']);
        } else {
            $msg = "Sorry, you have to try again or tell the admin about it";
            header("Location: ../index.php?assignment&msg=" . $msg);
        }
    }




}