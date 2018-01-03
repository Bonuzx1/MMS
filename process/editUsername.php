<?php
include '../includes/config.php';

if(isset($_POST['changename']))
{
    $name = $_POST['username'];
    $id = $_POST['userid'];
    

    $sql = "UPDATE user SET username = '$name' WHERE id = '$id'";
    if($user->updatetable($sql))
    {
        
        $_SESSION['username'] = $name;
        echo '<script> window.location.href="../index.php?setting=edited";</script>';
    }else {
        echo '<script> window.location.href="../index.php?setting=notedited";</script>';
    }
}
elseif (isset($_POST['changepass']))
{
    $id = $_POST['userid'];
    $password = $_POST['password'];
    $row = $user->showone('user','id',$id);
    $pass = $row['password'];
    if($password == $pass)
    {
        $name = $_POST['npassword'];
        $name1 = $_POST['cpassword'];
        if($name == $name1)
        {
            $sql = "UPDATE user SET password = ".$name."WHERE id = ".$id;
            if($user->updatetable($sql))
            {
                header("location: ../index.php?setting=edited");
                //echo '<script> window.location.href="../setting.php?edited";</script>';
            }else {
                header("Location: ../index.php?setting=notedited");
                //echo '<script> window.location.href="../setting.php?notedited";</script>';
            }
        }else { ?>
            <script>alert("Not the same Password")</script>
            echo '<script> window.location.href="../index.php?setting";</script>';
       <?php }
    }else { ?>
        <script>alert("Wrong Current Password")</script>
        echo '<script> window.location.href="../index.php?setting";</script>';
   <?php }
}