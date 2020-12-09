<?php 

include('dbcon.php');

session_start();

   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
   // if(isset($_POST['signin']))
//{
  include('dbcon.php');
 // $uid=$_POST['uid'];
 // $email = $_POST['email'];
 // $password = $_POST['password'];
      $uid = mysqli_real_escape_string($con,$_POST['uid']);
      $email = mysqli_real_escape_string($con,$_POST['email']);
      $password = mysqli_real_escape_string($con,$_POST['password']); 
      
      $sql = "SELECT * FROM user WHERE email = '$email' and password = '$password' and uid = '$uid' ";

  // if(mysqli_num_rows($result) < 1)
  

//$_SESSION["myusername"]=!empty($_POST['myusername'])?mysql_real_escape_string(stripslashes($_POST['myusername'])):"";
//$_SESSION["mypassword"]=!empty($_POST['mypassword'])?mysql_real_escape_string(stripslashes($_POST['mypassword'])):"";

      $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {

     //    echo "welcome";
         
//if($count = mysqli_fetch_assoc($result))

 $_SESSION['email'] = $email;
 $_SESSION['uid'] = $uid; 

header ('location:userhome.php'); 

  //   
   }
   else {
        echo "Your Login Name or Password is invalid";
      }
   }
?>