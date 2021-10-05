<?php

class Model extends Database {

	protected function getAllProducts() {
		$sql = "SELECT * FROM products WHERE is_draft = 0";
		$result = $this->connect()->query($sql);
		$numRows = $result->num_rows;
		if($numRows > 0){
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
			return $data; 
		}
	}

	protected function insertProduct($data) {
		$sql = "INSERT INTO products (product_name, stock, price) VALUES ('".$data['name']."','".$data['stock']."','".$data['price']."')";
		$result = $this->connect()->query($sql);
		return $result;
	}

	protected function updateProduct($data) {
		$sql = "UPDATE products SET product_name = '".$data['name']."', stock = '".$data['stock']."', price = '".$data['price']."' WHERE id = '".$data['id']."' ";
		$result = $this->connect()->query($sql);
		return $result;
	}

	protected function updateStock($data) {
		$sql = "UPDATE products SET stock = ".$data['updated_stock']." WHERE id = '".$data['id']."'";
		$result = $this->connect()->query($sql);
		return $result;
	}

	protected function deleteProduct($data) {
		$sql = "UPDATE products SET is_draft = 1 WHERE id = '".$data['id']."'";
		$result = $this->connect()->query($sql);
		return $result;
	}

}