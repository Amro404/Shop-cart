<?php require APPROOT . "/views/inc/header.php"; ?>

	<center><h1 style="margin: 40px;">Cart Details</h1></center>
	<form action="" method="post">
		<table class="table table-striped">
	        <thead>
	          	<tr>
			        <th>Product</th>
			        <th>Price</th>
			        <th>Quantity</th>
			       	<th>Sub-total</th>
			       	<th>Write quantity</th>
			       	<th>Controllers</th>
			       	<th>Rate from 5: </th>
	          	</tr>
	        </thead>


	       <?php foreach($_SESSION["cart_item"] as $item):?>

		   <tbody>
		          
			<tr>
			  	<td><?php echo $item["name"]; ?><br>


					<img src="<?php echo URLROOT; ?>/assets/images/<?php echo $item["image"]; ?>" width="100">


				</td>

				<td>$<?php
				 $price = $this->productModel->getProductPriceBySession($item["code"]);
				 echo $price->product_price;
					?>
						
				</td>

				<td><?php echo $item["quantity"]; ?></td>
				<td>$<?php echo $item["price"]; ?></td>

				<form method="POST" action="<?php echo URLROOT; ?>/pages/cart/">

					<td>
						<input style="width: 120px;" type="number" name="newQuantity">
					</td>


					<td>
						<input type="hidden" name="num" value="<?php echo  $item["code"]; ?>">
						<input class="btn btn-success" name="add" type="submit" value="Add"> 
						<input class="btn btn-warning" name="remove" type="submit" value="Remove"> 
						
					</td>

				</form>

				<td>
					<?php
						if(isset($_SESSION["ratedMsg_" . $item["code"]])) {
							echo $_SESSION["ratedMsg_" . $item["code"]];
						} else {
							foreach (range(1, 5) as $rating):
								?>
								<a style="text-decoration: none;" href="<?php echo URLROOT; ?>/pages/cart/?product=<?php echo $item["code"] . "&rate=" . $rating;?>"><b><?php echo $rating . " ";  ?></b></a>  
								<?php
							endforeach;
						}
					?>

				</td>
				



			</tr>



			<tr>
			</tr>
			</tbody>

			<?php endforeach;?>

		</table>

		
	<div class="col-xs-4 pull-right ">

			<a href="<?php echo URLROOT; ?>/pages/cart/?pay=<?php echo $item["code"]; ?>"  class="btn btn-primary"><b><i>PAY Here!</i></b></a>

			<a class="btn btn-danger" href="<?php echo URLROOT; ?>/pages/cart?q=delete_cart">

				Empty Cart 
					
			</a>

		<h2 style="margin: 30px 0 30px 0">Cart Totals</h2>

			<table class="table table-bordered" cellspacing="0">

			<tbody>
		

				<tr class="cart-subtotal">
					<th>transport type:</th>
					<td><span class="amount">
						<div class="btn-group dropright">
						  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    Choose
						  </button>
						  <div class="dropdown-menu">
						    <a class="dropdown-item" href="<?php echo URLROOT; ?>/pages/cart/?trans-pickup=<?php echo count($_SESSION["cart_item"])?>">Pick up: 0$ costs</a>
					    	<a class="dropdown-item" href="<?php echo URLROOT; ?>/pages/cart/?trans-ups=<?php echo count($_SESSION["cart_item"]);?>">UPS: 5$ costs</a>
						  </div>
						</div>
					</span></td>
				</tr>

				<tr class="total-cash">
					<th>Items:</th>
					<td><strong><span class="cash">
					<?php
						$items = 0;
						foreach ($_SESSION["cart_item"] as $key => $value) {
							$items += $value["quantity"];
						}
						echo $items;
					?>


					</span></strong> </td>
				</tr>

				<tr class="total-cash">
					<th>Your total money</th>
					<td><strong><span class="cash">$<?php echo $_SESSION["total_cash"]; ?>


					</span></strong> </td>
				</tr>
				<tr class="order-total">
					<th>Order Total</th>
					<td><strong><span class="amount">$
					<?php
						$total = 0;
						foreach ($_SESSION["cart_item"] as $key => $value) {
							$total += $value["price"];
						}
						if (isset($_SESSION["trans-cost"])) {
							echo $total + $_SESSION["trans-cost"];
						} else {
							echo $total;
						}
					?>


					</span></strong> </td>
				</tr>


			</tbody>

		</table>

	</div>
	
<?php require APPROOT . "/views/inc/footer.php"; ?>