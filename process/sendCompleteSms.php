<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 14/04/2018
 * Time: 2:10 PM
 */


include '../smstest/SMSClass.php';
include "../includes/config.php";

$sms = new SMS();
exit;

$customer = $user->showone('customer', 'customerid', $_GET['customerid']);
$asset = $user->showone('assets', 'assetid', $_GET['assetid']);

// display debug data? TRUE/FALSE
$sms->debugMode = true;


// get these credentials from http://giantsms.mi-xtreme.ml/profile
$sms->username = "hzqwWXGk";
$sms->password = "BYFifsZPgo";

// -------------------------------------------------

// to send a message
$sender = "iCMMS"; // should not be more than 11 characters... should not include copyrighted names [ like MobileMoney :( ]
$recipient = $customer['phonenumber'];
$message = "Hello ".$customer['customername'].'. '.$_GET['description'];

echo true;

if ($sms->send($message, $recipient, $sender)){
    $stmt = 'UPDATE request SET isactive = :yes WHERE requestid = :requestid';
    $param = array(':requestid' => $_GET['requestid'], ':yes' => '0');
    if ($user->update($stmt, $param))
        echo true;
    echo false;
}

// -------------------------------------------------

// to get remaining credit balance
//$credits = $sms->balance();
