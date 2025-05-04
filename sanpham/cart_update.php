<?php
if (!isset($_SESSION))
	session_start();
//include('libs/common.php');
//empty cart by distroying current session
if (isset($_GET["emptycart"]) && $_GET["emptycart"] == 1) {
	$return_url = base64_decode($_GET["return_url"]); //return url
	session_destroy();
	header('Location:' . $return_url);
}
if (isset($_POST["update"]) && $_POST["update"] == 'update') {
	$qty = $_POST['quantity']; //Mảng truyền qua   
	$return_url 	= base64_decode($_POST["return_url"]); //return url
	//echo "<br> URL= " .$return_url;
	foreach ($qty as $key => $sl) {
		// echo "<br> key= " .$key. " - Val= " .$val;
		if ($sl == 0) {
			unset($_SESSION['cart'][$key]);
		} else {
			$_SESSION['cart'][$key]['quantity'] = $sl;
		}
	}
	//redirect back to original page
	echo '<meta http-equiv="refresh" content="0; url=' . $return_url . '">';
	//header('Location:'.$return_url);
	//echo "<script>location.href=" .$return_url. ";</script>";
}
//Cách khác
if (isset($_POST["type"]) && $_POST["type"] == 'addcart') {
	$id 	= filter_var($_POST["product_code"]); //mã sp
	$name = filter_var($_POST['tensp']);
	$quantity 	= filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT); //product code
	$return_url 	= base64_decode($_POST["return_url"]); //return url
	$price = filter_var($_POST['price']);

	echo "Code= " . $id;
	echo "Name= " . $name;
	echo "Price= " . $price;
	echo "<br>Qty= " . $quantity;
	if (isset($_SESSION['cart'][$id])) {
		if (!isset($quantity)) //ko tồn tại sl
			$_SESSION['cart'][$id]['quantity']++;
		else
			$_SESSION['cart'][$id]['quantity'] += $quantity;
	} else {

		// $sql="SELECT * FROM SAN_PHAM WHERE idsp={$id}"; 
		// $query_s=mysqli_query($db,$sql);
		//$n=mysqli_num_rows($query_s);

		// if(mysqli_num_rows($query_s)>0){ 
		// $row_s=mysqli_fetch_array($query_s); 
		////$_SESSION['cart'][$key]['quantity']=$val
		//$_SESSION['cart'][$row_s['idsp']]=array( "quantity" => $quantity,"price" => $row_s['gianhap']); 
		if (isset($id)) {
			$_SESSION['cart'][$id] = array("quantity" => $quantity, "name" => $name, "price" => $price);
		} else {
			$message = "This product id it's invalid!";
		}
	}
	//echo var_dump($_SESSION['cart']);
	//redirect back to original page
	header('Location:' . $return_url);
	//session_destroy();
	//die();
}

//remove item from shopping cart
if (isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["products"])) {
	$product_code 	= $_GET["removep"]; //get the product code to remove
	$return_url 	= base64_decode($_GET["return_url"]); //get return url
	foreach ($_SESSION["products"] as $cart_itm) //loop through session array var
	{
		if ($cart_itm["code"] != $product_code) { //item does,t exist in the list
			$product[] = array('name' => $cart_itm["name"], 'code' => $cart_itm["code"], 'qty' => $cart_itm["qty"], 'price' => $cart_itm["price"]);
		}
		//create a new product list for cart
		$_SESSION["products"] = $product;
	}

	//redirect back to original page
	header('Location:' . $return_url);
}

//add item in shopping cart ko sd
if (isset($_POST["type"]) && $_POST["type"] == 'add') {
	$product_code 	= filter_var($_POST["product_code"]); //mã sp
	$name = filter_var($_POST['tensp']);
	$price = filter_var($_POST['price']);
	$product_qty 	= filter_var($_POST["quantity"], FILTER_SANITIZE_NUMBER_INT); //product code
	$return_url 	= base64_decode($_POST["return_url"]); //return url

	echo "Code= " . $product_code;
	echo "<br>Name= " . $name;
	echo "Price= " . $price;
	echo "<br>Qty= " . $product_qty;

	//limit quantity for single product
	/*if($product_qty > 10){
		die('<div align="center">This demo does not allowed more than 10 quantity!<br /><a href="http://sanwebe.com/assets/paypal-shopping-cart-integration/">Back To Products</a>.</div>');
	}*/

	//MySqli query - get details of item from db using product code
	//$results = $db->query("SELECT product_name,GIA FROM products WHERE product_code='$product_code' LIMIT 1");
	//$obj = $results->fetch_object();
	//$sql="SELECT TENSP,GIA FROM SANPHAM WHERE MASP='$product_code' LIMIT 1";
	//$obj=SelectAll($sql);

	//if (isset($obj)) 
	if (isset($product_code) && isset($price)) { //we have the product info 

		//prepare array for the session variable
		//$new_product = array(array('name'=>$obj[0]['TENSP'], 'code'=>$product_code, 'qty'=>$product_qty, 'price'=>$obj[0]['GIA']));
		$new_product = array(array('name' => $name, 'code' => $product_code, 'qty' => $product_qty, 'price' => $price));
		//echo "product= " .var_dump($new_product);
		if (!isset($_SESSION["products"]))
			$_SESSION["products"] = $new_product;
		if (isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false

			foreach ($_SESSION["products"] as $cart_itm) //loop through session array
			{
				if ($cart_itm["code"] == $product_code) { //the item exist in array, kiểm tra đã tồn tại

					$product[] = array('name' => $cart_itm["name"], 'code' => $cart_itm["code"], 'qty' => $product_qty, 'price' => $cart_itm["price"]);
					$found = true;
				} else {
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('name' => $cart_itm["name"], 'code' => $cart_itm["code"], 'qty' => $cart_itm["qty"], 'price' => $cart_itm["price"]);
				}
			}
			if ($found == false) //we didn't find item in array
			{
				//add new user item in array
				$_SESSION["products"] = array_merge($product, $new_product);
			} else {
				//found user item in array list, and increased the quantity
				$_SESSION["products"] = $product;
			}
		}
		//else{
		//create a new session var if does not exist
		//	$_SESSION["products"] = $new_product;
		//}		
	}
	//redirect back to original page
	//header('Location:'.$return_url);
}
