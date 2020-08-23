<?php
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
	if(!empty($_SESSION["shopping_cart"])) {
		foreach($_SESSION["shopping_cart"] as $key => $value) {
			if($_POST["code"] == $key){
				unset($_SESSION["shopping_cart"][$key]);
				$status = "<script type='text/javascript'>
				alert('Product is removed from your cart!');
				</script>";
			}
			if(empty($_SESSION["shopping_cart"]))
				unset($_SESSION["shopping_cart"]);
		}		
	}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
	foreach($_SESSION["shopping_cart"] as &$value){
		if($value['code'] === $_POST["code"]){
			$value['quantity'] = $_POST["quantity"];
			break;
		}
	}

}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/body.css"/>
	<link rel="stylesheet" type="text/css" href="css/header.css"/>
	<link rel="stylesheet" type="text/css" href="css/table.css"/>
</head>
<body>
	<body>
		<div class="top-container">
			<div style="background-color :lightgrey;
			padding: 10px;
			border-radius :5px;">
			<h1>Ax Mebel</h1>
		</div>
	</div>

	<div class="header" id="myHeader" style="background: grey">
		<a class="active" href="product.php">Back</a>
	</div>
	<br>

	<div class="cart">
		<?php
		if(isset($_SESSION["shopping_cart"])){
			$total_price = 0;
			?>
			<br>
			<center>
				<table id="tableproduct">
					<tbody>
						<tr>
							<td></td>
							<th>ITEM NAME</th>
							<th>QUANTITY</th>
							<th>UNIT PRICE</td>
								<th>ITEMS TOTAL</th>
							</tr>	
							<?php		
							foreach ($_SESSION["shopping_cart"] as $product){
								?>
								<tr>
									<td><img src='<?php echo $product["image"]; ?>' width="50" height="40" /></td>
									<td><?php echo $product["name"]; ?><br />
										<form method='post' action=''>
											<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
											<input type='hidden' name='action' value="remove" />
											<button type='submit' class='remove'>Remove Item</button>
										</form>
									</td>
									<td>
										<form method='post' action=''>
											<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
											<input type='hidden' name='action' value="change" />
											<select name='quantity' class='quantity' onchange="this.form.submit()">
												<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
												<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
												<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
												<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
												<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
											</select>
										</form>
									</td>
									<td><?php echo "$".$product["price"]; ?></td>
									<td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
								</tr>
								<?php
								$total_price += ($product["price"]*$product["quantity"]);
							}
							?>
							<tr>
								<td colspan="5" align="right">
									<strong>TOTAL: <?php echo "$".$total_price; ?></strong>
								</td>
							</tr>
						</tbody>
					</table>
				</center>			
				<?php
			} else {
				header("location:product.php");
			}
			?>
		</div>

		<div style="clear:both;"></div>

		<div class="message_box" style="margin:10px 0px;">
			<?php echo $status; ?>
		</div>
		<br /><br />
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