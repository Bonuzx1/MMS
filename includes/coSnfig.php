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

define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','1234');
define('DBNAME','project');

$db1 = new PDO("mysql:host=".DBHOST.";port=80;dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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

$user = new User($db1);
