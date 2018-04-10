<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 05/04/2018
 * Time: 9:20 PM
 */

include "../includes/config.php";
$today = date('Y-m-d');
$all = null;
$useData = array();
$format = 'Y-m-d';

if (isset($_POST['startDate']) && $_POST['endDate']=='' && $_POST['startDate']!='')
{
    $sql = "SELECT * FROM customer WHERE dateadded >= :today";
    $data = [':today' => $_POST['startDate']];

    $all = $user->select($sql, $data);
    $table = '';
    foreach ($all as $one)
    {
        $table .= "<tr>
                   <td>".$one['customername']."</td>
                    <td>".$one['phonenumber']."</td>
                    <td>".$one['email']."</td>
                    <td>".$one['dateadded']."</td>
                    </tr>";
    }
    echo $table;

}elseif (isset($_POST['startDate']) && $_POST['endDate']!='' && $_POST['startDate']!='')
{
    $sql = "SELECT * FROM customer WHERE dateadded >='".$_POST['startDate']. "' AND dateadded <= '".$_POST['endDate']."'";
    $data = [':today' => $_POST['startDate']];

    $all = $user->select($sql, $data);
    $table = '';
    foreach ($all as $one)
    {
        $table .= "<tr>
                    <td>".$one['customername']."</td>
                    <td>".$one['phonenumber']."</td>
                    <td>".$one['email']."</td>
                    <td>".$one['dateadded']."</td>
                    </tr>";
    }
    if ($table == '')
        echo "<tr><td colspan='4'>No Records</td></tr>";
    echo $table;
}else{
    echo "<tr><td colspan='4'>Select Some Date</td></tr>";
}