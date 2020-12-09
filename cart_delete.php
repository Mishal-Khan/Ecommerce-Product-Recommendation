
     <script type="text/javascript">
         window.open('cart_view.php','_self');

    </script>

<?php

	include 'dbcon.php';


	$product_id = $_REQUEST['product_id'];
  $uid = $_REQUEST['sid'];
	//if(isset($_SESSION['prodname'])){
		
			$qry = "DELETE FROM cart WHERE product_id = $product_id And uid = $uid ";
			$run = mysqli_query($con,$qry);

  if($run == true)
  {
    ?>
    <span class="label success" style=" display: block;text-align: center; font-size: 19px; height: 35px;  background-color: #4CAF50;">Item Deleted successfully! 😞 </span> 

   
  <?php
  }else{
    echo "false";
  }
