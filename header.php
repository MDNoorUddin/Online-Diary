<!DOCTYPE html>
<html>
<head>
<style>
body
{
  background-color:Aquamarine  ;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: DimGray ;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 34px 90px;
  text-decoration: none;
}

li a:hover {
  background-color: MediumSeaGreen;
}
</style>
</head>
<?php
include_once 'dbConnection.php';
session_start();
 $notification=0;
 $date=date('Y-m-d');
 $date=strftime("%Y-%m-%d", strtotime("$date +1 day"));
 $email=$_SESSION['email'];
  $i=0;
 $result = mysqli_query($con,"SELECT * FROM `todo` WHERE email_id = '$email' and  date='$date'") or die('Error');
 while($row= mysqli_fetch_array($result))
 {
      $i++;
      
 }
 ?>
<body>
<div >
<ul>

  <li><a class="active" href="diary.php?date=<?php  echo date('Y-m-d'); ?>" >Today</a></li>
  <li><a class="active" href="account.php">Jump To Date</a></li>
  <li><a href="profile.php">Account</a></li>
  <li><a href="alarm.php">Remainders<?php echo "($i)";?></a></li>
  <li><a href="logout.php">Log Out</a></li>
</ul>
</div>
<?php  date('Y-m-d')?>
</body>
</html>
