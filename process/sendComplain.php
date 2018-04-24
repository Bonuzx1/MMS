<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 23/04/2018
 * Time: 1:04 PM
 */

include "../includes/config.php";
if(isset($_POST['submitcomplain'])) {
    $subject = $_POST['subject'];
    $complain_text = $_POST['complain_text'];

    $fullMessage = nl2br($subject ."|". $complain_text);

    $sql = 'UPDATE schedule SET complain = :message, isdone = "0", staffid = "0" WHERE scheduleid = '.$_POST["scheduleid"];
    $data = [
        ':message' => $fullMessage
    ];
    if ($all = $user->update($sql, $data))
    {
        $msg = "Complain sent succesfully";
        header("Location: ".$_SERVER['HTTP_REFERER']."&msg=".$msg);
    }else{
        $msg = "Herh! Go to admin and tell them youself!";
        header("Location: ".$_SERVER['HTTP_REFERER']."&msg=".$msg);
    }
}