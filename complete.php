<?php

require __DIR__.'/includes/config.php';

use App\Order;
use App\ProductsFromOrder;

$orderObj = new Order;
$productFromOrderObj = new ProductsFromOrder;

$user->destroyUniqueId();

require 'header.php';

?>

<div class="container pt-40 pb-30">

		<div class="heading-container">
		
			<div class="heading-flag-smaller"><img alt="Left Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-left.png"> </div>
			
				<div class="heading-text-smaller"><h1> ENQUIRY COMPLETE </h1> <div class="thin-line-top"></div> <div class="thin-line-bottom"></div> </div>
			
			<div class="heading-flag-smaller"><img alt="Right Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-right.png"> </div>
		
		</div>

<?php require __DIR__.'/includes/flash-messages.php'; ?>

<?php if( $orderObj->getOrderNumber() ){

$order_id = $orderObj->getOrderNumber() - 100000;

?>

	<p>Your enquiry number is <?= $orderObj->getOrderNumber() ?>. Please use this in any correspondance regarding this enquiry. Please see details below;</p>
	
	<div class="table-responsive">

		<table class="table">
						<thead>
							<tr>
								<th style="width:60%">Product</th>
								<th style="width:10%">Price</th>
								<th style="width:8%">Quantity</th>
								<th style="width:22%;text-align:right">Subtotal</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
							
							$total = 0;
							
							foreach( $productFromOrderObj->getAll( $order_id ) as $row ){
							
							$total += ( $row->price * $row->quantity );
							
							?>
							
								<tr>
									<td><strong><?= $row->title ?></strong></td>
									<td>£<?= $row->price ?></td>
									<td><?= $row->quantity ?></td>
									<td style="text-align:right">£<?= number_format($row->quantity * $row->price, 2) ?></td>
								</tr>
								
							<?php } ?>

							
						</tbody>
						<tfoot>

							<tr>
								<td colspan="4" style="text-align:right"><strong>Total £<?= number_format($total, 2) ?></strong></td>
							</tr>
							<tr>
								<td colspan="4"><a href="index" class="btn btn-default"><i class="fa fa-chevron-left"></i> CONTINUE SHOPPING</a></td>
							</tr>
						</tfoot>
		</table>

	</div>
	

<?php  } else {  ?>

<p class="mb-100">Your session has expired. If you require assistance regarding your enquiry please contact customer service.</p>

<?php } ?>


</div>


<?php require 'footer.php'; ?>