<?php
	include 'includes/session.php';

include('dbcon.php');
$item = $_GET['product'];

$sql = "SELECT * FROM `product` WHERE `item_type` = '$item' ";
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




	$output = array('error'=>false);

	$id = $_POST['id'];
	$quantity = $_POST['quantity'];

	if(isset($_SESSION['user'])){
		$stmt = $con->prepare("SELECT *, COUNT(*) AS numrows FROM cart WHERE uid=:uid AND product_id=:product_id");
		$stmt->execute(['uid'=>$user['id'], 'product_id'=>$id]);
		$row = $stmt->fetch();
		if($row['numrows'] < 1){
			try{
				$stmt = $conn->prepare("INSERT INTO cart (uid, product_id, quantity) VALUES (:uid, :product_id, :quantity)");
				$stmt->execute(['uid'=>$user['id'], 'product_id'=>$id, 'quantity'=>$quantity]);
				$output['message'] = 'Item added to cart';
				
			}
			catch(PDOException $e){
				$output['error'] = true;
				$output['message'] = $e->getMessage();
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Product already in cart';
		}
	}
	else{
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
		}

		$exist = array();

		foreach($_SESSION['cart'] as $row){
			array_push($exist, $row['productid']);
		}

		if(in_array($id, $exist)){
			$output['error'] = true;
			$output['message'] = 'Product already in cart';
		}
		else{
			$data['productid'] = $id;
			$data['quantity'] = $quantity;

			if(array_push($_SESSION['cart'], $data)){
				$output['message'] = 'Item added to cart';
			}
			else{
				$output['error'] = true;
				$output['message'] = 'Cannot add item to cart';
			}
		}

	}

	$pdo->close();
	echo json_encode($output);

?>