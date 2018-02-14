<?php

$pdo = new PDO('mysql:host=localhost;dbname=notify', 'root', '');

$data = array();
$sql = "SELECT * FROM notif";
foreach($pdo->query($sql) as $row){
    $data[] = $arrayName = array(
        'id' => $row['scheduleid'],
        'name' => $row['name'],
        'description' => $row['description'],
        'anything' => $row['anything']
    );
}
echo json_encode($data);