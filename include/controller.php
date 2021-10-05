<?php

class Controller extends Model {

	public $datas;

	function __construct() {
		
	}

	public function viewAllProducts() {
		$this->datas = $this->getAllProducts();
		foreach ($this->datas as $key => $data) {
			$attr = "";
			if($data['stock'] == 0){
				$attr = 'disabled';
			}

			echo "<tr product_id='".$data['id']."' id='".$data['id']."' name='".$data['product_name']."' stock='".$data['stock']."' price='".$data['price']."'>";
			echo "<td>".$data['id']."</td>";
			echo "<td>".$data['product_name']."</td>";
			echo "<td>".$data['stock']."</td>";
			echo "<td>".$data['price']."</td>";
			echo "<td><input type='number' class='form-control sold-text' ".$attr." max='".$data['stock']."'></td>";
			echo "<td>
          		<button type='button' class='btn btn-success edit-btn'><i class='fas'>Edit</i></button>
        		<button type='button' class='btn btn-danger draft-btn'><i class='far'>Delete</i></button>
			</td>";
			echo "</tr>";
		}
	}

	public function addProduct($data){
		$result = $this->insertProduct($data);
		echo json_encode($result);
		exit;
	}

	public function editProduct($data){
		$result = $this->updateProduct($data);
		echo json_encode($result);
		exit;
	}

	public function editStock($data){
		$result = $this->updateStock($data);
		echo json_encode($result);
		exit;
	}

	public function draftProduct($data){
		$result = $this->deleteProduct($data);
		echo json_encode($result);
		exit;
	}

}