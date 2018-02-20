<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 20/02/2018
 * Time: 2:20 PM
 */

if (isset($_POST['getreport']))
{
    $startDate = $_POST['startDate'];
    $date = DateTime::createFromFormat('m/d/Y',$startDate);
    $start_date = $date->format("Y-m-d");


    $endDate = $_POST['endDate'];
    $format = DateTime::createFromFormat('m/d/Y',$endDate);
    $end_date = $format->format("Y-m-d");



}