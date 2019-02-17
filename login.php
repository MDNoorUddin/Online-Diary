<!DOCTYPE html>
<html>
<style>

body {
  background-color:Aquamarine;
}
</style>
<body>
<?php
   //include_once 'header.php';
   include_once 'dbConnection.php';
   session_start();
   if(isset($_SESSION['name']))
   {
    header("location:diary.php?date=" . date("Y-m-d") ."");
   }
   if(isset($_POST['register']))
   {
     header("Location:register.php");
   }
   if(isset($_POST['forget']))
   {
     header("Location:forgetPassword.php");
   }
   if (isset($_POST['submit'])) {  
    $x= $_POST['email'];
    $y=$_POST["psw"];
    $result = mysqli_query($con,"SELECT name FROM member WHERE email = '$x' and password = '$y'") or die('Error');
    $count=mysqli_num_rows($result);
    if($count==1){
     while($row = mysqli_fetch_array($result)) {
	   $nam = $row['name']; 
     }
     $_SESSION['name'] = $nam;
     $_SESSION['email'] = $x;
     echo $_SESSION['email'];
     header("location:diary.php?date=" . date("Y-m-d") ."");
    }
    else
    {
        echo "try again";
    }

  }

  if(isset($_POST['register']))
  {
    echo ("hello");
    header("register.php");
  }


?>
<html>
    <h3 > Welcome To Digital Diary</h3>


  <div style="position:absolute;left:500px;top:200px;">

        <form action="" method="post">
        <table>
        <tr>Email</tr>
        <br>
        <tr>
        <input type="text" name="email"  placeholder="Enter Email">
        </tr>
        <br>
        <tr> Password</tr><br>
        <tr>
        <input type="text" name="psw" placeholder="Enter Password">

        </tr><br><br>
        
        <input type="submit" name="submit" value="Sign In">

        <input type="submit" name="forget" value="Forget Password">
        </table>
        </form>
        <p>Not Registered Yet   <a href="register.php">Register here</a> <p>
        
        </div>


</form>
<form action="" method="POST">
<div style="width:30%;">
<button type="submit" class="signupbtn" name="register">Sign Up</button>
</div>
</form>
</body>
</html>
