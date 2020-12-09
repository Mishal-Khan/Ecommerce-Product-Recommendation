<?php
include('dbcon.php');
$item = $_GET['category'];

$sql = "SELECT * FROM `category` WHERE `item_type` = '$item' ";
$result =mysqli_query($con,$sql);

//$data =mysqli_fetch_assoc($result);
 if(mysqli_num_rows($result) > 1)
   {
      echo "<tr><td colspan ='5' > no records Found </td></tr>";

   }
	
   
   else{
         $count =0;  
    while($data = mysqli_fetch_assoc($result))
    {    
      $count++;

       $catid= $data['id']; 
       $item_name = $data['name'];
   }}


?>



<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
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
        $uid= $data['uid']; 
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
             
                $conn = $pdo->open();
                try{
                  $stmt = $conn->prepare("SELECT * FROM category");
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
$qry = "SELECT product_id, quantity, photo, prodname,price FROM cart WHERE uid = $uid";
$r1 =mysqli_query($con,$qry);

//$data =mysqli_fetch_assoc($result);
 if(mysqli_num_rows($r1) < 0)
   {
      echo "<tr><td colspan ='5' > no records Found </td></tr>";

   }
	
   else{
         $count =0;  
    while($data = mysqli_fetch_assoc($r1))
    {    
      $count++;

       $product_id= $data['product_id']; 
       $quantity = $data['quantity'];
       $cartname = $data['prodname'];
       $cartprice = $data['price'];
       $cartphoto = $data['photo'];
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
                    <span class="hidden-xs">'.$user['firstname'].' '.$user['lastname'].'</span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="'.$image.'" class="img-circle" alt="User Image">

                      <p>
                        '.$user['firstname'].' '.$user['lastname'].'
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
		            <h1 class="page-header"><?php echo $item_name; ?></h1>
		       		<?php
		       			
		       		//	$conn = $pdo->open();
include'dbcon.php';
		       			try{
		       			 	$inc = 3;	
						    //$stmt = $con->prepare("SELECT * FROM products WHERE category_id = $catid");
						    $sql = "SELECT * FROM `products` WHERE `category_id` = '$catid' ";

						   // $stmt->execute(['$catid' => $catid]);
						    $stmt =mysqli_query($con,$sql);
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['item']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
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
</body>
</html>