<?php 
 include_once 'dbConnection.php';
 //session_start();
 include_once 'header.php';
 if(!isset($_SESSION['name']))
 {
     header("Location:login.php");
 }
$email=$_SESSION["email"];
$date=$_GET['date'];

?>
<?php
    if(isset($_POST['submit']))
    {
        $title=$_POST['title'];
        $todo=$_POST['note'];
        $email=$_SESSION['email'];
        $d=$_GET['date'];
        $q3=mysqli_query($con,"INSERT INTO todo (email_id,date,title,todo) VALUES  ('$email','$d', '$title','$todo')");
        if($q3)
        {
            header("Location:diary.php?date=".$_GET['date']."");
        }
    }
?>
<!DOCTYPE html>
<html>
<style>
   body {
 //background-image: url("img.jpeg");
 background-color:Aquamarine  ;
}
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

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<body>
<div style="position:absolute;left:300px;width:800px;">
<form style =" position:absolute;" action="" method="post" style="border:1px solid #ccc">
  <div class="container">
    <p >Please Add Your To-do.</p>
    <hr>

    <label for="name"><b>Title</b></label>
    <input type="text" placeholder="Write Title" name="title" required>

    <label for="email"><b>Todo List</b></label>
    <br>
    
    <textarea style="width:400px;position:absolute;height:300px;" placeholder="Write" name="note"></textarea>

    <div class="clearfix">
      <button type="submit" style="position:absolute;top:500px;" class="signupbtn" name="submit">ADD</button>
    </div>
  </div>
</form>
</div>
</body>
</html>   