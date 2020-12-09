<!DOCTYPE html>
<html lang = "en_US">
<head>
	<title> Metro Mall</title>
<link rel="stylesheet" type="text/css" href="css/customer.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">

</head>
<body>

<h3  align= "right" style="  padding:2px; color:darkblue; margin-bottom:0px; "> <a href="adminlogin.php"> Admin Login </a></h3>

<hr>
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>

		<div class="login-form">
			<form method= "post" action="userlogin.php" target="_blank">
			<div class="sign-in-htm">
				<div class="group">
					<label for="user" class="label">User id</label>
					<input id="user" name="uid" type="text" class="input" required>
				</div>

				<div class="group">
					<label for="user" class="label">Email</label>
					<input id="user" name="email" type="email" class="input" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="password" type="password" class="input" data-type="password" required>
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>
				

				<div class="group">
  <button type="submit" name= "signin" value= "signin" class="button">Sign In</button>
</div>

    </form> 
			<hr>
			<br>
			<div class="foot-lnk" align= "right" >
					
					<a class="button" style=" color: white; background-color: royalblue; border: 10px solid 	royalblue; border-radius: 12px" href="index.php">Home  </a>

				</div>
<br>     						<div class="foot-lnk">
					<a href="#forgot">Forgot Password?</a>
				</div>
								
			</div>
	<form method= "post" action="sign.php" target="_blank">
			<div class="sign-up-htm">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input name="name" id="user" type="text" class="input" required>
				</div>
				<div class="group">
					<label for="user" class="label">User id</label>
					<input name="uid" id="user" type="text" class="input" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" name="password" data-type="password" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Email Address</label>
					<input id="pass" name="email" type="email" class="input" required>
				</div>
<div class="group">
  <button type="submit" name= "signup" value= "signup" class="button">Sign Up</button>
</div>

    </form> 



				<hr>
			<br>
			<div class="foot-lnk" align= "right" >
					
					<a class="button" style=" color: white; background-color: royalblue; border: 10px solid 	royalblue; border-radius: 12px" href="index.php">Home  </a>

				</div>
   
				

					
		</div>
	</div>
</div>
</label>
</div>
</div>
</div>
</div>
</div>

</body>
</html>


<?php

if(isset($_POST['signup']))
{
  include('dbcon.php');
  
$uid=$_POST['uid'];
  $email = $_POST['email'];
  $name = $_POST['name'];
   $password = $_POST['password'];

$sql="select * from user where (email='$email')";

 $res=mysqli_query($con,$sql);

 if (mysqli_num_rows($res) > 0) {
        
        $row = mysqli_fetch_assoc($res);
      //  if($email==$row['email'])
       // {
            	echo "Sorry that email already exists 😞";
  
        //}
            	exit;
}

else{
  
  $qry = "INSERT INTO `user`( `email`, `name`, `password` , `uid`) VALUES ( '$email', '$name' , '$password', '$uid') ";

  $run = mysqli_query($con,$qry);

   if($run == true)
 {
//echo "data inserted";
?>
    <script type="text/javascript">
      alert('Data inserted successfully 😊 \n Thankyou..!');
    
    </script>
  <?php
          

  }
}
}
?>


