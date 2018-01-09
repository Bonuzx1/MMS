<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 08/01/2018
 * Time: 9:41 AM
 */
//$sql = "SELECT * FROM schedule ";
include '../includes/config.php';
$data = array();
$sql = "SELECT * FROM schedule WHERE iscanceled = '0' ORDER BY scheduleid";
$allresult = $user->selectsearch($sql);
foreach ($allresult as $row ) {
    $assetid = $row['assetid'];
    $row2 = $user->showone('assets', 'assetid', $assetid);
    $data[] = array(
        'id'        =>  $row['scheduleid'],
        'title' =>  $row2['name'],
        'titleid' =>  $row['assetid'],
        'frequency' => $row['frequencytype'],
        'staffid' => $row['staffid'],
        'maintenance' => $row['maintenancetype'],
        'type'  =>  $row['prioritytype'],
        'start'     =>  $row['startdate'],
        'end'       =>  $row['enddate'],
        'color' => $row['color']
    );


}
echo json_encode($data);
?>