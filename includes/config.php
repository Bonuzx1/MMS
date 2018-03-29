<?php
/**
 * Created by PhpStorm.
 * User: Bonuz
 * Date: 8/20/2017
 * Time: 8:09 PM
 */
ob_start();
session_start();

//$DBHOST = "localhost";

$dbname = 'project';
$dbhost = 'localhost';
$pass = 'pop9090';
$dbuser = 'root';


//set timezone
date_default_timezone_set('Europe/London');
function __autoload($class){
    $class = strtolower($class);
    $classpath = '../class/class.'.$class.'.php';
    if (file_exists($classpath)) {
        require_once $classpath;
    }
    elseif (!file_exists($classpath)){
        $classpath = './class/class.'.$class.'.php';
        if (file_exists($classpath)){
            require_once $classpath;
        }else{
            echo 'the class "'.$class.'.php" is missing';
        }
    }else{
		echo 'the class "'.$class.'.php "at "'.$classpath.'" is missing';
	}
}
$user = new DatabaseClass($dbname, $dbhost, $dbuser, $pass);
