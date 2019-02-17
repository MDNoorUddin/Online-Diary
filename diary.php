
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
 $date=$_GET['date'];

 $month = date("m",strtotime($date));
 $year = date("y",strtotime($date));
 ?>
 <form action="" method="post">
      <input type="submit" name="note" value="notes">
      <input type="submit" name="to-do" value="to-do's">
      <input type="submit" name="cost" value="cost management">
   </form>

<?php

   if(!isset($_SESSION['count']))
   {
     $_SESSION['count']=1;
   }
////////////////////////////////////////////////// budget calculate
///////////////////////////////////////////////////

$q7=mysqli_query($con,"select * from budget where  email_id='$email' and year='$year' and month='$month'");
$q24=mysqli_query($con,"select * from remainBudget where  email_id='$email' and year='$year' and month='$month'");

$q9=mysqli_query($con,"select * from expen where  email_id='$email' and year='$year' and month='$month'");
$budget=0;
$expen=0;
$remainBudget=0;
if($q7)
{
    //echo "successfully  done\n";
    $jj=0;
        while($ro = mysqli_fetch_array($q7)) {
            $budget=$ro['budget'];
            $jj++;
        }
        //echo $budget;
}
else
{

}

if($q24)
{
    //echo "successfully  done\n";
    $jj=0;
        while($ro = mysqli_fetch_array($q24)) {
            $remainBudget=$ro['budget'];
            $jj++;
        }
        //echo $budget;
}
else
{

}


if($q9)
{
    $jj=0;
        while($ro = mysqli_fetch_array($q9)) {
            $expen=$ro['budget'];
            $jj++;
        }
       // echo $expen;
}
else
{

}

if(isset($_POST['bsubmit']))
{
    $newBudget=$_POST['budget'];
    if(!is_numeric($newBudget))
    {
        echo '<script language="javascript">';
        echo 'alert("Your input format is incorrect")';
        echo '</script>';
    }
    else{
    $q10=mysqli_query($con,"select * from budget where  email_id='$email' and year='$year' and month='$month'");
    if($q10)
    {
        $siz=mysqli_num_rows($q10);
        if($siz==0)
        {
            $q11=mysqli_query($con,"INSERT INTO budget (email_id,month,year,budget) VALUES  ('$email','$month', '$year','$newBudget')");
            $q20=mysqli_query($con,"INSERT INTO remainBudget (email_id,month,year,budget) VALUES  ('$email','$month', '$year','$newBudget')");

        }
        else
        {
            $q12=mysqli_query($con,"UPDATE  budget set budget='$newBudget' where email_id='$email' and month='$month' and
             year='$year'");
            $q22=mysqli_query($con,"UPDATE  remainBudget set budget='$newBudget' where email_id='$email' and month='$month' and
             year='$year'");
        }
    }
    echo '<script language="javascript">';
    echo 'alert("Budget Successfully Updated, Please Reload The Page to continue")';
    echo '</script>';

  }
}

?>

   <?php
 if(!isset($_SESSION['name']))
 {
     header("Location:login.php");
 }
 if(isset($_POST['submit']))
    {
        $_SESSION['count']=1;
        header("Location:add.php?date=".$_GET['date']."");
        //header("location:diary.php?date=".$_POST['date']."");
    }
    if(isset($_POST['tsubmit']))
    {
        $_SESSION['count']=2;
        header("Location:addtodo.php?date=".$_GET['date']."");
        //header("location:diary.php?date=".$_POST['date']."");
    }
    $count=1;
    if(isset($_POST['csubmit']))
    {
        //echo "hai I am here";
        //$count=3;
        $_SESSION['count']=3;
        $item=$_POST['item_name'];
        $num=$_POST['item_num'];
        $amount=$_POST['amount'];
        if(!is_numeric($amount) Or !is_numeric($num))
        {
            echo '<script language="javascript">';
            echo 'alert("Your input format is incorrect")';
            echo '</script>';
        }
        else{
        echo $remainBudget;
        $email=$_SESSION['email'];
        $d=$_GET['date'];
        ?>
            <?php
        if($amount>$remainBudget)
        {
            echo '<script language="javascript">';
            echo 'alert("Your are out of balance")';
            echo '</script>';
        }
        else{

        $q220=mysqli_query($con,"UPDATE  remainBudget set budget=$remainBudget-$amount where email_id='$email' and month='$month' and
             year='$year'");
             if($q220)
             {

             }
        $q3=mysqli_query($con,"INSERT INTO cost (email_id,date,item,item_num,amount) VALUES  ('$email','$d', '$item','$num','$amount')");
        if($q3)
        {
            //echo "successfully  done\n";
            $q4=mysqli_query($con,"select *  from expen where email_id='$email' and month='$month' and year ='$year'");
            $bud=0;
            $jj=0;
            if($q4){
                echo "here";
                while($ro = mysqli_fetch_array($q4)) {
                    $bud=$ro['budget'];
                    $jj++;
                }
              $bud=$bud+$amount;
              $q6=mysqli_query($con,"UPDATE expen set budget='$bud' WHERE email_id='$email'
              and year='$year' and month='$month'");
              echo $jj;
              if($jj==0)
              {
                $q5=mysqli_query($con,"INSERT INTO expen (email_id,year,month,budget) VALUES  ('$email','$year', '$month','$amount')");
              }
            }
            else
            {
                echo 'uh oh';
                $q5=mysqli_query($con,"INSERT INTO expen (email_id,year,month,budget) VALUES  ('$email','$year', '$month','$amount')");
            }
        }
        else
        {
            echo "please try again\n";
        }
    }
  }

     header("Location:diary.php?date=$date");
    }
    //-------------------------------

/*$q7=mysqli_query($con,"select * from budget where  email_id='$email' and year='$year' and month='$month'");
$q24=mysqli_query($con,"select * from remainBudget where  email_id='$email' and year='$year' and month='$month'");

$q9=mysqli_query($con,"select * from expen where  email_id='$email' and year='$year' and month='$month'");
$budget=0;
$expen=0;
$remainBudget=0;
if($q7)
{
    //echo "successfully  done\n";
    $jj=0;
        while($ro = mysqli_fetch_array($q7)) {
            $budget=$ro['budget'];
            $jj++;
        }
        //echo $budget;
}
else
{

}

if($q24)
{
    //echo "successfully  done\n";
    $jj=0;
        while($ro = mysqli_fetch_array($q24)) {
            $remainBudget=$ro['budget'];
            $jj++;
        }
        //echo $budget;
}
else
{

}


if($q9)
{
    $jj=0;
        while($ro = mysqli_fetch_array($q9)) {
            $expen=$ro['budget'];
            $jj++;
        }
       // echo $expen;
}
else
{

}*/

   ?>
    <div id="budget" style="position:absolute;width:210px;height:250px;left:10px;top:255px;;background-color:Show ;">

    <h3>Budget</h3>
    <h4> Total Budget <?php echo $budget;?> </h4>
    <h4> Remainning Budget <?php echo $remainBudget;?> </h4>
    <h4> Total Expendeature <?php echo $expen;?> </h4>
    <form action="" method="post">
     <input type="text" style="width:200px;" name="budget">
     <button type="submit" name="bsubmit">Update</button>
    </form>

   </div>
   <?php


    //----------------------------------

    $count=0;
    if(isset($_POST['note']))
    {
        $count=1;
    }
    else if(isset($_POST['to-do']))
    {
        $count=2;
    }
    else if(isset($_POST['cost']))
    {
        $count=3;
    }
    else
    $count=$_SESSION['count'];
/// budget
?>
<?php
if($count==1){
echo '<h1 style="font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;" align
="center";> Notes of '.$date.'</h1>';
//echo "<h2 style='text-align: center;'>".$date."</h2>";
$i=1;
$j=1;
$result = mysqli_query($con,"SELECT title,paragraph,id,trash FROM `article` WHERE email_id = '$email' and  date='$date'") or die('Error');
$res=$result;
$j=mysqli_num_rows($result);
if($j==0)
{
    echo "<h2 style='text-align: center;'>No Notes Found</h2>";
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
    if($row['trash']==1)
    {
        continue;
    }
    $k=10;
    //echo $row["title"];
    $id=$row['id'];
    echo "<tr>";
    echo '<td>' . $i. '</td><td>'.$row["title"].'</td>';
    echo '<td><a href="read.php?title='.$row['title'].'&date='.$_GET['date'].'&id='.$id.'" class="btn btn-info" role="button">OK</a></td>';
    echo '<td><a href="updatenote.php?title='.$row["title"].'&date='.$_GET['date'].'&id='.$id.'"class="btn btn-warning" >OK</a></td>';
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
      <button type="submit"  class="btn btn-primary" name="submit">Add New </button>
      </form>
<?php
echo'</td>';
}
?>
</table>
<?php
}
else if($count==2)
{
    echo '<h1 style="font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;" align
="center";> To-do List of '.$date.'</h1>';
$i=1;
$j=1;
$result = mysqli_query($con,"SELECT title,todo,id,status FROM `todo` WHERE email_id = '$email' and  date='$date'") or die('Error');
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
    echo '<th>Status</th>';
  echo '</tr>';
while($row = mysqli_fetch_array($result)) {
    $k=10;
    //echo $row["title"];
    $id=$row['id'];
    echo "<tr>";
    echo '<td>' . $i. '</td><td>'.$row["title"].'</td>';
    echo '<td><a href="readtodo.php?title='.$row['title'].'&date='.$_GET['date'].'&id='.$id.'" class="btn btn-info" role="button">OK</a></td>';
    echo '<td><a href="updatetodo.php?title='.$row["title"].'&date='.$_GET['date'].'&id='.$id.'"class="btn btn-warning" >OK</a></td>';
    if($row['status']==0)
    echo '<td><font color="red">undone</font> </td>';
     if($row['status']==1)
     echo '<td><font color="green">done</font> </td>';
	   //</tr>';
     $i++;
     echo "</tr>";
}
echo'<td></td>';
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
}


//// cost management


else
{
    echo '<h1 style="font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;" align
="center";> Cost List of '.$date.'</h1>';
$i=1;
$j=1;
$result = mysqli_query($con,"SELECT item,item_num,amount,id FROM `cost` WHERE email_id = '$email' and  date='$date'") or die('Error');
$res=$result;
$j=mysqli_num_rows($result);
echo "<div>";
if($j==0)
{
    echo "<h2 style='text-align: center;'>Empty Cost List</h2>";
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
    echo '<th>Name</th>';
    echo '<th>Items</th>';
    echo '<th>Amount</th>';
    echo '<th>Update</th>';
  echo '</tr>';
  $sum=0;
while($row = mysqli_fetch_array($result)) {
    $k=10;
    $id=$row['id'];
    echo "<tr>";
    echo '<td>' . $i. '</td><td>'.$row["item"].'</a></td>';
    echo '<td>'.$row["item_num"].'</td>';
    echo '<td>'.$row["amount"].'</td>';
    $sum=$sum+$row["amount"];
    echo '<td><a href="updatecost.php?remain='.$remainBudget.'&date='.$_GET['date'].'&id='.$id.'"class="btn btn-warning" >OK</a></td>';
    ?>
     <?php
	   //</tr>';
     $i++;
     echo "</tr>";
}
if($date<date('Y-m-d'))
{
    echo'<td></td>';
    echo'<td></td>';
    echo'<td></td>';
    echo '<td></td>';
    echo'<td></td>';
}
else{
    ?>
     <form action="" method="post">
     <td><?php echo $i; ?></td>
    <td><input type="text" style="width: 150px;" name="item_name" required></td>
    <td><input type="text" name="item_num" style="width: 100px;" required></td>
    <td><input type="text" name="amount" style="width: 100px;" required></td>
    <?php
echo '<td>';
?>

   <button type="submit"  class="btn btn-primary" name="csubmit">Add New </button>
      </form>
<?php
echo'</td>';
}
?>
<h4 style="text-align:center;">Total cost of <?php echo $date;?> is <?php echo  $sum; ?></h4>
</table>
</div>
<?php
}
?>
</html>
