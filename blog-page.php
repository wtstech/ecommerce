<?php

use App\Blog;
use App\BlogImage;

$blogObj = new Blog;
$blogImageObj = new BlogImage;

$slug = explode('/', $_SERVER['REQUEST_URI']);
$slug = $slug[count($slug)-1];

$row = $blogObj->getRowByField('seo_url', $slug);

require 'header.php';

?>

<div class="container no-padding-ever">
	<div class="page-title-container">
		<div class="col-sm-12">
		<i class="fa fa-comment"></i>
		<h1><?= $row->title ?></h1>			
		</div>
	</div>
</div>

<div class="container">

	<?php $image = $blogImageObj->getAll($row->id); ?>

	<div class="row">
	
		<div class="col-md-8">

			<p><em><?= date('d/m/Y', strtotime($row->created_at)); ?></em></p>
			
			<?= $row->content ?>			
		
		</div>
		
		<div class="col-md-4">
		
			<?php if( isset($image[0]) ){ ?>
		
			<img alt="<?= $image[0]->alt ?>" class="img-responsive" src="<?= DOMAIN ?>/blog-images/<?= $image[0]->id ?>.<?= $image[0]->ext ?>">
			
			<?php } ?>
		
		</div>
	
	</div>

</div>
<?php require 'footer.php'; ?>