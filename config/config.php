<?php 
ob_start();
session_start();
// Set timezone 
date_default_timezone_set('Asia/Ho_Chi_Minh'); 
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

define('SITE_PATH',"http://localhost/shop");
$base_url="http://localhost/chtp";
$DBhost="localhost";
$DBname="chtp";
$DBuser="root";
$DBpass="";



$conn = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);
    
if ($DBcon->connect_errno) {
   die("ERROR : -> ".$DBcon->connect_error);
}
?>