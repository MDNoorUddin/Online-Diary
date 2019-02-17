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

    if(isset($_POST['submit']))
     {
         $txt=$_POST['txt'];
         $ti=$_POST['title'];
         $res = mysqli_query($con,"UPDATE article set paragraph='$txt',title='$ti' WHERE id = '$id' and email_id='$mail'
     and date='$date'")
      or die('Error');
      if($res)
      {
          echo '<script language="javascript">';
          echo 'alert("message successfully updated")';
          echo '</script>';
          ?>
          <a href="javascript:history.go(-2)">Go back...</a>
          <?php
      }
     // header("Location:diary.php?date=$date");
      //if($res)echo 'Successfully updated';
      //else echo 'error';

     }

     if(isset($_POST['delete']))
     {
         $ti=$_GET['id'];
         echo $ti;
         $res = mysqli_query($con,"update article  set trash=1 WHERE id = '$ti'")
      or die('Error');
      echo '<script language="javascript">';
      echo 'alert("message successfully deleted")';
      echo '</script>';
      $bool=1;
      ?>

      <a href="javascript:history.go(-2)" style="text-align:center;">Go back...</a>
 <?php
      //header("Location:javascript:history.go(-2)");
      //header("Location:diary.php?date=$date");
     }
     if($bool==0){

     $result = mysqli_query($con,"SELECT * FROM `article` WHERE id = '$id' and email_id='$mail'
     and date='$date'")
      or die('Error');
      while($row = mysqli_fetch_array($result)) {
echo '<form action="" method="post">';
?>

 <?php
echo '<textarea  style="width:800px;position:absolute;top:200px;left:200px;" name="title">'.$row['title'].'
</textarea>';
echo '<textarea  style="width:800px;position:absolute;top:280px;left:200px;height:300px;" name="txt">'.$row['paragraph'].'
</textarea>';

}
 
?>
<button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure to change this delete?');" name="delete"
style="position:absolute;top:550px;left:750px;">Delete </button>
<button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure to change this update?');" name="submit"
style="position:absolute;top:550px;left:900px;">Update </button>

</form>
<?php
     }
 }
 ?>
</body>
</html>
