<?php

	class Rate {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		// Insert product rate in DB
		public function insertNewRate($product_id, $rate) {

			$this->db->query("INSERT INTO product_ratings (product_id, rating) VALUES (:product_id, :rating)");
			$this->db->bind(":product_id", $product_id);
			$this->db->bind(":rating", $rate);

			$this->db->execute();
				


		}
	}