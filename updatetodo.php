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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
 include_once 'dbConnection.php';
 
 //session_start();
 include_once 'header.php';
 if(!isset($_SESSION['name']))
 {
     header("Location:login.php");
 }
 
 if(isset($_GET['id'])){

    $id=$_GET['id'];
    //echo $id;
     $title = $_GET['title'];
     $mail=$_SESSION['email'];
     $date=$_GET['date'];

    if(isset($_POST['submit']))
     {
         $stat=0;
         if($_POST['status']=="done")$stat=1;
         $txt=$_POST['txt'];
         $ti=$_POST['title'];
         $res = mysqli_query($con,"UPDATE todo set todo='$txt',title='$ti',status='$stat' WHERE id = '$id' and email_id='$mail'
     and date='$date'")
      or die('Error');
      if($res)
      {
          ?>
          <p style="align=center;"> Successfully Updated<p>
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
         $res = mysqli_query($con,"DELETE from todo WHERE id = '$ti'")
      or die('Error');
      header("Location:diary.php?date=$date");
     }

     $result = mysqli_query($con,"SELECT * FROM `todo` WHERE id = '$id' and email_id='$mail'
     and date='$date'")
      or die('Error');
      while($row = mysqli_fetch_array($result)) {
echo '<form action="" method="post">';
?>
 <label for="title"><b>Title</b></label>
 <?php
echo '<textarea  style="width:300px;position:absolute;top:200px;left:200px;" name="title">'.$row['title'].'
</textarea>';
echo '<textarea  style="width:300px;position:absolute;top:280px;left:200px;height:50px;" name="txt">'.$row['todo'].'
</textarea>';
      
}
 }
?>
<select name="status" style="position:absolute;top:550px;left:650px;">

  <option value="undone">undone</option>
  <option value="done">done</option>
  
</select>
<button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure to change this delete?');" name="delete"
style="position:absolute;top:550px;left:750px;">Delete </button>
<button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure to change this update?');" name="submit"
style="position:absolute;top:550px;left:900px;">Update </button>
<?php
echo '<a href="diary.php?date='.$date.'">Back to Notes</a>';
?>
</form>
</body>
</html>
  