<?php 

require __DIR__.'/includes/config.php';

if( isset($_POST['email']) ){

	$user->login($user_role_id = 1);

}

if( isset($_GET['log']) ){

	App\User::logout();

}

if($user->auth()){

	redirect( 'account.php?page=home');

}

require __DIR__.'/header.php';

?>

<div class="container pt-40 pb-30">

		<div class="heading-container">
		
			<div class="heading-flag-smaller"><img alt="Left Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-left.png"> </div>
			
				<div class="heading-text-smaller"><h1> LOGIN </h1> <div class="thin-line-top"></div> <div class="thin-line-bottom"></div> </div>
			
			<div class="heading-flag-smaller"><img alt="Right Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-right.png"> </div>
		
		</div>


<?php require __DIR__.'/includes/flash-messages.php'; ?>


<p>Please login to your account here. <br /><br /></p>
		
		<form class="form-horizontal form-light" id="form" method="post" action="">
			
					<div class="panel panel-default">
						<div class="panel-body">
								
								<div class="form-group">
									<label class="col-md-4 control-label">Email Address</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="email" name="email">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-4 control-label">Password</label>
									<div class="col-md-6">
										<input type="password" class="form-control" name="password">
									</div>
								</div>
								

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-default"> LOGIN </button>
										<a href="<?= DOMAIN ?>/forgot-password.php">Forgotten Your Password?</a>
									</div>
								</div>
							
						</div>
					</div>
			
		
		</form>
		

</div>

<?php require __DIR__.'/footer.php'; ?>