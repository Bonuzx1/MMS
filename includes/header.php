<?php
$sho = "";
   include('includes/config.php');
   if(!$user->isloggedin() == 1){
    header("Location: branch/login.php");
   };
   ?>

<!DOCTYPE html>
<html>

<head>
    <title>iMaintenance Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="assets/lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/lib/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fullcalendar.min.css">
<!--    <link rel="stylesheet" type="text/css" href="assets/css/fullcalendar.print.min.css">-->


    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/themes/flat-blue.css">

    <script type="text/javascript" src="assets/lib/js/jquery.min.js"></script>
    <link type="text/css" href="assets/css/jquery-ui.css" />
    <link type="text/css" href="assets/css/jquery-ui.theme.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/lib/css/bootstrap-switch.min.css">



</head>

<body class="flat-blue" onload="checkinput()">
<script>
    function checkinput() {
        $( "input[type=text]" ).keypress(function(e) {
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
            }
        });
    }
</script>
<!-- <body class="flat-blue" oncontextmenu="return false"> -->
<div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown profile">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?php
                                        echo $_SESSION['username'];
                                        ?>
                                        <span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li>
                                    <div class="profile-info">
                                     
                                        <div role="group">
                                            <a href="index.php?setting" class="btn btn-default"><i class="fa fa-user"></i> Settings</a>
                                            <a href="branch/logout.php" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="side-menu sidebar-inverse">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                <div class="icon fa fa-paper-plane"></div>
                                <div class="title">iMaintenance Panel <?php echo $sho;?></div>
                            </a>
                            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a href="index.php?dashboard">
                                    <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
                                </a>
                            </li>
                            <li>
                            <a href="index.php?order">
                                <span class="icon fa fa-tags"></span><span class="title">Work Orders</span>
                            </a>
                        </li>
                            <li>
                            <a href="index.php?asset">
                                <span class="icon fa fa-cubes"></span><span class="title">Assets</span>
                            </a>
                        </li>
                            <li>
                            <a href="index.php?dept">
                                <span class="icon fa fa-building-o"></span><span class="title">Sections/Department</span>
                            </a>
                        </li>
                            <li>
                            <a href="index.php?staff">
                                <span class="icon fa fa-users"></span><span class="title">Staffs</span>
                            </a>
                        </li>
                            <li>
                            <a href="index.php?customer">
                                <span class="icon fa fa-thumbs-o-up"></span><span class="title">Customers</span>
                            </a>
                        </li>
                            <li>
                            <a href="index.php?supply">
                                <span class="icon fa fa-cubes"></span><span class="title">Supplies</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?location">
                                <span class="icon fa fa-map-marker"></span><span class="title">Location</span>
                            </a>
                        </li>
                            <li>
                                <a href="index.php?report">
                                    <span class="icon fa fa-bar-chart"></span><span class="title">Reports</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    </nav>
            </div>

