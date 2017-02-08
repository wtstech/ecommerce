 		<div class="heading-container mt-30">
		
			<div class="heading-flag-smaller"><img alt="Left Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-left.png"> </div>
			
				<div class="heading-text-smaller"><h1>  WELCOME - <?= strtoupper($user->auth()->first_name); ?> </h1> <div class="thin-line-top"></div><div class="thin-line-bottom"></div> </div>
			
			<div class="heading-flag-smaller"><img alt="Right Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-right.png"> </div>
		
		</div>
		
		
		<div class="row mb-50 mt-50">
		
		
			<div class="col-md-4 mb-10"> <a class="btn btn-default full-width font-bigger" href="account?page=orders"><i class="fa fa-shopping-cart"></i> MY ORDERS</a> </div>
			
			<div class="col-md-4 mb-10"> <a class="btn btn-default full-width font-bigger" href="account?page=details"><i class="fa fa-user"></i> MY DETAILS</a> </div>
			
			<div class="col-md-4"> <a class="btn btn-default full-width font-bigger" href="account?page=change-password"><i class="fa fa-cog"></i> CHANGE PASSWORD</a> </div>
		
		
		</div>