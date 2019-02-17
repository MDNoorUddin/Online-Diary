
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
 <form action="" method="post">
      <input type="submit" name="profile" value="profile">
      <input type="submit" name="trash" value="trash">
      <input type="submit" name="notifications" value="notifications">
      <input type="submit" name="c_password" value="chagne-password">
      <input type="submit" name="feedback" value="feedback">
   </form>

<?php
       $count=1;

       if(isset($_POST['update']))
       {
           $name=$_POST['name'];
           $address=$_POST['address'];
           $moto=$_POST['moto'];
           $res = mysqli_query($con,"UPDATE member set name='$name',address='$address',moto
           ='$moto' WHERE email='$email'")
      or die('Error');
      if($res)
      {
          $_SESSION['name']=$name;
          include_once 'header.php';
          echo '<script language="javascript">';
          echo 'alert("information successfully updated")';
          echo '</script>';
      }
      $count=1;
       }

       if(isset($_POST['pupdate']))
       {
           $p1=$_POST['p1'];
           $p2=$_POST['p2'];
           if($p1!=$p2)
           {
              echo '<script language="javascript">';
              echo 'alert("New Password Did Not Match")';
              echo '</script>';
           }
           else{
           $old=$_POST['old'];
           //echo $old;
           $email=$_SESSION['email'];
           //echo $email;
           $rep=mysqli_query($con,"select * from  member where  email='$email' and password='$old'");
           $siz=0;
           while($r = mysqli_fetch_array($rep))
           {
               echo $r['password'];
               $siz=10;
           }
           //echo $siz;
           if($siz==0)
           {
            echo '<script language="javascript">';
            echo 'alert("Password Did Not Match")';
            echo '</script>';
           }
           else{

           $res = mysqli_query($con,"UPDATE member set password='$p1' WHERE email='$email'")
          or die('Error');
          if($res)
         {
          include_once 'header.php';
          echo '<script language="javascript">';
          echo 'alert("password changed successfully")';
          echo '</script>';
      }
     }
    }
      $count=1;
       }

////////////////////////////////////////////////// budget calculate
///////////////////////////////////////////////////


?>

   <?php
    if(isset($_POST['profile']))
    {
        $count=1;
    }
    else if(isset($_POST['notifications']))
    {
        $count=2;
    }
    else if(isset($_POST['feedback']))
    {
        $count=3;
    }
    else if(isset($_POST['trash']))
    {
        $count=4;
    }
    else if(isset($_POST['c_password']))
    {
        $count=5;
    }
/////////////////////////////////////////////////////////////////////////////
if($count==1){
echo '<h1 style="font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;" align
="center";> Personal Information of '.$_SESSION['name'].'</h1>';
//echo "<h2 style='text-align: center;'>".$date."</h2>";
$i=1;
$j=1;
$result = mysqli_query($con,"SELECT * FROM member WHERE email = '$email'") or die('Error');
while($row = mysqli_fetch_array($result)){
?>

        <div style="position:absolute;left:450px;">

        <form action="" method="post">
        <table>
        <tr>Handle</tr>
        <br>
        <tr>
        <input type="text" name="name" value="<?php echo $row['name']; ?>">
        </tr>
        <br>
        <tr> Address</tr><br>
        <tr>
        <input type="text" name="address" value="<?php echo $row['address'];?> ">

        </tr><br>
        <tr>Moto </tr><br>
        <tr>
        <input type="text" name="moto" value="<?php echo $row['moto'];?> ">

        </tr><br>

        <tr> email</tr><br>
        <tr>
        <input type="text" name="email" value="<?php echo $row['email'];?> " readonly>

         </tr><br>
        <input type="submit" name="update" value="update">
        </table>
        </form>
        </div>
        <?php
   }
}
else if($count==4){
    echo '<h1 style="font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;" align
    ="center";>Deleted  notes of you</h1>';

    $i=1;
    $j=1;
    $result = mysqli_query($con,"SELECT title,paragraph,id,trash,date FROM `article` WHERE email_id = '$email'") or die('Error');
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
        echo '<th>Date.</th>';
        echo '<th>Title</th>';
        echo '<th>View</th>';
        echo '<th>Restore</th>';
        echo '<th>Delete</th>';
      echo '</tr>';

    while($row = mysqli_fetch_array($result)) {
        if($row['trash']==0)
        {
            continue;
        }
        $k=10;
        //echo $row["title"];
        $id=$row['id'];
        echo "<tr>";
        echo '<td>' . $i. '</td><td>'.$row['date'].'</td><td>'.$row["title"].'</td>';
        echo '<td><a href="read.php?title='.$row['title'].'&date='.$row['date'].'&id='.$id.'" class="btn btn-info" role="button">OK</a></td>';
        echo '<td><a href="restoring.php?title='.$row["title"].'&date='.$row['date'].'&id='.$id.'"class="btn btn-warning" >OK</a></td>';
        echo '<td><a href="removing.php?title='.$row["title"].'&date='.$row['date'].'&id='.$id.'"class="btn btn-warning" >OK</a></td>';
        ?>
         <?php
           //</tr>';
         $i++;
         echo "</tr>";
    }
    echo'<td></td>';
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
          <button type="submit"  class="btn btn-primary" name="submit">Add New </button>
          </form>
    <?php
    echo'</td>';
    }
    echo '</table>';
}

    else if($count==5)
    {
        ?>
        <div style="position:absolute;left:450px;">
        <h1 style="text-align:center;"> Updating Password</h1>

        <form action="" method="post">
        <table>
        <tr>Enter Old Password</tr>
        <br>
        <tr>
        <input type="text" name="old" value=" <?php echo $row['name']; ?>">
        </tr>
        <br>
        <tr> Enter New Password</tr><br>
        <tr>
        <input type="text" name="p1" value=" <?php echo $row['address'];?> ">

        </tr><br>
        <tr>Re-Enter New Password </tr><br>
        <tr>
        <input type="text" name="p2" value=" <?php echo $row['moto'];?> ">

        </tr><br>

        <input type="submit" name="pupdate" value="update">
        </table>
        </form>
        </div>
        <?php
    }
?>

