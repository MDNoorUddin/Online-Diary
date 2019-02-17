
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
 if(!isset($_SESSION['name']))
 {
     header("Location:login.php");
 }
 $email=$_SESSION["email"];

?>


<?php


echo '<h1 style="font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;" align
="center";> Important Remainder for Tomorrow</h1>';
$date=date('Y-m-d');
$date=strftime("%Y-%m-%d", strtotime("$date +1 day"));

$result = mysqli_query($con,"SELECT title,todo,id FROM `todo` WHERE email_id = '$email' and  date='$date'") or die('Error');
$res=$result;
$j=mysqli_num_rows($result);
if($j==0)
{
    echo "<h2 style='text-align: center;'>No to-do's Found</h2>";
}
echo '<h1></h1>';

echo '<h1><ddfdf/h1>';
echo '<h1></h1>';
?>



<div>
<?php
echo '<table id="customers"';
echo '<tr>';
    echo '<th>NO.</th>';
    echo '<th>Title</th>';
    echo '<th>View</th>';
    echo '<th>Update</th>';
  echo '</tr>';
while($row = mysqli_fetch_array($result)) {
    $k=10;
    //echo $row["title"];
    $id=$row['id'];
    echo "<tr>";
    echo '<td>' . $i. '</td><td>'.$row["title"].'</td>';
    echo '<td><a href="readtodo.php?title='.$row['title'].'&date='.$date.'&id='.$id.'" class="btn btn-info" role="button">OK</a></td>';
    echo '<td><a href="updatetodo.php?title='.$row["title"].'&date='.$date.'&id='.$id.'"class="btn btn-warning" >OK</a></td>';
    ?>
     <?php
	   //</tr>';
     $i++;
     echo "</tr>";
}
echo'<td></td>';
echo'<td></td>';
echo'<td></td>';
if($date<date('Y-m-d'))
{
  echo'<td></td>';
}
else{
echo '<td>';
?>
    <form action="" method="post">
      <button type="submit"  class="btn btn-primary" name="tsubmit">Add New </button>
      </form>
<?php
echo'</td>';
}
?>
</table>
<?php
?>
