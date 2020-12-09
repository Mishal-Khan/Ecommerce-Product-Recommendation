
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

<?php include 'includes/session.php';

session_start();


include('dbcon.php');

if(isset($_SESSION['email'])) {

}

$email = $_SESSION['email'];
$sql = "SELECT * FROM `user` WHERE `email` = '$email' ";
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

       $name= $data['name']; 
   $uid=$data['uid'];
   }}


?>




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
             
               // include'dbcon.php';
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


$qry = "SELECT product_id, category_id, quantity,item, photo, prodname,price FROM cart WHERE uid = $uid";
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
         $category_id = $data['category_id'];

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
                    <span class="hidden-xs">'.$user['name'].'</span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="'.$image.'" class="img-circle" alt="User Image">

                      <p>
                        '.$user['name'].' 
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
	        		<h1 class="page-header">YOUR CART</h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead>
		        				<th>SR.</th>
		        				
		        				<th>Name</th>
		        				<th>Price</th>
                    <th>Category_id</th>
		        				<th width="20%">Quantity</th>
		        				<th>Subtotal</th>
		        			</thead>
		        			<tbody>
		        			<tr>	        		<?php
	        			if(isset($_SESSION['uid'])){
	        				
 
              include'dbcon.php';
$qry = "SELECT * FROM cart where uid = $uid";
$res =mysqli_query($con,$qry);
$total =0;
//$data =mysqli_fetch_assoc($result);
 if(mysqli_num_rows($res)<0)
   {
      echo "<tr><td colspan ='5' > no records Found </td></tr>";

   }
   else{
   	    $count =0;  
    while($data = mysqli_fetch_assoc($res))
    {    
     
//$sql = "SELECT * From products Where category_id= category_id";
//$res1 =mysqli_query($con,$sql);
 
 $uid= $data['uid'];
        ?>
    
		        		 <td><?php echo $count; ?></td>	
   <td><?php echo $data['item']; ?></td>
    
      <td><?php echo $data['price']; ?></td>

<td><?php echo $data['category_id']; ?></td>
      <td><?php echo $data['quantity']; ?></td>
      <td><?php echo $data['price'] * $data['quantity']; ?></td>

      <td><a href= "cart_delete.php?product_id=<?php echo $data['product_id']; ?> &sid=<?php echo $data['uid'];?>">Delete</a></td>
</tr>
    
  
<?php
$subtotal=$data['price'] * $data['quantity'];
$category_id= $data['category_id'];
$item = $data['item'];
$total += $subtotal;
///////////////////////////////////////////////////////

//$qury= "select * from cart where uid = '$uid' ";

 //$rescheck=mysqli_query($con,$sql);
//$result =mysqli_query($con,$qury);

//$data =mysqli_fetch_assoc($result);
  
  //$count =0;  
    //while($data = mysqli_fetch_assoc($result))
   // {    
      if($category_id==1){

 $test1 = "INSERT INTO `checkout`( `uid`, `item1` ) VALUES ( '$uid', '$item' ) ";

  $result1 = mysqli_query($con,$test1);

   if($result1 == true)
 {echo"done";
}}

 elseif($category_id==2){

 $test2 = "INSERT INTO `checkout`( `uid`, `item2` ) VALUES ( '$uid', '$item' ) ";

  $result2 = mysqli_query($con,$test2);

   if($result2 == true)
 {echo"done2";
}}

  elseif($category_id==3){

 $test3 = "INSERT INTO `checkout`( `uid`, `item3` ) VALUES ( '$uid', '$item' ) ";

  $result3 = mysqli_query($con,$test3);

   if($result3 == true)
 {echo"done3";
}}



  elseif($category_id==4){

 $test4 = "INSERT INTO `checkout`( `uid`, `item4` ) VALUES ( '$uid', '$item' ) ";

  $result4 = mysqli_query($con,$test4);

   if($result4 == true)
 {echo"don4";
}}


$count++;

   }
 }}

///////////////////////////////////////////////////////////////
     


    ?>
       </tbody>
		        		</table>
<br>
<hr>
<table>
  

  <tr><b>
Total
</b>
</tr>


                  <tr>
                    <td>
                   <?php echo $total; ?>
                   </td></tr>
                   
</table>
              </div>
	        		</div>
              
  <form class="form-inline" method="post">
                      <div class="form-group">
                        <div class="input-group col-sm-5">
                          
                         
                          <input type="hidden" id="uid" value="<?php echo $uid; ?>" name="uid">
                          <input type="hidden" id="item" name="item" value="<?php echo $data['item']; ?>">
                            <input type="hidden" id="count" name="count" value="<?php echo $data['count']; ?>">
                             <input type="hidden" id="total" name="total" value="<?php echo $total; ?>">
                            
                             <input type="hidden" id="category_id" name="category_id" value="<?php echo $data['category_id'];?>">
                      </div>
                    
                        <button type="submit" name="checkout" value="checkout" class="btn btn-primary btn-lg btn-flat w3-text-black w3-orange"><i class="fa fa-shopping-cart"></i> CHECK OUT</button>
                      </div>
                    
                  
                 
                </form>






	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>
<!-- Paypal Express -->
<script>
paypal.Button.render({
    env: 'sandbox', // change for production if app is live,

	client: {
        sandbox:    'ASb1ZbVxG5ZFzCWLdYLi_d1-k5rmSjvBZhxP2etCxBKXaJHxPba13JJD_D3dTNriRbAv3Kp_72cgDvaZ',
        //production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
    },

    commit: true, // Show a 'Pay Now' button

    style: {
    	color: 'gold',
    	size: 'small'
    },

    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                    	//total purchase
                        amount: { 
                        	total: total, 
                        	currency: 'USD' 
                        }
                    }
                ]
            }
        });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function(payment) {
			window.location = 'sales.php?pay='+payment.id;
        });
    },

}, '#paypal-button');
</script>
</body>
</html>