<html>
<html lang="en">
<head>
   <style>
   body {
 //background-image: url("img.jpeg");
 background-color:Aquamarine  ;
}
   </style>
  <title>Bootstrap Example</title>

</head>
<body>
<?php
 include_once 'dbConnection.php';

// session_start();
 include_once 'header.php';
 if(!isset($_SESSION['name']))
 {
     header("Location:login.php");
 }
$bool=0;
 if(isset($_GET['id'])){

    $id=$_GET['id'];
    //echo $id;
     $title = $_GET['title'];
     $mail=$_SESSION['email'];
     $date=$_GET['date'];

    //if(isset($_POST['submit']))
     //{
         
         $res = mysqli_query($con,"UPDATE article set trash=0 WHERE id = '$id' and email_id='$mail'
     and date='$date'")
      or die('Error');
      if($res)
      {
          echo '<script language="javascript">';
          echo 'alert("message successfully updated")';
          echo '</script>';
          ?>
          <a href="javascript:history.go(-1)">Go back...</a>
          <?php
      }
      else
      {
        echo '<script language="javascript">';
        echo 'alert("Error occured")';
        echo '</script>';
        ?>
        <a href="javascript:history.go(-1)">Go back...</a>
        <?php
      }
     // header("Location:diary.php?date=$date");
      //if($res)echo 'Successfully updated';
      //else echo 'error';

     //}

     ?>
<?php
 }
 ?>
</body>
</html>
