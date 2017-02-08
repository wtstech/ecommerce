<?php 

require __DIR__.'/includes/config.php';

if( isset($_POST['email']) ){

	$user->requestPasswordReset($_POST['email']);

}

if( isset($_GET['get']) ){

	foreach($_SESSION as $key => $session){

		$key = str_replace(SALT, '', $key);

		$results[$key] = $session;

	}

print json_encode($results); exit;

}

include('header.php'); ?>

<script>

$(function(){

	$.get('forgot-password.php?get=sessions', function(data){
		
		var data = jQuery.parseJSON(data);
		
		$('#form input[type=text], input[type=email').each(function(){
			
			if (typeof data[this.id] !== 'undefined') {
			
				$('#' + this.id).val(data[this.id]);
				
			}
		
		});

	});

});

</script>

<div class="container pt-40 pb-30">

		<div class="heading-container">
		
			<div class="heading-flag-smaller"><img alt="Left Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-left.png"> </div>
			
				<div class="heading-text-smaller"><h1> FORGOTTEN PASSWORD? </h1> <div class="thin-line-top"></div> <div class="thin-line-bottom"></div> </div>
			
			<div class="heading-flag-smaller"><img alt="Right Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-right.png"> </div>
		
		</div>


<?php require __DIR__.'/includes/flash-messages.php'; ?>

<p>Just enter your email address and we will send you a link where you can reset your password. <br /><br /></p>
		
		<form class="form-horizontal form-light" id="form" method="post" action="">

					<div class="panel panel-default">
						<div class="panel-heading">ENTER YOUR EMAIL ADDRESS</div>
						<div class="panel-body">
								
								<div class="form-group">
									<label class="col-md-4 control-label">Email Address</label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="email" name="email">
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
									
										<button type="submit" class="btn btn-default"> REQUEST LINK </button>
										
									</div>
								</div>
							
						</div>
					</div>
			

		
		</form>

            </div>


    

<?php include('footer.php'); ?>