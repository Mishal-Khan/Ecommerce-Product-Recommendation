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
$qury = "SELECT product_id, quantity, photo, prodname,price FROM cart WHERE uid = $uid";
$req =mysqli_query($con,$qury);

//$data =mysqli_fetch_assoc($result);
 if(mysqli_num_rows($req) < 0)
   {
      echo "<tr><td colspan ='5' > no records Found </td></tr>";

   }
  
   
   else{
         $count =0;  
    while($data = mysqli_fetch_assoc($req))
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
                        <a href="sign.php" class="btn btn-default btn-flat">Sign out</a>
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
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active" style="width: 100%;height: 30%;">
		                    <img src="images/banner1.jpg" alt="First slide">
		                  </div>
		                  <div class="item" style="width:1000px;height:100%;">
		                    <img src="images/banner2.jpg" alt="Second slide">
		                  </div>
		                  <div class="item" style="width: 100%;height: 100%;">
		                    <img src="images/banner4.jpg" alt="Third slide">
		                  </div>
		                  
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
		            <h2>Monthly Top Sellers</h2>
		       		<?php
		       			$month = date('m');
		       			$con = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
						    $stmt->execute();
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
		       								".$_SESSION['item'] = $item; 
                          $_SESSION['name'] = $name;"
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


 <label  id="toggleVisibilityButton0" type="button" style="background-color:lightseagreen; color: black;   border: 3px solid black;  display: block; align-content: center; text-align: center; width: 75%; font-size: 19px;  height: 40px; ">Most Viewed Cart Items 🙂</label> 
<br>
<table id="displaytable0" border="4" style="display:none; text-align: center; align-content: center; background-color:#F0F8FF;  align-self: center; width: 550px">
<tr style="align-content: center; text-align: center;" >
<td style="width: 70px" ><B>Sr.</B></td>
<td style="width: 100px"  ><B>Support</B></td>
<td style="width: 380px"  ><B>Item Sets</B></td>

</tr >
<tr></tr>
<tr><td>0</td>  <td  > 5 </td> <td >(party_dress)</td></tr>  
<tr><td>1</td>  <td> 4 </td>       <td>(leather_bag)</td></tr>
<tr> <td>2</td>   <td> 4 <         <td>   (heels_shoes)</td></tr>

<tr><td>3</td>  <td> 3</td>  <td>   (summer_shoes )</td></tr>
<tr><td>4</td>  <td>   3  </td>  <td>   (slim_dress)</td></tr>

<tr><td>5</td>  <td>  3   </td>  <td>    (blue_dress)</td></tr>

<tr><td>5</td>  <td>  2  </td>  <td>    (salman_dress)</td></tr>

</TABLE>

<script type="text/javascript">
document.getElementById("toggleVisibilityButton0").addEventListener("click", function(button) {    
   if (document.getElementById("displaytable0").style.display === "none")     
   document.getElementById("displaytable0").style.display = "inline-flex"; 

   else document.getElementById("displaytable0").style.display = "none";
});
</script>

  <br>
  <br>

 <label  id="toggleVisibilityButton" type="button" style="background-color:blanchedalmond; color: black;	 border: 3px solid black;  display: block; align-content: center; text-align: center; width: 75%; font-size: 19px;  height: 40px; ">Recommended Item Sets for you! 🙂</label> 
<br>
<table id="displaytable" border="4" style="display:none; text-align: center; align-content: center; background-color:#F0F8FF;  align-self: center; width: 550px">
<tr style="align-content: center; text-align: center;" >
<td style="width: 70px" ><B>Sr.</B></td>
<td style="width: 100px"  ><B>Support</B></td>
<td style="width: 380px"  ><B>Item Sets</B></td>

</tr >
<tr></tr>

<tr><td>0</td>  <td>   0.181818   </td>  <td>                      (leather_bag, party_dress)</td></tr>
<tr><td>1</td>  <td>   0.181818      </td>  <td>                   (party_dress, heels_shoes)</td></tr>
<tr><td>2</td>  <td>   0.090909     </td>  <td>                    (leather_bag, heels_shoes)</td></tr>
<tr><td>3 </td>  <td>  0.090909   </td>  <td>         (party_dress, leather_bag, heels_shoes)</td></tr>
<tr><td>4</td>  <td>   0.090909    </td>  <td>                      (gown_dress, heels_shoes)</td></tr>
<tr><td>5</td>  <td>   0.090909   </td>  <td>                       (gown_dress, leather_bag)</td></tr>
<tr><td>6</td>  <td>   0.090909    </td>  <td>                      (gown_dress, party_dress)</td></tr>
<tr><td>7</td>  <td>   0.090909    </td>  <td>         (leather_bag, gown_dress, heels_shoes)</td></tr>
<tr><td>8 </td>  <td>  0.090909   </td>  <td>          (party_dress, gown_dress, heels_shoes)</td></tr>
<tr><td>9</td>  <td>   0.090909    </td>  <td>         (party_dress, gown_dress, leather_bag)</td></tr>
<tr><td>10 </td>  <td>  0.090909  </td>  <td>(party_dress, leather_bag, gown_dress, heels_shoes)</td></tr>
<tr><td>11</td>  <td>   0.181818             </td>  <td>          (summer_shoes , party_dress)</td></tr>
<tr><td>12</td>  <td>   0.090909  </td>  <td>                     (summer_shoes , leather_bag)</td></tr>
<tr><td>13</td>  <td>   0.090909   </td>  <td>       (summer_shoes , leather_bag, party_dress)</td></tr>
<tr><td>14 </td>  <td>  0.090909       </td>  <td>                   (leather_bag, slim_dress)</td></tr>
<tr><td>15 </td>  <td>  0.090909    </td>  <td>                      (slim_dress, heels_shoes)</td></tr>
<tr><td>16 </td>  <td>  0.090909 </td>  <td>                          (slim_dress, flat_shoes)</td></tr>
<tr><td>17 </td>  <td>  0.090909      </td>  <td>                   (salman_dress, slim_dress)</td></tr>
<tr><td>18</td>  <td>   0.090909   </td>  <td>                     (salman_dress, leather_bag)</td></tr>
<tr><td>19</td>  <td>   0.090909    </td>  <td>                     (blue_dress, salman_dress)</td></tr>
<tr><td>20 </td>  <td>  0.090909     </td>  <td>                 (summer_shoes , salman_dress)</td></tr>
<tr><td>21</td>  <td>   0.090909   </td>  <td>         (salman_dress, leather_bag, slim_dress)</td></tr>
<tr><td>22 </td>  <td>  0.090909      </td>  <td>    (blue_dress, salman_dress, summer_shoes )</td></tr>
<tr><td>23 </td>  <td>  0.090909   </td>  <td>                       (blue_dress, heels_shoes)</td></tr>
<tr><td>24 </td>  <td>  0.090909              </td>  <td>            (blue_dress, leather_bag)</td></tr>
<tr><td>25 </td>  <td>  0.090909   </td>  <td>                     (blue_dress, summer_shoes )</td></tr>
<tr><td>26 </td>  <td>  0.090909        </td>  <td>                    (slim_dress, purse_bag)</td></tr>
<tr><td>27</td>  <td>   0.090909          </td>  <td>                 (heels_shoes, purse_bag)</td></tr>
<tr><td>28 </td>  <td>  0.090909       </td>  <td>        (slim_dress, heels_shoes, purse_bag)</td></tr>



</TABLE>

<script type="text/javascript">
document.getElementById("toggleVisibilityButton").addEventListener("click", function(button) {    
   if (document.getElementById("displaytable").style.display === "none")     
   document.getElementById("displaytable").style.display = "inline-flex"; 

   else document.getElementById("displaytable").style.display = "none";
});
</script>

<br>
<br>
<label  id="toggleVisibilityButton1" type="button" style="background-color:khaki; color: black;  border: 3px solid black;  display: block; align-content: center; text-align: center; width: 75%; font-size: 19px;  height: 40px; ">Applying Association</label> 
<br>
<table id="displaytable1" border="4" style="display:none; text-align: center; align-content: center; background-color:#F0F8FF;  align-self: center; width: 550px">
<tr style="align-content: center; text-align: center;" >
<td style="width: 70px" ><B>Sr.</B></td>
<td style="width: 100px"  ><B>Leverage</B></td>
<td style="width: 380px"  ><B>Item Sets</B></td>

  
</tr >
<tr></tr>
<tr><td>1</td>  <td>   0.066116   </td>  <td>         (flat_shoes) , (slim_dress)</td></tr>
<tr><td>2</td>  <td>  0.066116      </td>  <td>      (purse_bag) , (slim_dress) </td></tr>

  <tr><td>3</td>  <td>  0.066116            </td>  <td>    (summer_shoes , salman_dress) , (blue_dress) </td></tr>
	      


</TABLE>

<script type="text/javascript">
document.getElementById("toggleVisibilityButton1").addEventListener("click", function(button) {    
   if (document.getElementById("displaytable1").style.display === "none")     
   document.getElementById("displaytable1").style.display = "inline-flex"; 

   else document.getElementById("displaytable1").style.display = "none";
});
</script>







        </section>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
