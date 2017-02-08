<?php

use App\Product;
use App\ProductImage;

$productObj = new Product;
$productImageObj = new ProductImage;

$row = $productObj->getRowByField('seo_url', $slug);

if(!$row){

	include('404.php');
	exit;

}
 
$attributes = json_decode($row->attributes);


if( isset($_POST['product_id']) ){

	$cartObj->add();

}

$meta_title = 'New Lobo Fishmongers | '.$row->title;

require('header.php');


?>

<div class="container-fluid no-padding-ever">
	<div class="page-title-container">
		<div class="container">
		<div class="col-sm-12">
		<i class="fa fa-question-circle"></i>
		<span class="heading">PRODUCT DETAILS</span>
		</div>
		</div>
	</div>
</div>

            <div class="container pb-50">
	    
<?php require __DIR__.'/includes/flash-messages.php'; ?>
		    
		<div class="row">
		
  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
		
		<div class="left-thumbnail-holder">
			
	<ol class="carousel-indicators">
	
		<?php 
		
		$i = 0;
		
		foreach( $productImageObj->getAll( $row->id ) as $product_image ){
		
		?>

		<li data-target="#myCarousel" data-slide-to="<?= $i ?>" <?php if($i == 0){ ?>class="active <?php if( count($productImageObj->getAll( $row->id )) == 1 ){ print 'hidden-xs'; }  ?> " <?php } ?>>
		<img class="img-responsive left-thumb hid" src="<?= DOMAIN ?>/product-images/<?= $product_image->id ?>.<?= $product_image->ext ?>" alt="<?= $product_image->alt ?> Thumb">
		</li>
		
		<?php $i++; } ?>

	</ol> 
		
		</div>
		    
		    <div class="col-md-6">

  <div class="carousel-inner" role="listbox">
  
  		<?php
		
		$i = 1;
		
		foreach( $productImageObj->getAll( $row->id ) as $product_image ){
		
		?>
  
    <div class="item <?php if($i == 1){ ?>active <?php } ?> ">
     <a href="<?= DOMAIN ?>/product-images/<?= $product_image->id ?>.<?= $product_image->ext ?>" data-lightbox="set" data-title="<?= $row->title ?> <?= $i ?>"> <img class="img-responsive" src="<?= DOMAIN ?>/product-images/<?= $product_image->id ?>.<?= $product_image->ext ?>" alt="<?= $product_image->alt ?>">  </a>
    </div>

		<?php $i++; } ?>
    
  </div>
  
  <?php if( count($productImageObj->getAll( $row->id )) > 1 ){  // don't show left and right arrows if there is only 1 image  ?>

  <!-- Controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <i class="fa fa-chevron-left"></i>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <i class="fa fa-chevron-right"></i>
    <span class="sr-only">Next</span>
  </a>
  
  <?php } ?>


		    </div>
		    
		    </div>
		    
<script>
$(function(){
	$('.option-select').change(function(){
		if( this.value != '' ){
			var options = this.value.split('-');
			var price = options[1].trim();
			price = Number(price);
			price = price.toFixed(2);
			$('#show-price').html('&pound;' + price );
			$('#cart_price').val( price );
		}
	});
});
</script>
		    
			    <div class="col-md-5">

				<h1 class="dark-writing margin-on-mobile"><?= $row->title ?></h1>
				<h2 id="show-price" class="mt-0">
				
				<?php
				
				if( $row->special_offer_price ){
				
					print 'WAS <strike>£'.$row->price.'</strike> <span class="red"> NOW £'.$row->special_offer_price. '</span>';
				
				} else {
				
					print '£'.$row->price;
				
				}
				
				?>
				
				</h2>
				
				<?= $row->description ?>
			
					<div class="row">
					
						<form action="" method="post">
						
						<?php if( count($attributes) ){  ?>
						
						<div class="col-md-12 mb-20">
						
						<?= '<p>CHOOSE '.strtoupper($attributes[0]).':</p>' ?>
						
						<?php
						
						$explodeColons = explode(';', $attributes[1]);
						
						?>
						
						<!-- DON'T CHANGE option_title[] OR option_values[] keys  -->
						
						<input type="hidden" name="option_title[]" value="<?= strtoupper($attributes[0]) ?>">
						
						<select name="option_values[]" class="form-control option-select" required>
						
						<option value="">PLEASE SELECT</option>
						
						<?php
						
						foreach($explodeColons as $option){
						
						if($option == ''){ continue; }
						
						?>
						
						<option value="<?= trim(strtoupper($option)) ?>"><?= trim(strtoupper(substr($option, 0, strpos($option, '-')))) ?></option>
						
						<?php } ?>
						
						</select>
						
						<?php
						
						
						
						?>
						
						<?php } ?>
						
						</div>
						
							<div class="col-md-6 pl-0">
							
							
							<input type="hidden" name="product_id" value="<?= $row->id ?>" />
							<input type="hidden" id="price" value="<?= $row->special_offer_price ? $row->special_offer_price : $row->price ?>" />
							<input type="hidden" id="cart_price" name="cart_price" value="<?= $row->special_offer_price ? $row->special_offer_price : $row->price ?>" />
							
							<select id="quantity" name="quantity" class="form-control">
							
								<option value="1">QTY - 1</option>
								<?php for($i = 2; $i < 101; $i++){ print '<option value="'.$i.'">'.$i.'</option>'; } ?>
							
							</select>
							
							</div>
							
							<div class="col-md-6 pl-0">
								<button type="submit" class="btn btn-default mt-20-mob-and-ipad-portrait form-control"><i class="fa fa-shopping-cart"></i> ADD TO CART</button>
							</div>
						
						</form>
						
					</div>
			
			

			    </div>

		</div>


	</div>


 <?php require('footer.php'); ?>