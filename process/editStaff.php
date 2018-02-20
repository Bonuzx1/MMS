<?php
include '../includes/config.php';

$id = $_SESSION['id'];

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $phone = $_POST['number'];
    $email = $_POST['email'];
    $status = $_POST['active'];

    $sql = "UPDATE staff SET name = '$name', dob = '$dob', contact = '$phone', email = '$email', active = '$status' WHERE staffid = '$id'";
    if($user->updatetabl($sql))
    {
        header("Location: ../index.php?staff=edited");
    }else {
        header("Location: ../index.php?staff=not-edited");
    }
    
    
}