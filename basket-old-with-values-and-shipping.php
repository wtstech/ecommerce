<?php

require __DIR__.'/includes/config.php';

use App\ProductImage;
$productImageObj = new ProductImage;

if(isset($_POST['cart'])){

	$cartObj->updateCart();

}

if(isset($_POST['code'])){

	$promoObj->checkPromoCode();

}


if(isset($_GET['delete'])){

	$cartObj->delete($_GET['delete']);

}

if(isset($_POST['shipping'])){

	$cartObj->setShipping();

}

require 'header.php';

?>

<script>

$(function(){

	$('#shipping').change(function(){
	
		$('#shipping-form').submit();
	
	});

});

</script>

<div class="container-fluid no-padding-ever">
	<div class="page-title-container">
		<div class="container">
		<div class="col-sm-12">
		<i class="fa fa-shopping-cart"></i>
		<h1>SHOPPING CART</h1>
		</div>
		</div>
	</div>
</div>

<div class="container">

<?php if( !$cartObj->countItems() ){ ?>

<p class="mb-100">Your shopping cart is currently empty.</p>

<?php } else { ?>

<?php require __DIR__.'/includes/flash-messages.php'; ?>

	<div class="table-responsive">

		<table class="table">
						<thead>
							<tr>
								<th style="width:50%">Product</th>
								<th style="width:10%">Price</th>
								<th style="width:8%">Quantity</th>
								<th style="width:22%" class="text-center">Subtotal</th>
								<th style="width:10%"></th>
							</tr>
						</thead>
						<tbody>
						
							<form action="" method="post">
							<input type="hidden" name="cart">
							
							<?php foreach( $cartObj->getAll() as $row ){ ?>
							
								<tr>
									<td>
										<div class="row">
											<div class="col-sm-2 hidden-xs">
			
			<img style="width:80px" src="product-images/<?= $productImageObj->getRowByField('product_id', $row->id)->id.'.'.$productImageObj->getRowByField('product_id', $row->id)->ext ?>" alt="<?= $row->title ?>" class="img-responsive" />
			
											</div>
											<div class="col-sm-10">
												<h4>Product 1</h4>
												
											</div>
										</div>
									</td>
									<td>£<?= $row->cart_price ?></td>
									<td>
										<input type="text" class="form-control text-center" name="quantity<?= $row->cart_id ?>" value="<?= $row->quantity ?>">
									</td>
									<td class="text-center">£<?= number_format($row->quantity * $row->cart_price, 2) ?></td>
									<td>
										<button title="Update" type="submit" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
										<a class="btn btn-default btn-sm" title="Remove" href="basket.php?delete=<?= $row->cart_id ?>"><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>
								
							<?php } ?>
								
							</form>
							
						</tbody>
						
						
						<tfoot>
							<tr>
								<td colspan="3">
								
								
								<form action="" method="post" id="shipping-form">
								
								<select class="form-control" name="shipping" id="shipping">
								
									<option value="0">Please Select Your Shipping Method</option>
									<option value="0" <?php if($cartObj->shipping() == 0){ print 'selected'; } ?>>Free Royal Mail - £0.00</option>
									<option value="4.95" <?php if($cartObj->shipping() == '4.95'){ print 'selected'; } ?>>Royal Mail Next Day - £4.95</option>
								
								</select>
								
								</form>
								
								</td>
								<td class="text-center"><strong>Sub Total £<?= number_format($cartObj->subTotal(), 2) ?></strong></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td class="text-center"><strong>Shipping £<?= number_format($cartObj->shipping(), 2) ?></strong></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td class="text-center"><strong>Total £<?= number_format($cartObj->total(), 2) ?></strong></td>
								<td></td>
							</tr>
							<tr>
								<td><a href="index" class="btn btn-default"><i class="fa fa-chevron-left"></i> CONTINUE SHOPPING</a></td>
								<td colspan="3"></td>
								<td><a href="checkout" class="btn btn-default">CHECKOUT <i class="fa fa-chevron-right"></i></a></td>
							</tr>
						</tfoot>
		</table>

	</div>


<?php } ?>

</div>


<?php require 'footer.php'; ?>