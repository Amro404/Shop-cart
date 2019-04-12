<?php
	class Pages extends Controller {
		public function __construct() {
			$this->productModel = $this->model("Product");
			$this->rateModel = $this->model("Rate");
		}

		// Home page
		public function index() {

			session_start();

			//Set Data
			$products = $this->productModel->getProducts();
			
			// Store the total cash in a session 
			$_SESSION["total_cash"] = 100;
			
			// Store data
			$data = ["products" => $products];


			$this->view("pages/index", $data);


			
		}

		// Cart Page
		public function cart() {

			session_start();
			// Check of value of item id
			if(isset($_GET["action"]) && !empty($_GET["action"]) && $_GET["action"] === "add") {
				if(!empty($_POST["quantity"])){

					// Sanitize the id of item
					$id = filter_var($_GET["code"], FILTER_SANITIZE_NUMBER_INT);

					$productById = $this->productModel->getProductById($id);

					$itemArray = [
						$productById[0]->product_id =>[
							'name'=>$productById[0]->product_title,
							'code'=>$productById[0]->product_id,
							'quantity'=>$_POST["quantity"],
							'rated'=> 0,
							'price'=>$productById[0]->product_price,
							'image'=>$productById[0]->product_image
						]
					];


					//Storing itemArrey data to sessions
					if(!empty($_SESSION["cart_item"])) {
						if(in_array($productById[0]->product_id ,array_keys($_SESSION["cart_item"]))) {
							foreach($_SESSION["cart_item"] as $k => $v) {
									if($productById[0]->product_id == $v) {
										if(empty($_SESSION["cart_item"][$k]["quantity"])) {
											$_SESSION["cart_item"][$k]["quantity"] = 0;
										}
										$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
									}
							}
						} else {
							$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
						}
					} else {
						$_SESSION["cart_item"] = $itemArray;
					}
				}	
				
				


			}

			// add items from the cart in different quantities.
			if(isset($_POST["num"]) && isset($_POST["newQuantity"])) {
				if(isset($_POST["add"])) {
					foreach ($_SESSION["cart_item"] as $key => $value) {
						if($_POST["num"] == $value["code"]) {
							$_SESSION["cart_item"][$key]["quantity"] += $_POST["newQuantity"];
							$price = $this->productModel->getProductPriceBySession($_POST["num"]);
							$_SESSION["cart_item"][$key]["price"] = $_SESSION["cart_item"][$key]["quantity"] * $price->product_price;
						}
					}

				// remove items from the cart in different quantities.
				}else if(isset($_POST["remove"])) {
					foreach ($_SESSION["cart_item"] as $key => $value) {
						if($_POST["num"] == $value["code"]) {
							if($_SESSION["cart_item"][$key]["quantity"] >= $_POST["newQuantity"]) {
								$_SESSION["cart_item"][$key]["quantity"] -= $_POST["newQuantity"];
								$price = $this->productModel->getProductPriceBySession($_POST["num"]);
								$_SESSION["cart_item"][$key]["price"] = $_SESSION["cart_item"][$key]["quantity"] * $price->product_price;
								if($_SESSION["cart_item"][$key]["quantity"] == 0) {
									unset($_SESSION["cart_item"][$key]);
								}
							}
						}
					}
				}



			// Rate the product
			} else if(isset($_GET["product"]) && isset($_GET["rate"]) && $_GET["rate"] <= 5) {
				$product_id = filter_var($_GET["product"], FILTER_SANITIZE_NUMBER_INT);
				$rate	    = filter_var($_GET["rate"], FILTER_SANITIZE_NUMBER_INT);

				foreach ($_SESSION["cart_item"] as $key => $val) {
					if($product_id  == $val["code"]) {
						if($_SESSION["cart_item"][$key]["rated"] < 1) {
							$this->rateModel->insertNewRate($product_id, $rate);
							$_SESSION["cart_item"][$key]["rated"] = 1;
						} else if($_SESSION["cart_item"][$key]["rated"] == 1){
							$_SESSION["ratedMsg_" . $product_id] = "You rated once, thank you.";
						}
					}
			
				} 
				

			// Delete the cart
			} else if(isset($_GET["q"]) && $_GET["q"] === "delete_cart") {

				foreach ($_SESSION["cart_item"] as $key => $value) {
					unset($_SESSION["ratedMsg_" . $value["code"]]);
					
				}
				// Unset sessions
				unset($_SESSION["cart_item"]);
				unset($_SESSION["trans-cost"]);
		

				redirect("");
  				

  			// Transport options
			} else if(isset($_GET["trans-pickup"])) {
				
					$_SESSION["trans-cost"] = 0;
		
			} else if(isset($_GET["trans-ups"])) {
				
					$_SESSION["trans-cost"] = 5;
				
				// Check for pay method
			} else if(isset($_GET["pay"])) {
				if (!empty($_SESSION["cart_item"])) {
					if(!isset($_SESSION["trans-cost"])) {
						?>
							<script type="text/javascript">
								alert("Please choose transport type.")
							</script>
						<?php
					} else {
						foreach ($_SESSION["cart_item"] as $key => $value) {
							$_SESSION["total_cash"] -= $_SESSION["cart_item"][$key]["price"] + $_SESSION["trans-cost"];
						}
					}
				}
			}	



			


	
			//Load the view
			$this->view("pages/cart", $_SESSION["cart_item"]);


		

		}
	}