<!DOCTYPE html>
<html>
<head>
	<title>ADMIN LOGIN</title>
</head>
<body>
<br>
<br><br><br><br><br>
<h1 align="center"> ADMINISTRATOR LOGIN</h1>
<br>
<form action="adminlogin.php" method="post">
	<table align="center" border="3">

		<tr>
			<td> USERNAME </td>
			<td><input type="text" name="username" required></td>
		</tr>

<tr>
	
	<td> PASSWORD </td>
	<td><input type="password" name="password" required></td>
</tr>

<tr>
	<td colspan="2" align="center">
		<input type="submit" name="submit" value="login">
	</td>

</tr>

	</table>
	

</form>
</body>
</html>

<?php 

include('dbcon.php');

session_start();

   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $username = mysqli_real_escape_string($con,$_POST['username']);
      $password = mysqli_real_escape_string($con,$_POST['password']); 
      
      $sql = "SELECT id FROM admin WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
//echo "res".$row;
     //    echo "welcome";
         
$_SESSION['uid'] = $result;
header ('location:admin/admindash.php'); 

      }else {
         echo "Your Login Name or Password is invalid";
      }
   }
?>


