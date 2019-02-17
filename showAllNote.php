
<html>
<head>
  <title></title>


<style>
body {
 background-color:Aquamarine  ;
}
#customers {
  position:absolute;
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 80%;
  left: 230px;
}

#budget
{
    background-color:Tomato;
 border-width: 5px;
  border-color:Black ;
  border-top-style: dotted;
  border-right-style: dotted;
  border-bottom-style: dotted;
  border-left-style: dotted;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 28px;
}

#customers tr:nth-child(all){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers tr {background-color:LightBlue ;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: DimGray;
  color: white;
}
</style>
</head>
<?php
 include_once 'dbConnection.php';

 ?>

 <?php
// session_start();
 include_once 'header.php';
 $email=$_SESSION["email"];
 $date1=$_GET['d1'];
 $date2=$_GET['d2'];

 ?>

<?php



?>

   <?php
 if(!isset($_SESSION['name']))
 {
     header("Location:login.php");
 }

 if(isset($_GET['d1'])){

 echo '<h1 style="font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;" align
 ="center";> Notes from '.$date1.' to '.$date2.'</h1>';
 echo '<table id="customers"';
 echo '<tr>';
     echo '<th>NO.</th>';
     echo '<th>Date</th>';
     echo '<th>Title</th>';
     echo '<th>View</th>';
     echo '<th>Update</th>';
   echo '</tr>';
 $date=$date1;
 $i=1;
 while($date<=$date2){
 $result = mysqli_query($con,"SELECT title,paragraph,id,trash FROM `article` WHERE email_id = '$email' and  date='$date'") or die('Error');
 $res=$result;
 ?>
 <?php

 while($row = mysqli_fetch_array($result)) {
     //echo $row["title"];
     if($row['trash']==1)continue;
     $id=$row['id'];
     echo "<tr>";
     echo '<td>' . $i. '</td><td>'.$date.'</td><td>'.$row["title"].'</td>';
     echo '<td><a href="read.php?title='.$row['title'].'&date='.$date.'&id='.$id.'" class="btn btn-info" role="button">OK</a></td>';
     echo '<td><a href="updatenote.php?title='.$row["title"].'&date='.$date.'&id='.$id.'"class="btn btn-warning" >OK</a></td>';
     ?>
      <?php
        //</tr>';
      $i++;
      echo "</tr>";
 }
$date=strftime("%Y-%m-%d", strtotime("$date +1 day"));

 }
}
 ?>
 </table>
</html>
