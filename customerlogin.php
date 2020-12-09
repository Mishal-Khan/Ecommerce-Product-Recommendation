
<form method = "post" action="function.php">
<table style = "width:40%;" align="center" border="1">
	<tr>
		<th colspan="2" align="center"> Employee Information </th>


	</tr>
<tr>
	<td align="left"> Chose Standard </td>
	<td>
		<select name= "std" required="">
			<option value="1">1st</option>
			<option value="2">2nd</option>
			<option value="3">3rd</option>
			<option value="4">4th</option>
			<option value="5">5th</option>
		</select>
	</td>
</tr>
<tr>
	<td align="left">Enter ID </td>
	<td>
	<input type="text" name="id" required>	
	</td>
</tr>
<tr>
	<td colspan="2" align="center"> <input type="submit" name="submit" value="Employee detail"></td>
</tr>


</table>
</form>

</body>
</html>

<?php
if(isset($_POST['submit']))
{

	$standard = (int) $_POST['std'];
	$id = (int) $_POST['id'];

	echo "<pre>";
	print_r($_POST);
	echo "</pre>";

	include('dbcon.php');

	//include('function.php');
	$sql = "SELECT * FROM `emp` WHERE `standard`= '$standard' AND `id` LIKE '$id'";
	$run = mysqli_query($con,$sql);

	if(mysqli_num_rows($run) > 0)
	{
	 	$data= mysqli_fetch_assoc($run);
		// if($run == true)
    ?>
    <script type="text/javascript">
      alert('Data inserted successfully \n Thankyou..!');
  

       window.open('function.php','_self');
    </script>
  <?php
  }else{
  	echo "Cannot run";
  }
}
?>