<?php

require __DIR__.'/includes/config.php';

use App\GalleryImage;

$galleryImageObj = new GalleryImage;

require 'header.php';

?>

<script>
$(function() {
    $('.image-col').matchHeight();  /* make all gallery columns the same height */
});
</script>

<div class="container no-padding-ever">
	<div class="page-title-container">
		<div class="col-sm-12">
		<i class="fa fa-picture-o"></i>
		<h1>Gallery</h1>		
		</div>
	</div>
</div>

<div class="container">

        <div class="row">
	
	<?php foreach( $galleryImageObj->getAll() as $image ){ ?>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb mb-30 image-col">
                <a data-lightbox="example-set" data-title="<?= $image->alt ?>" class="thumbnail" href="<?= DOMAIN.'/gallery-images/'.$image->id.'.'.$image->ext ?>">
                    <img class="img-responsive" src="<?= DOMAIN.'/gallery-images/'.$image->id.'.'.$image->ext ?>" alt="<?= $image->alt ?>">
                </a>
		
	<h4 class="text-center"><?= $image->alt ?></h4>
		
            </div>
  
	<?php } ?>
  
        </div>


</div>


<?php require 'footer.php'; ?>