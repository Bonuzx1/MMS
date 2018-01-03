<?php

include('config.php');


if(isset($_POST["query"]))
{

$q = $_POST["query"];
	
$sql = "SELECT * FROM assets WHERE name LIKE '%" . $q . "%'";

$allrow = $user->selectsearch($sql);
foreach($allrow as $row)
{
	 return '<tr>' . 
    '<td>' . $row['assetid'] . '</td>' . 
    '<td>' . $row['name'] . '</td>' . 
    '<td>' . $row['status'] . '</td>' .
	'<td>' . $row['departmentid'] . '</td>' .
	'</tr>';
} 

}




?>