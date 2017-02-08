<?php

require __DIR__.'/includes/config.php';

use App\Product;
use App\ProductImage;

$productObj = new Product;
$productImageObj = new ProductImage;

require 'header.php';

?>

<div id="myCarousel" class="carousel slide" data-ride="carousel">

  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <a href="fish"><img class="img-responsive" src="<?= DOMAIN ?>/images/slide1.jpg" alt="Banner 1"> </a>
    </div>

    <div class="item">
     <a href="groceries"> <img class="img-responsive" src="<?= DOMAIN ?>/images/slide2.jpg" alt="Banner 2"> </a>
    </div>

    <div class="item">
      <a href="poultry"> <img class="img-responsive" src="<?= DOMAIN ?>/images/slide3.jpg" alt="Banner 3"> </a>
    </div>

</div>



<div class="container pt-50">
	
		<div class="heading-container">
		
			<div class="heading-flag"><img alt="Left Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-left.png"> </div>
			
				<div class="heading-text"><h1> <div class="thin-line-top"></div> ABOUT US</h1> <div class="thin-line-bottom"></div> </div>
			
			<div class="heading-flag"><img alt="Right Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-right.png"> </div>
		
		</div>

	
	<p> New lobo fishmongers located in north London in Enfield. Specialist in frozen fish serving an verity range of frozen fish to salted and smoked fish to fresh and frozen African vegetables  and afro Caribbean grocery.</p>
	
	<p class="mb-50">We have been serving quality and satisfied product from a range of; frozen fish to afro-Caribbean grocery,  we have also introduced fresh and frozen African vegetable.  We have wild selection of frozen fish from a range of tlapia,red snapper , hake, salmon, fillets, king fish, mux sea foods and many more which you can see on our website or visit our store. We also have verity of afro-Caribbean grocery from range  of : gari, ijebu, semolina, semovita , FUFU, all range of beans, rice, seasoning, and many more which you can see on our website or visit our store.  </p>

	<a class="btn btn-primary center-block mb-50" href="services">VIEW OUR SERVICES</a>

</div>

<div class="container-fluid hp-category-div-holder">

	<div class="container no-padding">

		<div class="row">
		
			<div class="col-md-4 col-sm-4 mb-30"> <a href="<?= DOMAIN ?>/poultry"> <img alt="Poultry" class="img-responsive center-block" src="<?= DOMAIN ?>/images/poultry.jpg"> <button class="btn btn-default green-block bg-green">POULTRY <i class="fa fa-chevron-right pull-right mt-5 mr-10"></i> </button> </a> </div>
			<div class="col-md-4 col-sm-4 mb-30"> <a href="<?= DOMAIN ?>/fish"> <img alt="Fish" class="img-responsive center-block" src="<?= DOMAIN ?>/images/fish.jpg"> <button class="btn btn-default green-block bg-green">FISH <i class="fa fa-chevron-right pull-right mt-5 mr-10"></i> </button> </a> </div>
			<div class="col-md-4 col-sm-4 mb-30"> <a href="<?= DOMAIN ?>/groceries"> <img alt="Groceries" class="img-responsive center-block" src="<?= DOMAIN ?>/images/groceries.jpg"> <button class="btn btn-default green-block bg-green">GROCERIES <i class="fa fa-chevron-right pull-right mt-5 mr-10"></i> </button> </a> </div>
		
		</div>

	</div>

</div>

<script>
$(function() {
    $('.image-col').matchHeight();  /* make all columns the same height */
});
</script>

<div class="container pt-10 pb-20">

		<div class="heading-container">
		
			<div class="heading-flag"><img alt="Left Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-left.png"> </div>
			
				<div class="heading-text"><h1> <div class="thin-line-top"></div> OUR LATEST PRODUCTS </h1> <div class="thin-line-bottom"></div> </div>
			
			<div class="heading-flag"><img alt="Right Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-right.png"> </div>
		
		</div>
		
</div>

<div class="container pb-60">
		
		
        <div class="row">
	
	<?php
	
	foreach( $productObj->getLatest() as $product ){
	
	$row = $productImageObj->getRowByField('product_id', $product->id);
	
	?>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb mb-30 image-col">
                <a class="thumbnail no-border" href="<?= DOMAIN ?>/product/<?= $product->seo_url ?>">
                    <img class="img-responsive" src="<?= DOMAIN ?>/product-images/<?= $row->id ?>.<?= $row->ext ?>" alt="<?= $row->alt ?>">
                </a>
		
		<h4 class="text-center mb-10"><strong><?= strtoupper($product->title) ?></strong></h4>
		
		<h4 class="text-center"><?php
		
				if( $product->special_offer_price ){
				
					print 'WAS <strike>£'.$product->price.'</strike> <span class="red">NOW £'.$product->special_offer_price .'</span>';
				
				} else {
				
					print '£'.$product->price;
				
				}
		
		?></h4>
		
            </div>
  
	<?php } ?>
  
        </div>
		

</div>












<?php require 'footer.php'; ?>