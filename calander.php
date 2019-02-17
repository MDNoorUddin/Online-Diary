<?php 
 include_once 'dbConnection.php';
 include_once 'header.php';
 session_start();
 if(!isset($_SESSION['name']))
 {
     header("Location:login.php");
 }
 if(isset($_SESSION['name']))
 {
     echo $_SESSION['name'];
 }

?>