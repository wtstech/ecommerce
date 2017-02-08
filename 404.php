<?php


require 'header.php';

?>

<div class="container pt-40 pb-30">

		<div class="heading-container">
		
			<div class="heading-flag-smaller"><img alt="Left Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-left.png"> </div>
			
				<div class="heading-text-smaller"><h1> <i class="fa fa-exclamation-circle"></i> Oops </h1> <div class="thin-line-top"></div><div class="thin-line-bottom"></div> </div>
			
			<div class="heading-flag-smaller"><img alt="Right Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-right.png"> </div>
		
		</div>

<p class="text-center mb-50">Sorry, the page you requested does not exist</p>

<div class="col-md-4 col-md-offset-4">
<a class="btn btn-default center-block" href="<?= DOMAIN ?>/index">HOME PAGE</a>
</div>


</div>


<?php require 'footer.php'; ?>