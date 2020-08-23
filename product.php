<?php
session_start();
include('db.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
	$code = $_POST['code'];
	$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
	$row = mysqli_fetch_assoc($result);
	$name = $row['name'];
	$code = $row['code'];
	$price = $row['price'];
	$image = $row['image'];

	$cartArray = array(
		$code=>array(
			'name'=>$name,
			'code'=>$code,
			'price'=>$price,
			'quantity'=>1,
			'image'=>$image)
	);

	if(empty($_SESSION["shopping_cart"])) {
		$_SESSION["shopping_cart"] = $cartArray;
		echo '<script type="text/javascript">
		alert("Product is added to your cart!");
		</script>';
		//$status = "<div class='box'>Product is added to your cart!</div>";
	} else {
		$array_keys = array_keys($_SESSION["shopping_cart"]);
		if(in_array($code,$array_keys)) {
			echo '<script type="text/javascript">
			alert("Product is already added to your cart!");
			</script>';
		} else {
			$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
			echo '<script type="text/javascript">
			alert("Product is added to your cart!");
			</script>';
		}

	}
}
?>

<html>
<head>
	<title>Product</title>
	<link rel="stylesheet" type="text/css" href="css/header.css" />
	<link rel="stylesheet" type="text/css" href="css/body.css" />
	<link rel="stylesheet" type="text/css" href="css/slids.css" />
	<link rel="stylesheet" type="text/css" href="css/cardview.css"/>
	<link rel="stylesheet" type="text/css" href="css/footer.css"/>
	<link rel="stylesheet" type="text/css" href="css/video.css"/>
	<link rel='stylesheet' href='css/cart.css' type='text/css' media='all' />
</head>
<body>
	<div class="top-container">
		<div style="background-color :lightgrey;
		padding: 10px;
		border-radius :5px;">
		<h1>Ax Mebel</h1>
	</div>
</div>

<div class="header" id="myHeader" style="background: grey">
	<a class="active" href="index.html">Back</a>
	<?php

	if(!empty($_SESSION["shopping_cart"])) {
		$cart_count = count(array_keys($_SESSION["shopping_cart"]));
		?>
		<div class="cart_div">
			<a href="cart.php"><img src="images/cart-icon.png" /> Cart<span><?php echo $cart_count; ?></span></a>
		</div>
		<?php
	}?>
</div>
<br>

<?php
$result = mysqli_query($con,"SELECT * FROM `products`");
while($row = mysqli_fetch_assoc($result)){
	echo "<div class='cardcolumn2'>
	<div class='card'>
	<form method='post' action=''>
	<input type='hidden' name='code' value=".$row['code']." />
	<img src='".$row['image']."' style = 'width:100%'/>
	<h2>".$row['name']."</h2>
	<div class='price'>$".$row['price']."</div>
	<button type='submit' class='buy'>Add to Cart</button>
	</form>
	</div>
	</div>";
}

mysqli_close($con);
?>

<div style="clear:both;"></div>
<div class="message_box" style="margin:10px 0px;">
	<?php echo $status; ?>
</div>

<br /><br />

<div class="footer">
	<img class = "socialpic" src="images/pinterest.png" alt="pinterest">
	<img class = "socialpic" src="images/facebook.png" alt="facebook">
	<img class = "socialpic" src="images/twitter.png" alt="twitter">
	<img class = "socialpic" src="images/instagram.png" alt="instagram">
</div>

<script>
	window.onscroll = function() {myFunction()};

	var header = document.getElementById("myHeader");
	var sticky = header.offsetTop;

	function myFunction() {
		if (window.pageYOffset > sticky) {
			header.classList.add("sticky");
		} else {
			header.classList.remove("sticky");
		}
	}
</script>
</body>
</html>