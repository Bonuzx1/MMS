<?php
include '../includes/config.php';
$all = "";
if (isset($_POST['schtxt'])||isset($_POST['searchbutton'])) {
	echo "string";

	$fullrow = $user->search('assets',$_POST['schtxt']);
	foreach ($fullrow as $row) {
		$all = "<tr>";
		$all .= "<td>".$row['id']."</td>";
		$all .= "<td>".$row['name']."</td>";
		$all .= "<td>".$row['status']."</td>";
		$all .= "<td>".$row['departmentid']."</td>";
		$all .= "<td>".$row['locationid']."</td>";
		$all = "</tr>";
	}
	echo $all;
}


?>