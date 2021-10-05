<?php
	include 'include/database.php';
	include 'include/model.php';
	include 'include/controller.php';

	if(isset($_POST['action']) ) {
	    $controller = new Controller; 
	    if($_POST['action'] == "addProduct"){
	    	$controller->addProduct($_POST);
	    }else if ($_POST['action'] == "editProduct") {
	    	$controller->editProduct($_POST);
	    }else if ($_POST['action'] == "editStock"){
	    	$controller->editStock($_POST);
	    }else if ($_POST['action'] == "draftProduct"){
	    	$controller->draftProduct($_POST);
	    }
	    exit;
	} 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Stock Management System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/products.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="assets/js/products.js"></script>

</head>
<body>
	<div class="jumbotron text-center">
	  <h3>West Acton</h3>
	  <p>Stock Management System</p> 
	</div>
	<div class="container">
	  <div class="row">
	    <div class="col-sm-12 text-left">
	      <h2>
	      	List of products
             <button type="button" class="btn btn-success float-right"><i class="fas add-btn" data-toggle="modal" data-target="#modalProduct">Add</i></button>
	      </h2>
	      <table class="table table-hover" >
		    <thead>
		      <tr>
		      	<th>Product ID</th>
		        <th>Product name</th>
		        <th>Stock</th>
		        <th>Price per stock</th>
		        <th>Sold 
	      			<button type="button" class="btn btn-primary float-right"><i class="fas sale-btn" data-toggle="modal" data-target="#modalSale">Calculate Sale</i></button>
		        </th>
		        <th>Actions</th>
		      </tr>
		    </thead>
		    <tbody id="product-table">
		    	<?php 
					$products = new Controller();
					$products->viewAllProducts();
				 ?>
		    </tbody>
		  </table>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="modalProduct">
		<div class="modal-dialog modal-sm">
		  <div class="modal-content">
		  
		    <div class="modal-header">
		      <h4 class="modal-title">Add Product</h4>
		    </div>
		    
		    <div class="modal-body">
			  <div class="form-group">
			    <input type="hidden" class="form-control" id="id">
			    <label for="product-name">Product name</label>
			    <input type="text" class="form-control" placeholder="Enter name" id="product-name">
			  </div>
			  <div class="form-group">
			    <label for="stock">Stock</label>
			    <input type="text" class="form-control" placeholder="Enter stock" id="stock">
			  </div>
			  <div class="form-group">
			    <label for="price">Price</label>
			    <input type="text" class="form-control" placeholder="Enter price" id="price">
			  </div>
		    </div>
		    
		    <div class="modal-footer">
		      <button type="button" class="btn btn-success save-btn" data-dismiss="modal">Save</button>
		      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		    </div>
		    
		  </div>
		</div>
	</div>

	<div class="modal fade" id="calculateSale" role="dialog">
		<div class="modal-dialog modal-sm">
		  <div class="modal-content">
		    <div class="modal-body">
		      <p>Calculating sale.....</p>
		    </div>
		  </div>
		</div>
	</div>

</body>
</html>