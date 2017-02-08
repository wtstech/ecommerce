<?php

require __DIR__.'/includes/config.php';

use App\Blog;
use App\BlogImage;

$blogObj = new Blog;
$blogImageObj = new BlogImage;

require 'header.php';

?>

<div class="container no-padding-ever">
	<div class="page-title-container">
		<div class="col-sm-12">
		<i class="fa fa-comment"></i>
		<h1>Blog</h1>			
		</div>
	</div>
</div>

<div class="container">

	<?php foreach( $blogObj->getAll() as $blog_post ){

	$image = $blogImageObj->getAll($blog_post->id);
	
	?>

	<div class="row">
	
		<div class="col-md-10">
		
			<h3><?= $blog_post->title ?></h3>
			<p><em><?= date('d/m/Y', strtotime($blog_post->created_at)); ?></em></p>
			
			<?php
			
			$explode = explode(' ', str_replace('</p>', ' </p> ', $blog_post->content));
			$text = '';
			
			for($i = 0; $i < count($explode); $i++){
			
				$text .= $explode[$i].' ';
				
				if(strstr($text, '</p>')){ break; }
			
			}
			
			print $text."\n";
			
			?>
			
			<a class="btn btn-default" href="<?= DOMAIN ?>/blog/<?= $blog_post->seo_url ?>"> View Full Blog Post <i class="fa fa-chevron-right"></i></a>
			
		
		</div>
		
		<div class="col-md-2">
		
			<?php if( isset($image[0]) ){ ?>
		
			<a href="<?= DOMAIN ?>/blog/<?= $blog_post->seo_url ?>"> <img alt="<?= $image[0]->alt ?>" class="blog-list-image" src="<?= DOMAIN ?>/blog-images/<?= $image[0]->id ?>.<?= $image[0]->ext ?>"> </a>
			
			<?php } ?>
		
		</div>
	
	</div>
	
	<hr />

	<?php } ?>

</div>
<?php require 'footer.php'; ?>