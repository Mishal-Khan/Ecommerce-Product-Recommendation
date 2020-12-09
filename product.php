<?php 

include('dbcon.php');
$item = $_GET['product'];

 $sql ="SELECT *, products.name AS prodname, products.item AS proditem, category.name AS catname, products.category_id AS catid, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id WHERE `item` = '$item'";
	    //$stmt->execute(['item' => $item]);
 $result = mysqli_query($con,$sql);

//	   $product = $stmt->fetch();
//$product =mysqli_fetch_assoc($stmt);
 if(mysqli_num_rows($result) < 0)
   {
      echo "<tr><td colspan ='5' > no records Found </td></tr>";

   }
	
else{	
	$now = date("Y-m-d");
         $count =0;  
         
    while($data = mysqli_fetch_assoc($result))
    {    
      $count++;

       $date = $data['date_view']; 
       $proditem= $data['proditem']; 
       //$id = $data['prodid'];   
       $price = $data['price'];
       $name = $data['catname'];
       $itemtype= $data['item_type'];
       $prodname = $data['prodname'];
 $id = $data['prodid']; 
  $catid = $data['catid'];
$photo = $data['photo']; 
$description = $data['description']; 
  
//page view
//	$now = date('Y-m-d');
	// $now = date("Y-m-d h:i:s");
	}
	//if($date==$now){

	$sql1 = "UPDATE products SET date_view = $now WHERE id = $id ";
	//	$sql1 = "UPDATE products SET counter=counter+1 WHERE id = $id ";
		$stmt =mysqli_query($con,$sql1);
		
		 if($stmt == true){
		 	
		 }
		//$stmt->execute(['id'=>$product['prodid']]);
//	}
//	else{
//		$sql2 = "UPDATE products SET counter=1, date_view = $now WHERE id= $id";
//		$result1 =mysqli_query($con,$sql2);
//		echo"@2222222222222222222222";
// $id = $data['prodid']; 
  //$now = $data['now']; 
  //$prodname = $data['prodname'];
	//	$stmt->execute(['id'=>$stmt['prodid'], 'now'=>$now]);
	
      //  }

//	}
}
?>

	


<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<script>
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="wrapper">

<?php include 'includes/session.php';

session_start();
include('dbcon.php');

if(isset($_SESSION['email'])) {

}

?>

<?php
$email = $_SESSION['email'];
$sql = "SELECT * FROM `user` WHERE `email` = '$email' ";
$result =mysqli_query($con,$sql);

//$data =mysqli_fetch_assoc($result);
 if(mysqli_num_rows($result) < 1)
   {
      echo "<tr><td colspan ='5' > no records Found </td></tr>";

   }
   
   else{
         $count =0;  
    while($data = mysqli_fetch_assoc($result))
    {    
      $count++;

       $name= $data['name']; 
       $uid = $data['uid'];
   }}


?>


<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	
<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="" class="navbar-brand"><b>Metro</b>Mall</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="userhome.php">HOME</a></li>
         <li><a href="associate.php"><b>Recommendation</b></a></li>
          <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">CATEGORY <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php
             //include'dbcon.php';
                $con = $pdo->open();
                try{
                  $stmt = $con->prepare("SELECT * FROM category");
                  $stmt->execute();
                  foreach($stmt as $row){

                    echo "
                      <li><a href='category.php?category=".$row['item_type']."'>".$row['name']."</a></li>
                    ";                  
                  }
                }
                catch(PDOException $e){
                  echo "There is some problem in connection: " . $e->getMessage();
                }

                $pdo->close();
$count=0;
              ?>
            </ul>
          </li>
        </ul>
        <form method="POST" class="navbar-form navbar-left" action="search.php">
          <div class="input-group">
              <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" required>
              <span class="input-group-btn" id="searchBtn" style="display:none;">
                  <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i> </button>
              </span>
          </div>
        </form>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-shopping-cart"></i>
              <?php 
              include'dbcon.php';

$qry = "SELECT * FROM cart WHERE uid = $uid";
$r2 =mysqli_query($con,$qry);

//$data =mysqli_fetch_assoc($result);
 if(mysqli_num_rows($r2) < 0)
   {

        $data = mysqli_fetch_assoc($r2);
      echo "<tr><td colspan ='5' > no records Found </td></tr>";

   }
   
   else{
         $count =0;  
    while($data = mysqli_fetch_assoc($r2))
    {    
      $count++;

       $product_id= $data['product_id']; 
       $quantity = $data['quantity'];
       $cartname = $data['prodname'];
       $cartprice = $data['price'];
       $cartphoto = $data['photo'];
       $cartitem = $data['item'];



   }}


              ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $count; ?>  item(s) in cart</li>
              <li>
                <ul class="menu" id="cart_menu">
                </ul>
              </li>
              <li class="footer"><a href="cart_view.php">Go to Cart</a></li>
            </ul>
          </li>
          <?php
            if(isset($_SESSION['user'])){
              $image = (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg';
              echo '
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="'.$image.'" class="user-image" alt="User Image">
                    <span class="hidden-xs">'.$user['username'].' </span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="'.$image.'" class="img-circle" alt="User Image">

                      <p>
                        '.$user['username'].'
                        <small>Member since '.date('M. Y', strtotime($user['created_on'])).'</small>
                      </p>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                      </div>
                      <div class="pull-right">
                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              ';
            }
            else{
            
              echo "
                  <li><a href=#>$name</a></li>
                 <li><a href='sign.php'>Logout</a></li>
              ";
             
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>



	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<div class="callout" id="callout" style="display:none">
	        			<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
	        			<span class="message"></span>
	        		</div>
		            <div class="row">
		            	<div class="col-sm-6">
		            		<img src="<?php echo (!empty($photo)) ? 'images/'.$photo : 'images/noimage.jpg'; ?>" width="100%" class="zoom" data-magnify-src="images/large-<?php echo $photo; ?>">
		            		<br><br>
		            		<form class="form-inline" method="post">
		            			<div class="form-group">
			            			<div class="input-group col-sm-5">
			            				
			            				<span class="input-group-btn">
			            					<button type="button" id="minus" class="btn btn-default btn-flat btn-lg"><i class="fa fa-minus"></i></button>
			            				</span>
			            				 <input type="hidden" id="uid" name="uid" value="uid">
							          	<input type="text" name="quantity" id="quantity" class="form-control input-lg" value=1>
							            <span class="input-group-btn">
							                <button type="button" id="add" class="btn btn-default btn-flat btn-lg"><i class="fa fa-plus"></i>
							                </button>
							            </span>
							            <input type="hidden" id="id" value="<?php echo $id; $_SESSION['id'] = $id;?>" name="id">
							            <input type="hidden" id="prodname" name="prodname" value="<?php echo $prodname?>">
							              <input type="hidden" id="photo" name="photo" value="<?php echo $photo; ?>">
                             <input type="hidden" id="catid" name="catid" value="<?php echo $catid; ?>">
							               <input type="hidden" id="price" name="price" value="<?php echo $price;?>">
                             <input type="hidden" id="proditem" name="proditem" value="<?php echo $proditem;?>">
							        </div>
							      
			            			<button type="submit" id="addit" name="submit" value="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
			            		</div>
		            		
		            	</div>
		            	<div class="col-sm-6">

		            		 

		            		<h6 class="page-header"><b><?php echo $prodname; ?></b></h6>
		            	
		            		<h3><b>&#36; <?php echo number_format($price, 2); ?></b></h3>
		            		<br>

		            		<p><b>Category:</b> <a href="category.php?category=<?php echo $prodname; ?>"> <br><?php echo $prodname; ?></a></p>
		            		
		            		

		            		<br>
		            		<p><b>&#32;Description:</b></p>
		            		<p><?php echo $description; ?></p>
		            	</div>
		            </form>
		            </div>
		         <?php



if(isset($_POST['submit']))
{
  include('dbcon.php');
  

  $quantity = $_POST['quantity'];
  $id = $_POST['id'];
   $price = $_POST['price'];
   $name = $_POST['prodname'];
   $photo= $_POST['photo'];
    $item= $_POST['proditem'];
 $catid= $_POST['catid'];


$sql= "select * from cart where prodname='$prodname' And uid = '$uid' ";

 $rescheck=mysqli_query($con,$sql);


 if (mysqli_num_rows($rescheck) > 0) {
        
        $row = mysqli_fetch_assoc($rescheck);
       // {
       	?>
       	<span class="label success" style=" display: block;text-align: center; font-size: 19px; height: 35px;  background-color: #ff9800;">That item already exists in cart 😞 </span> 

       	
            
  <?php
        //}
            	
}

else{
  
  $qry = "INSERT INTO `cart`( `uid`, `category_id` , `prodname`,`price`, `photo`, `product_id`, `quantity` ,`item`) VALUES ( '$uid','$catid', '$prodname','$price','$photo', '$id' , '$quantity' , '$item') ";

  $run = mysqli_query($con,$qry);

   if($run == true)
 {
 	?>
 	<span class="label success"  style=" display: block;text-align: center; font-size: 19px; height: 35px; background-color: #4CAF50;"> Item added to the cart! 😊 </span> 

 	
 	<?php

  $qry2 = "INSERT INTO `trans`( `uid`, `item`,`quantity` ) VALUES ( '$uid', '$item','$quantity' ) ";

  $run2 = mysqli_query($con,$qry2);

   if($run2 == true)
 {
}
 
$count++;
 


  }
}}

?>

				    <div class="fb-comments" data-href="http://localhost/proj1/product.php?product=<?php echo $item; ?>" data-numposts="10" width="100%"></div> 
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>



  	
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$('#add').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		quantity++;
		$('#quantity').val(quantity);
	});
	$('#minus').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		if(quantity > 1){
			quantity--;
		}
		$('#quantity').val(quantity);
	});

});
$("#addit").click(function(){
  var productId = $("#id").val();
  //var productName = $("#pro").val();
  var productQuantity = $("#quantity").val();
  var data = {
    'product_id': productId,
   // 'product_name': productName,
    'quantity': productQuantity
  };

  $.post("/cart/add", data, showDone);
 });
 
 var showDone = function() {
  /* Make something happen here*/
 }

</script>
</body>
</html>




