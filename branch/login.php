<?php
   include("../includes/config.php");
   $db = $user->getconn();

   $error=""; 
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername =$_POST['username'];
      $mypassword =md5($_POST['password']);
      
      
	if($user->login($myusername, $mypassword)){

         ob_start();
         header("location: ../index.php?dashboard");
         
         // echo '<script> window.location.href="" </script>';
         exit;


       }else {
         echo "<script>alert('Wrong');</script>";
      }
   }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iMaintenance Management System</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/lib/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../assets/lib/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
<!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />-->

</head>
<body class="" style="background-color: ; background-image: url('../img/bg/main.jpg');">
    <div class="container">
        <div class="row text-center " style="padding-top:60px;">
            <div class="col-md-12">
               <h1 style="color: white; font-family: 'Arial Rounded MT Bold'">MAINTENANCE MANAGEMENT SYSTEM </h1>
            </div>
      
        </div>
   
         <div class="row " style="padding-top: 20px ">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                           
                            <div class="panel-body">
                                <form role="form" action="" method="post">
                                    <hr />
                                    <h5 style="color: white">Enter Details to Login</h5>
                                       <br />
                                       <p style="color:red">
	                                       <?php echo $error;
		                                       ?>
                                       </p>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="" name="username" class="form-control" maxlength="20" placeholder="Your Username " required/>
                                        </div>
                                                                              <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="password" class="form-control" maxlength="20" placeholder="Your Password" required />
                                        </div>
                                
                                </br>
                                     <button class="btn btn-primary" type="submit">Login</button>
                                    <hr />
                                    
                                    </form>
                            </div>
                           
                        </div>
                
                
        </div>
    </div>

</body>
</html>
