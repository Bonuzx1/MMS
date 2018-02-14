<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 30/01/2018
 * Time: 2:21 PM
 */

include "../includes/config.php";





$sql = "SELECT assetid, scheduleid, cost, prioritytype, enddate, SUM(cost) FROM schedule WHERE notified = '0' GROUP BY assetid";
$param = array(
    ':startdate' => 'startdate'
);
$all = $user->select($sql, $param);
$data = array();
foreach ($all as $row ) {
    $row2 = $user->showone('assets', 'assetid', $row['assetid']);
    $num = $user->howmanyin('schedule', 'assetid', $row['assetid']);
    $price = ($row['SUM(cost)']);
    $totp = NULL;
    if ($price >= $row2['purchaseprice']) {
        $data[] = $arrayName = array(
            'scheduleid' => $row['scheduleid'],
            'assetname' => $row2['name'],
            'description' => 'This asset '.ucfirst($row2['name']).' bought at the rate of GH¢ '.$row2['purchaseprice'].
                ' has received maintenance of GH¢ '.$price. PHP_EOL. ' Advised to put on lease'. PHP_EOL.PHP_EOL.'Click this notification to continue'
        );
    }
}
echo json_encode($data);



    ?>