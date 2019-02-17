<?php
 include_once 'dbConnection.php';

 //session_start();
 include_once 'header.php';
 if(!isset($_SESSION['name']))
 {
     header("Location:login.php");
 }
 if(isset($_SESSION['name']))
 {
     //echo $_SESSION['name'];
 }

?>

<!DOCTYPE html>
<html>
<style>
   body {
 //background-image: url("img.jpeg");
 background-color:Aquamarine  ;;
}
   </style>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
.active {
  background-color: #4CAF50;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<?php
   include_once 'header.php';
   include_once 'dbConnection.php';
   if (isset($_POST['submit'])) {
     header("location:diary.php?date=".$_POST['date']."");
   }
   if(isset($_POST['submit2']))
   {
      $d1=$_POST['date2'];
      $d2=$_POST['date3'];
      if($d2<$d1)
      {
          echo '<script language="javascript">';
          echo 'alert("Your input format is incorrect")';
          echo '</script>';
      }
      else
      header("Location:showAllNote.php?d1=$d1&d2=$d2");
   }

   if(isset($_POST['submit3']))
   {
      $d1=$_POST['date4'];
      $d2=$_POST['date5'];
      if($d2<$d1)
      {
          echo '<script language="javascript">';
          echo 'alert("Your input format is incorrect")';
          echo '</script>';
      }
      else
      header("Location:showAllExpen.php?d1=$d1&d2=$d2");
   }
?>
<html>
<body>
<table style="position:absolute;left:230px;top:200px;">
<td>
<div style="background-color:Tomato;width:250px;height:250px;">
<form  action="account.php" method="post">
  <div class="container">
    <p>Pick a date.</p>
    <input type="date" name="date" required>

    <div class="clearfix">
      <button type="submit"  style="top:160px;" class="signupbtn" name="submit">GO</button>
    </div>
  </div>
</form>
</div>
</td>
<td>
<div style="background-color:Tomato;width:350px;height:250px;">
<form  action="account.php" method="post">
  <div class="container">
    <p>Pick two dates and see all the notes between them.</p>
    <label> from</label></br>
    <input type="date" name="date2" required>
        </br>
        <label> to</label></br>
    <input type="date" name="date3" required>

    <div class="clearfix">
      <button type="submit" class="signupbtn" name="submit2">GO</button>
    </div>
  </div>
</form>
</div>
</td>
<td>
<div style="background-color:Tomato;width:250px;height:250px;">
<form action="account.php" method="post">
  <div class="container">
    <p>Cost Calculate between two dates.</p>
    <label> from</label></br>
    <input type="date" name="date4" required>
        </br>
    <label> to</label></br>
    <input type="date" name="date5" required>

    <div class="clearfix">
      <button type="submit" class="signupbtn" name="submit3">GO</button>
    </div>
  </div>
</form>
</div>
</td>
</table>
</body>
</html>
