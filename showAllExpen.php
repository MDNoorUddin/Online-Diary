
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
 //session_start();
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

     $sum=0;

 echo '<h1 style="font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;" align
 ="center";> Total Expenditure from '.$date1.' to '.$date2.'</h1>';
 echo '<table id="customers"';
 echo '<tr>';
     echo '<th>NO.</th>';
     echo '<th>Date</th>';
     echo '<th>Name</th>';
     echo '<th>Total Items</th>';
     echo '<th>Amount</th>';
     echo '<th>Update</th>';
   echo '</tr>';
 $date=$date1;
 $i=1;
 $remainBudget=0;
 while($date<=$date2){
 $result = mysqli_query($con,"SELECT * FROM `cost` WHERE email_id = '$email' and  date='$date'") or die('Error');
 $res=$result;
 ?>
 <?php

 while($row = mysqli_fetch_array($result)) {
     //echo $row["title"];
     $id=$row['id'];
     echo "<tr>";
     echo '<td>' . $i. '</td><td>'.$date.'</td><td>'.$row["item"].'</td>';
     echo '<td>'.$row["item_num"].'</td>';
     echo '<td>'.$row["amount"].'</td>';
     echo '<td><a href="updatecost.php?remain='.$remainBudget.'&date='.$date.'&id='.$id.'"class="btn btn-warning" >OK</a></td>';
     //echo '<td><a href="updatenote.php?title='.$row["title"].'&date='.$date.'&id='.$id.'"class="btn btn-warning" >OK</a></td>';
     ?>
      <?php
        //</tr>';
      $i++;
      $sum=$sum+$row["amount"];
      echo "</tr>";
 }
$date=strftime("%Y-%m-%d", strtotime("$date +1 day"));

 }
 echo "<td></td><td></td><td></td><td>Total</td><td>$sum</td>";
}
 ?>
 </table>
</html>

