<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 10/04/2018
 * Time: 6:23 PM
 */

include "../includes/config.php";



$today = date('Y-m-d');

$sql = "SELECT * FROM request WHERE isactive = '1'";
// print_r($sql);
$param = array(
    ':startdate' => 'startdate'
);
$all = $user->select($sql, $param);
// print_r($all);
$data = array();
foreach ($all as $row ) {
    if ($row['datedue'] <= $today)
    {
        
    
    $row2 = $user->showone('assets', 'assetid', $row['assetid']);
//    $num = $user->howmanyin('schedule', 'assetid', $row['assetid']);
    $totp = NULL;

        $data[] = $arrayName = array(
            'requestid' => $row['requestid'],
            'assetid' => $row['assetid'],
            'customerid' => $row['customerid']
        );
    }
}
echo json_encode($data);



    ?>