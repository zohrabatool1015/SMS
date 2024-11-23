<?php
 $db_conn = mysqli_connect('localhost', 'root', '', 'sms-database');

 if (!$db_conn) {
    echo 'Connection Failed';
 }
 session_start();
 //if(empty($_SESSION)){
 //    session_start();
 //}
 date_default_timezone_set("Asia/Karachi");

 include('functions.php');
?>