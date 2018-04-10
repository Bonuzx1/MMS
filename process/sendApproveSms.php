<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 05/04/2018
 * Time: 7:22 PM
 */

include '../smstest/SMSClass.php';
include "../includes/config.php";

$sms = new SMS();

$customer = $user->showone('customer', 'customerid', $_GET['customer']);

// display debug data? TRUE/FALSE
$sms->debugMode = true;


// get these credentials from http://giantsms.mi-xtreme.ml/profile
$sms->username = "hzqwWXGk";
$sms->password = "BYFifsZPgo";

// -------------------------------------------------

// to send a message
$sender = "iCMMS"; // should not be more than 11 characters... should not include copyrighted names [ like MobileMoney :( ]
$recipient = $customer['phonenumber'];
$message = "Hello ".$customer['customername'].". Your maintenance request has been received and will be attend to. Thanks";

if ($sms->send($message, $recipient, $sender)){
    header("Location: ../index.php?request=approved");
}

// -------------------------------------------------

// to get remaining credit balance
//$credits = $sms->balance();
