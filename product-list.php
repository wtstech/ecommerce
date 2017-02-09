<?php

use App\Product;
use App\ProductImage;

$productObj = new Product;
$productImageObj = new ProductImage;

if( isset($sub_category_id) ){

	$query = $productObj->getAllBySubCategory($sub_category_id);

} else {

	$query = $productObj->getAllByCategory($category_id);
	
}

require 'header.php';

?>

<script>
$(function() {
    $('.image-col').matchHeight();  /* make all columns the same height */
});
</script>

<div class="container pt-40 pb-30">

		<div class="heading-container">
		
			<div class="heading-flag-smaller"><img alt="Left Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-left.png"> </div>
			
				<div class="heading-text-smaller"><h1> <div class="thin-line-top"></div> <?= isset($sub_category_title) ? strtoupper($sub_category_title) : strtoupper($category_title) ?> </h1> <div class="thin-line-bottom"></div> </div>
			
			<div class="heading-flag-smaller"><img alt="Right Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-right.png"> </div>
		
		</div>


        <div class="row">
	
	<?php
	
	foreach( $query as $product ){
	
	$row = $productImageObj->getRowByField('product_id', $product->id);
	
	?>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb mb-30 image-col">
                <a class="thumbnail" href="<?= DOMAIN ?>/product/<?= $product->seo_url ?>">
                    <img class="img-responsive" src="<?= DOMAIN ?>/product-images/<?= $row->id ?>.<?= $row->ext ?>" alt="<?= $row->alt ?>">
                </a>
		
		<h4 class="text-center mb-20"><strong><?= strtoupper($product->title) ?></strong></h4>
			
		<div class="col-md-8 col-sm-8">
		
		<h4 class="no-margin">
		
		<?php
		
				if( $product->special_offer_price ){
				
					print 'WAS <strike>£'.$product->price.'</strike> <br /> <span class="red">NOW £'.$product->special_offer_price .'</span>';
				
				} else {
				
					print '£'.$product->price;
				
				}
		
		?>
		
		</h4>
		
		</div>

		<div class="col-md-4 col-sm-4">
		
			<a href="<?= DOMAIN ?>/product/<?= $product->seo_url ?>" class="btn btn-default no-margin border-radius-5" href=""><i class="fa fa-exclamation-circle"></i> MORE</a>
		
		</div>
		
            </div>
  
	<?php } ?>
  
        </div>


</div>


<?php require 'footer.php'; ?>