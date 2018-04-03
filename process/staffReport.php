<?php
/**
 * Created by PhpStorm.
 * User: sandra
 * Date: 02/04/2018
 * Time: 8:28 PM
 */

$data = array();

    $sql = "SELECT * FROM staff WHERE dateadded <= ".$_POST['start'];

$all = $user->select($sql, $data);

foreach ($all as $one){
    echo $one['name'];
}