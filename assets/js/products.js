$(document).ready(function (){
	$(".save-btn").click(function(e){
		e.preventDefault();
		var name = $('#product-name').val(),
		stock = $('#stock').val(),
		price = $('#price').val(),
		prod_id = $('#id').val();

		if(prod_id == ""){
			$.ajax({
				type: "POST",
				url: 'index.php',
				data: {action: 'addProduct', name: name, stock: stock, price: price},
				dataType: 'json',
				success: function(response){
					window.location.reload(true);
				}
			});
		}else{
			$.ajax({
				type: "POST",
				url: 'index.php',
				data: {action: 'editProduct', name: name, stock: stock, price: price, id: prod_id},
				dataType: 'json',
				success: function(response){
					window.location.reload(true);
				}
			});
		}
	});

	$(".add-btn").click(function(e){
		e.preventDefault();
		$('.modal-title').text("Add Product");
		$('#product-name, #stock, #price, #id').val("");
		$('#modalProduct').modal({
		    backdrop: 'static',
		    keyboard: false
		});
	});

	$(".edit-btn").click(function(e){
		e.preventDefault();
		var tr = $(this).closest('tr');
		var prod_id = tr.attr('product_id'), name = tr.attr('name'), stock = tr.attr('stock'), price = tr.attr('price');
		$('.modal-title').text("Edit Product");
		$('#product-name').val(name);
		$('#stock').val(stock);
		$('#price').val(price);
		$('#id').val(prod_id);
		$('#modalProduct').modal('show');
		$('#modalProduct').modal({
		    backdrop: 'static',
		    keyboard: false
		});
	});

	$(".draft-btn").click(function(e){
		e.preventDefault();
		var tr = $(this).closest('tr');
		var prod_id = tr.attr('product_id'), name = tr.attr('name');
		if (confirm('Click OK if you want to delete '+name )) {
		    $.ajax({
				type: "POST",
				url: 'index.php',
				data: {action: 'draftProduct', id : prod_id},
				dataType: 'json',
				success: function(response){
					window.location.reload(true);
				}
			});
		}
	});

	$(document).on('keyup', '.sold-text', function() {
		var tr = $(this).closest('tr');
		var prod_id = tr.attr('product_id'), name = tr.attr('name'), stock = tr.attr('stock'), price = tr.attr('price');
		var sold = $(this).val();
		sold = Number(sold);
		stock = Number(stock);
		if(sold > stock){
			$(this).val("");
		}
	});

	$(".sale-btn").click(function(e){
		var count = 0, error = false;
        var total_sale = 0;
        var time = 2000;
        var reload_page = 0;

        $('#product-table tr').each(function() {
		    var sold = $(this).find('.sold-text').val();
		    sold = Number(sold);

		    if(sold != ""){
		    	count++;
	    	}
		 });

        if(count > 0){
        	$('#calculateSale').modal('show');
        }

		$('#product-table tr').each(function() {
		    var sold = $(this).find('.sold-text').val();
		    var stock = $(this).attr('stock');
		    var price = $(this).attr('price');
		    var prod_id = $(this).attr('product_id');
		    var updated_stock = 0;

		    sold = Number(sold);
		    stock = Number(stock);
		    price = Number(price);

		    if(sold != ""){
		    	total_sale = total_sale + (sold * price);
		    	console.log(prod_id+","+sold+","+stock);
		    	updated_stock = stock - sold;

		    	setTimeout(function(){
			    	$.ajax({
						type: "POST",
						url: 'index.php',
						data: {action: 'editStock', updated_stock: updated_stock, id : prod_id},
						dataType: 'json',
						success: function(response){
							++reload_page;
							if(reload_page == count){
								alert("Total sale: "+total_sale);
								window.location.reload(true);
							}
						}
					});
				}, time);
				time += 2000;
	    	}
		 });

    });
});