<?php 
include_once 'header.php';
//session_start();
if(isset($_SESSION['email'])){
session_destroy();}
header("Location:login.php");
?>