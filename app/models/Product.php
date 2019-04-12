<?php

	class Product {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		// Get the products from DB 
		public function getProducts() {
			
			$this->db->query("SELECT products.product_id, products.product_title, products.product_price, products.product_image, AVG(product_ratings.rating) AS rating FROM products LEFT JOIN product_ratings ON products.product_id = product_ratings.product_id GROUP BY products.product_id");

			$results = $this->db->resultset();

      		return $results;
		}

		// Get the products from DB by id
		public function getProductById($id) {

			$this->db->query("SELECT * FROM products WHERE product_id = :id");

			$this->db->bind(":id", $id);
      
     		$results = $this->db->resultset();

      		return $results;
		}

		// Get the constant price from DB
		public function getProductPriceBySession($id) {

			$this->db->query("SELECT product_price FROM products WHERE product_id = :id");

			$this->db->bind(":id", $id);
      
     		$row = $this->db->single();

      		return $row;
		}
	}