<?php
session_start();

if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = [];
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>
		Products
	</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<style>
	<?php include 'style.css'; ?>
</style>

<body>
	<?php include 'header.php'; ?>
	<div id="main">
		<div id="products">

		</div>
	</div>

	<table id="t1"></table>
	<br>
	<h3 id="t4"></h3>
	<br>
	<div id="t3"></div>

	<?php
	include 'config.php';
	?>
	<script>
		var l = 0;
		//function display1 to display cart 
		function display1(ans) {
			var amt = 0;
			if (ans.length == 0) {
				var s = "<th><b>cart is empty</b></th>";
				$("#t1").html(s);
				$('#hidebutton').hide();
				amt = 0;
				$("#t4").html("");
			} else {
				var s = "<tr><th>Id</th><th>Name</th><th></th><th>Price</th><th></th><th>Quantity</th><th colspan=2>Option</th></tr>";
				ans.forEach((element, id) => {
					s +=
						"<tr><td>" +
						element.id +
						"</td><td>" +
						element.name +
						"</td><td>" +
						"<img  src = " +
						element.image +
						"></td><td> $" +
						element.price +
						"</td></td><td><button id=" + id +
						" onclick='dec(id)' class='common'>-</button></td><td id=" +
						element.id +
						">" +
						element.q +
						"</td><td><button id=" + id +
						" onclick='inc(id)' class='common'>+</button><td><button id=" + id + " class='common1' onclick ='del(id)'>Delete</button></td></td></tr>";
					$("#t1").html(s);
					var amount = parseInt(element.price) * parseInt(element.q);
					amt = amt + amount;
				});
				var k = "<button class='common1' id='hidebutton' onclick='emptyCart()'>Empty cart</button>";
				$("#t3").html(k);
				$("#t4").html("Your Total $" + amt);

			}
		}

		var prod = <?php echo json_encode($products); ?>;
		console.log(prod);
		display();
		//function display to display products 
		function display() {
			var k = l++;
			var s = "";
			prod.forEach((element) => {
				s +=
					"<div id='product-101' + class='product'>" +
					"<img src = " +
					element.image +
					"><h3 class='title'><a href='#'>Product " +
					element.id +
					"</a></h3><span> Price $" +
					element.price +
					"</span><a class='add-to-cart'   id=" +
					element.id +
					" onclick= 'add(id)' href='#'>Add To Cart</a></div>";
				$("#products").html(s);
			});
		}
		//function add to add items to cart 
		function add(x) {
			var y = x;
			$.ajax({
				url: "add.php",
				type: "POST",
				data: "x=" + y,
				dataType: "json"

			}).done(function(ans) {
				display1(ans);
			})
		}
		//function del to delete items in cart
		function del(x) {
			var y = x;
			$.ajax({
				url: "del.php",
				type: "POST",
				data: "x=" + y,
				dataType: "json"

			}).done(function(ans) {
				if (confirm("Are you sure want to delete?")) {
					display1(ans);
				}
			})
		}
		//function inc to increase quantity of item in cart

		function inc(x) {
			var y = x;
			$.ajax({
				url: "inc.php",
				type: "POST",
				data: "x=" + y,
				dataType: "json"

			}).done(function(ans) {
				display1(ans);
			})
		}
		//function dec to decrease quantity of item in cart
		function dec(x) {
			var y = x;
			$.ajax({
				url: "dec.php",
				type: "POST",
				data: "x=" + y,
				dataType: "json"

			}).done(function(ans) {

				display1(ans);
			})
		}
		//function emptyCart to empty cart
		function emptyCart() {
			$.ajax({
				url: "empty.php",
				type: "POST",
				dataType: "json"

			}).done(function(ans) {
				if (confirm("Are you sure want to empty cart?")) {
					display1(ans);
					$('#hidebutton').hide();
				}
			})
		}
	</script>

	<?php include 'footer.php'; ?>
</body>

</html>