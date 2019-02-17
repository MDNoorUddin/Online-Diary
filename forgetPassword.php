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
   
   if(isset($_POST['register']))
   {
     header("Location:register.php");
   }
   if (isset($_POST['submit'])) {  
    $x= $_POST['email'];
    $y=$_POST["moto"];
    $result = mysqli_query($con,"SELECT name FROM member WHERE email = '$x' and moto='$y'") or die('Error');
    $count=mysqli_num_rows($result);
    if($count==0){
          echo '<script language="javascript">';
          echo 'alert("email or moto did not match")';
          echo '</script>'; 
     }
     else
     {
        header("location:updatePassword.php?email=" . $x."");
     }

  }

  if(isset($_POST['register']))
  {
    echo ("hello");
    header("register.php");
  }


?>
<html>
    <h3 > Forget Password</h3>


  <div style="position:absolute;left:500px;top:200px;">

        <form action="" method="post">
        <table>
        <tr>Your Email</tr>
        <br>
        <tr>
        <input type="text" name="email"  placeholder="Enter Email" required>
        </tr>
        <br>
        <tr> Your Moto</tr><br>
        <tr>
        <input type="text" name="moto" placeholder="Enter Moto" required>

        </tr><br><br>
        
        <input type="submit" name="submit" value="Verify">

        </table>
        </form>
        <p>Not Registered Yet   <a href="register.php">Register here</a> <p>
        
        </div>


</form>

</body>
</html>
