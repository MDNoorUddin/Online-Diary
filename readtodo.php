<html>
<style>
   body {
 //background-image: url("img.jpeg");
 background-color:Aquamarine  ;
}
   </style>
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
     $title = $_GET['title'];
     $mail=$_SESSION['email'];
     $date=$_GET['date'];

     if(isset($_POST['update']))
     {
         header("Location:updatetodo.php?title=$title&date=$date&id=$id");
     }


     echo $id;
     $result = mysqli_query($con,"SELECT * FROM `todo` WHERE id='$id' and email_id='$mail'
     and date='$date'")
      or die('Error');
     //echo '<div>';
     $i=0;
     echo '<form action="" method="post">';
      while($row = mysqli_fetch_array($result)) {
          $i++;
          echo '<textarea  style="width:800px;position:absolute;top:150px;left:200px;" name="title">'.$row['title'].'
          </textarea>';
          echo '<textarea style="width:800px;position:absolute;top:200px;left:200px;height:300px;" readonly class="form-control" rows="5">'.$row['todo'].'';
}
echo '</textarea>';
echo ' <button type="submit"  class="btn btn-danger" name="update"
style="position:absolute;top:550px;left:900px;">Update </button>
</form>';  
echo $i;
}
?>

<?php
    
?>