<?php

use App\Product;
use App\Category;
use App\SubCategory;
use App\ProductImage;

$productObj = new Product;
$categoryObj = new Category;
$subcategoryObj = new SubCategory;
$productimageObj = new ProductImage;


if($action == 'delete-image'){

	$productimageObj->delete($_GET['image_id']);

}

if($action == 'edit'){

	$row = $productObj->find($id);
	$product_images = $productimageObj->getAll();

}

if( isset($_POST['title']) ){

	if($action == 'add'){
	
		$productObj->add();
	
	} else {
	
		$productObj->update($id);
	
	}

}

?>

<script>

$(function(){

	$.get('account.php?page=product&action=add&get=sessions', function(data){
		
		var data = jQuery.parseJSON(data);
		
		$('#form input[type=text], #form input[type=email], #form textarea').each(function(){
			
			if (typeof data[this.id] !== 'undefined') {
			
				$('#' + this.id).val(data[this.id]);
				
			}
		
		});
		
		$('#form select').each(function(){
		
			$('#' + this.id + ' option[value='+data[this.id]+']').prop('selected', true);
		
		});

	});

});

</script>
<script src="tinymce/js/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: "textarea",
  plugins: "code"
});
</script>

<h1>PRODUCT</h1>

<p>Once uploaded, to delete an image, just click it.</p>
<p>To add a drop down options attribute - Add the lowest price in the individual price field, then add on each price for each option</p>
<p>Eg. Small Box - 0; Medium Box - 10; Large Box - 15</p>

	<form enctype="multipart/form-data" <?php if($action == 'add'){ print 'id="form"'; } ?> class="form-horizontal" method="post" action="">

						<div class="panel panel-default">
						<div class="panel-heading"><?= strtoupper($action) ?> PRODUCT</div>
						<div class="panel-body">
						
								<div class="form-group">
									<label class="col-md-4 control-label">Title</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="title" id="title" value="<?php if(isset($row)){ print $row->title; } ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">SEO Friendly URL</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="seo_url" id="seo_url" value="<?php if(isset($row)){ print $row->seo_url; } ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label"></label>
									<div class="col-md-6">
										<p>eg. your-product-name</p>
										<p>This should have a dash in between each word, no spaces</p>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Category</label>
									<div class="col-md-6">
										
										<select class="form-control" name="category_id" id="category_id">
										<option value="">Select Category</option>
										<?php
										
										foreach($categoryObj->getAll() as $category){
										
										$selected = '';
										
											if( isset($row) ){
										
												$selected = $category->id == $row->category_id ? 'selected' : '';
											
											}
										
										print "<option value='".$category->id."' $selected>".$category->title."</option>\n";
										
										}
										
										?>
										
										</select>
										
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Sub Category</label>
									<div class="col-md-6">
										
										<select class="form-control" name="sub_category_id" id="sub_category_id">
										<option value="">Select Sub Category</option>
										<?php
										
										foreach($subcategoryObj->getAll() as $sub_category){
										
										$selected = '';
										
											if( isset($row) ){
										
												$selected = $sub_category->sub_category_id == $row->sub_category_id ? 'selected' : '';
											
											}
										
										print "<option value='".$sub_category->sub_category_id."' $selected>".$sub_category->sub_category_title."</option>\n";
										
										}
										
										?>
										</select>
										
									</div>
								</div>

								
								<div class="form-group">
									<label class="col-md-4 control-label">Smallest Price</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="price" id="price" value="<?php if(isset($row)){ print $row->price; } ?>">
									</div>
								</div>
								

								<div class="form-group">
									<label class="col-md-4 control-label">Special Offer Price</label>
									<div class="col-md-6">
										<input placeholder="Leave blank if not special offer" type="text" class="form-control" name="special_offer_price" id="special_offer_price" value="<?php if(isset($row)){ print $row->special_offer_price; } ?>">
									</div>
								</div>

								
								<div class="form-group">
									<label class="col-md-4 control-label">Description</label>
									<div class="col-md-6">
										
				<textarea class="form-control" rows="7" name="description" id="description"><?php  if(isset($row)){ print $row->description; } elseif(isset($_SESSION[SESSION.'description'])){ print $_SESSION[SESSION.'description']; } ?></textarea>
										
									</div>
								</div>
								
								<?php
								
								for($i = 1; $i < 2; $i++){
								
								if(isset($row)){
								
									$attributes = json_decode($row->attributes);
								
								}

								$attribute_name = isset($attributes[0]) ? $attributes[0] : '';
								$attribute_values = isset($attributes[1]) ? $attributes[1] : '';
								
								?>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Attribute Name</label>
									<div class="col-md-6">
										<input type="text" placeholder="eg. Option" class="form-control"  name="attributes[]" value="<?= $attribute_name ?>">										
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Attribute Values</label>
									<div class="col-md-6">
										<input type="text" placeholder="eg. Small-0; Medium-4.00; Large-8.00" class="form-control"  name="attributes[]" value="<?= $attribute_values ?>">
									</div>
								</div>
								
								<?php } ?>
								
								<?php for($i = 1; $i < 3; $i++){ ?>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Alt Tag <?= $i; ?></label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="alt-<?= $i; ?>" name="alt-<?= $i; ?>" value="<?php if(isset($product_images[$i-1]->alt)){ print $product_images[$i-1]->alt; } ?>">										
									</div>
								</div>
								
								<?php if(isset( $product_images[$i-1]->id )){ ?>
								
								<input type="hidden" name="id-<?= $i; ?>" value="<?= $product_images[$i-1]->id ?>">
								<input type="hidden" name="ext-<?= $i; ?>" value="<?= $product_images[$i-1]->ext ?>">
								
								<?php } ?>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Image <?= $i; ?> (JPG, PNG or GIF)</label>
									<div class="col-md-6">
										<input type="file" class="form-control" name="file-<?= $i; ?>">
										
										<?php
										
										if(isset($product_images[$i-1]->ext)){
										
	print "<br /><a onclick=\"return confirm('Are you sure you want to delete this image?')\" href='account.php?page=product&action=delete-image&image_id=".$product_images[$i-1]->id."'><img style='width:150px' src='../product-images/".$product_images[$i-1]->id.".".$product_images[$i-1]->ext."'></a>"; 
										
										}
										
										?>
										
									</div>
								</div>
								
								<?php } ?>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-primary"> <?= strtoupper($action) ?> PRODUCT </button>
									</div>
								</div>
							
						</div>
					</div>
		
		
	</form>		

