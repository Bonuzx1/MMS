<?php
include '../includes/config.php';

$id = $_SESSION['staff-id'];

if(isset($_POST['submit']))
{
    $imageFileType = ".jpg";
    $tr =  unlink("../img/profile/".$id.$imageFileType);
    $target_dir = "../img/profile/";
    $target_file = $target_dir . basename($_FILES["imgupdate"]["name"]);
    $uploadOk = 1;


    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $phone = $_POST['number'];
    $email = $_POST['email'];
    $status = $_POST['active'];

    $sql = "UPDATE staff SET name = '$name', dob = '$dob', contact = '$phone', email = '$email', active = '$status' WHERE staffid = '$id'";
    if($user->updatetabl($sql))
    {
        if ($tr = move_uploaded_file($_FILES["imgupdate"]["tmp_name"], $target_dir . $id . $imageFileType)){
            $msg = "Staff updated successfully";
            header("Location: ../index.php?staff=".$msg);
        } else {
            $msg = "Updated staff but could not upload image";
            header("Location: ../index.php?staff=".$msg);
        }
    }else {
        $msg = "Could not update ";
        header("Location: ../index.php?staff=".$msg);
    }
    
    
}