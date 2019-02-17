<html>
<html lang="en">
<head>
   <style>
   body {
 //background-image: url("img.jpeg");
 background-color:Aquamarine  ;
}
   </style>
  <title>Update Cost</title>

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
    //echo $_GET['remain'];
    $id=$_GET['id'];
    $mail=$_SESSION['email'];
    $date=$_GET['date'];
    $month = date("m",strtotime($date));
    $year = date("y",strtotime($date));
    $remainBudget=0;
//////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
   
    $q24=mysqli_query($con,"select * from remainBudget where  email_id='$email' and year='$year' and month='$month'");

  //$remainBudget=0;
 
  if($q24)
   {
    //echo "successfully  done\n";
      $jj=0;
        while($ro = mysqli_fetch_array($q24)) {
            $remainBudget=$ro['budget'];
            $jj++;
        }
        //echo $budget;
  }
  else
  {

  }
  echo $remainBudget;


//////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////


    $money=0;
    //echo $id;
    if(isset($_POST['submit']))
     {
         $pre= $_POST['amount1'];
         $new = $_POST['amount'];
         if($new-$pre>$remainBudget)
         {
            echo '<script language="javascript">';
            echo 'alert("Your are out of balance")';
            echo '</script>';
         }
         else{

            $item=$_POST['item_name'];
            $num=$_POST['item_num'];
            $amount=$_POST['amount'];
            echo $num;
            echo $amount;
            if(!is_numeric($amount) Or !is_numeric($num) Or $amount<0  Or $num<1)
            {
             echo '<script language="javascript">';
             echo 'alert("Your input format is incorrect")';
             echo '</script>';
            }
            else{
                echo $remainBudget;
                $email=$_SESSION['email'];
                $d=$_GET['date'];
                $new=$new-$pre;
                if($new>=0){
                $q220=mysqli_query($con,"UPDATE  remainBudget set budget=$remainBudget-$new where email_id='$email' and month='$month' and
                     year='$year'");
                     if($q220)
                     {
        
                     }
                }
                else
                {
                    $NEW=abs($new);
                    
                    $q220=mysqli_query($con,"UPDATE  remainBudget set budget=$remainBudget+$NEW where email_id='$email' and month='$month' and
                     year='$year'");
                     $remainBudget=$remainBudget+$NEW;
                     $b=0;
                     $q250=mysqli_query($con,"SELECT  * from budget where email_id='$email' and month='$month' and year='$year'");
                     while($ro = mysqli_fetch_array($q250)) {
                        $b=$ro['budget'];
                    }
                    echo "hehe $b";
                    if($b<$remainBudget)
                    {
                        $q260=mysqli_query($con,"UPDATE budget  set budget=$remainBudget where email_id='$email' and month='$month' and year='$year'");
                    }
                }
                $q3=mysqli_query($con,"UPDATE cost  set amount=$amount,item_num=$num where id=$id");
                if($q3)
                {
                    
                    //echo "successfully  done\n";
                    $q4=mysqli_query($con,"select *  from expen where email_id='$email' and month='$month' and year ='$year'");
                    $bud=0;
                    if($q4){
                        echo "here";
                        while($ro = mysqli_fetch_array($q4)) {
                            $bud=$ro['budget'];
                        }
                      $bud=$bud+$new;
                      $q6=mysqli_query($con,"UPDATE expen set budget='$bud' WHERE email_id='$email'
                      and year='$year' and month='$month'");
                      
                    }
                }
                else
                {
                    echo "please try again\n";
                }
         /*$txt=$_POST['txt'];
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
      }*/
     // header("Location:diary.php?date=$date");
      //if($res)echo 'Successfully updated';
      //else echo 'error';
       }
     }?>
     <a href="javascript:history.go(-2)">Go back...</a>
     <?php 
        $bool=1;
    }

     if(isset($_POST['delete']))
     {
           $new = $_POST['amount1'];
           $email=$_SESSION['email'];
           $d=$_GET['date'];
           
                   $NEW=abs($new);
                   $q220=mysqli_query($con,"UPDATE  remainBudget set budget=$remainBudget+$NEW where email_id='$email' and month='$month' and
                    year='$year'");
                    $remainBudget=$remainBudget+$NEW;
                    $b=0;
                    $q250=mysqli_query($con,"SELECT  * from budget where email_id='$email' and month='$month' and year='$year'");
                    while($ro = mysqli_fetch_array($q250)) {
                       $b=$ro['budget'];
                   }
                   //echo "hehe $b";
                   if($b<$remainBudget)
                   {
                       $q260=mysqli_query($con,"UPDATE budget  set budget=$remainBudget where email_id='$email' and month='$month' and year='$year'");
                   }


               $q3=mysqli_query($con,"Delete from cost where id=$id");
               if($q3)
               {
                   
                   //echo "successfully  done\n";
                   $q4=mysqli_query($con,"select *  from expen where email_id='$email' and month='$month' and year ='$year'");
                   $bud=0;
                   if($q4){
                       echo "here";
                       while($ro = mysqli_fetch_array($q4)) {
                           $bud=$ro['budget'];
                       }
                     //$bud=$bud+$new;
                     $q6=mysqli_query($con,"UPDATE expen set budget=$bud-$new WHERE email_id='$email'
                     and year='$year' and month='$month'");
                     
                   }
               }
               else
               {
                   echo "please try again\n";
               }
    ?>
    <?php 
       $bool=1;
      echo '<script language="javascript">';
      echo 'alert("message successfully deleted")';
      echo '</script>';
      $bool=1;
      ?>
      <a href="javascript:history.go(-2)">Go back...</a>
      <?php
     }
     if($bool==0){
echo '<form action="" method="post">';
?>

 <?php
 $i=1;
 $j=1;
 $result = mysqli_query($con,"SELECT * FROM cost WHERE email_id = '$mail' and id='$id' and date='$date'") or die('Errjhhhor');
 while($row = mysqli_fetch_array($result)){
     $money=$row['amount'];
 ?>
 
         <div style="position:absolute;left:450px;">
 
         <form action="" method="post">
         <table>
         <tr>Item Name</tr>
         <br>
         <tr>
         <input type="text" name="item_name" value="<?php echo $row['item']; ?>">
         </tr>
         <br>
         <tr> Item Number</tr><br>
         <tr>
         <input type="text" name="item_num" value="<?php echo $row['item_num'];?> ">
 
         </tr><br>
         <tr>Amount</tr><br>
         <tr>
         <input type="text" name="amount" value="<?php echo $row['amount'];?> ">
         <input type="hidden"  name="amount1" value="<?php echo $row['amount'];?> ">
 
         </tr>
         </table>
         <button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure to change this delete?');" name="delete">Delete </button>
        <button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure to change this update?');" name="submit">Update </button>
         </form>
         </div>
         <?php
    }

}
 
?>

<?php
     }
 //}
 ?>
</body>
</html>
