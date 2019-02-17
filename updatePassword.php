
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
 //include_once 'header.php';
     if(isset($_GET['email'])){
        $email=$_GET['email'];

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

           $res = mysqli_query($con,"UPDATE member set password='$p1' WHERE email='$email'")
          or die('Error');
          if($res)
         {
          //include_once 'header.php';
          echo '<script language="javascript">';
          echo 'alert("password changed successfully")';
          echo '</script>';
         }
         ?>
         <a href="login.php">Back TO log in</a>
         <?php
     }
       }

////////////////////////////////////////////////// budget calculate
///////////////////////////////////////////////////
    }

?>
        <div style="position:absolute;left:450px;">
        <h1 style="text-align:center;"> Updating Password</h1>

        <form action="" method="post">
        <table>
        
        <tr> Enter New Password</tr><br>
        <tr>
        <input type="text" name="p1" placeholder="Enter password">

        </tr><br>
        <tr>Re-Enter New Password </tr><br>
        <tr>
        <input type="text" name="p2" placeholder="Re-enter Password">

        </tr><br>

        <input type="submit" name="pupdate" value="update">
        </table>
        </form>
        </div>

