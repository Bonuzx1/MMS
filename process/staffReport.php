<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 02/04/2018
 * Time: 8:28 PM
 */

include "../includes/config.php";
$today = date('Y-m-d');
$all = null;
$useData = array();
$format = 'Y-m-d';

if (isset($_POST['startDate']) && $_POST['endDate']=='' && $_POST['startDate']!='')
{
    $sql = "SELECT * FROM staff WHERE dateadded >= :today";
    $data = [':today' => $_POST['startDate']];

    $all = $user->select($sql, $data);
    $table = '';
    foreach ($all as $one)
    {
        $table .= "<tr>
                    <td>".$one['name']."</td>
                    <td>".$one['dob']."</td>
                    <td>".$one['gender']."</td>
                    <td>".$one['contact']."</td>
                    <td>".$one['dateadded']."</td>
                    </tr>";
    }
    echo $table;

}elseif (isset($_POST['startDate']) && $_POST['endDate']!='' && $_POST['startDate']!='')
{
    $sql = "SELECT * FROM staff WHERE dateadded >='".$_POST['startDate']. "' AND dateadded <= '".$_POST['endDate']."'";
    $data = [':today' => $_POST['startDate']];

    $all = $user->select($sql, $data);
    $table = '';
    foreach ($all as $one)
    {
        $table .= "<tr>
                    <td>".$one['name']."</td>
                    <td>".$one['dob']."</td>
                    <td>".$one['gender']."</td>
                    <td>".$one['contact']."</td>
                    <td>".$one['dateadded']."</td>
                    </tr>";
    }
    echo $table;
}else{
    echo "No Records Found";
}