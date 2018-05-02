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
$message = "Hello ".$customer['customername'].'. The maintenance on asset "'.$asset['name'].'" has started. 
                                           You will be notified on completion'.PHP_EOL.
                                            'Thank you for using iCMMS';

if ($sms->send($message, $recipient, $sender)){
    $stmt = "UPDATE request SET isactive = '0' WHERE requestid = ".$_GET['requestid'];
    if ($user->updatetabl($stmt))
        echo true;
    echo false;
}

// -------------------------------------------------

// to get remaining credit balance
//$credits = $sms->balance();
