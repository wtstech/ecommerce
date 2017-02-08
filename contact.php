<?php

require __DIR__.'/includes/config.php';

use App\Helpers\Mail;

if( isset($_POST['name']) ){

	Mail::enquiry();

}

if( isset($_POST['newsletter_email']) ){

	Mail::newsletter();

}

require 'header.php';

?>

<div class="container pt-40 pb-30">

		<div class="heading-container">
		
			<div class="heading-flag-smaller"><img alt="Left Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-left.png"> </div>
			
				<div class="heading-text-smaller"><h1> <div class="thin-line-top"></div> CONTACT US </h1> <div class="thin-line-bottom"></div> </div>
			
			<div class="heading-flag-smaller"><img alt="Right Flag" class="img-responsive" src="<?= DOMAIN ?>/images/heading-flag-right.png"> </div>
		
		</div>

<?php require __DIR__.'/includes/flash-messages.php'; ?>

<p class="mb-30">If you would contact us please give us a call. Alternatively you can send us a message via email or by using our web form.</p>

	<div class="row">
	
		<div class="col-md-5">
		
	  <div class="panel panel-default">

    <div class="panel-body" >

            <form action="" method="post">
              <div class="form-group">
                <label for="name">
                  Name
                </label>
                <input type="text" placeholder="" id="name" name="name" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">
                  Email
                </label>
                <input type="text" placeholder="" id="email" name="email" class="form-control">
              </div>
              <div class="form-group">
                <label for="phone">
                  Phone
                </label>
                <input type="text" id="phone" name="phone" class="form-control">
              </div>
              <div class="form-group">
                <label for="phone">
                  Message
                </label>
                <textarea placeholder="" rows="3" name="message" class="form-control"></textarea>
              </div>
              <button class="btn btn-default font-bigger" type="submit">SUBMIT ENQUIRY</button>
            </form>
			
			
	</div>
	
	</div>
		
		</div>

	
		<div class="col-md-7">
		
			<div class="row">
			
				<div class="col-md-4">
				
				<h3 class="mt-0"><i class="fa fa-map-marker"></i> ADDRESS</h3>
				
				<p>New Lobo Fishmongers Ltd <br />
				544 Hertford Road  <br />
				Enfield <br />
				EN3 5ST </p>
				
				</div>
				
				<div class="col-md-4">
				
				<h3 class="mt-0">CONTACT INFO</h3>
				
				<p>
				<i class="fa fa-phone"></i> 07896499990<br /> 
				<i class="fa fa-envelope"></i> <a href="<?= DOMAIN ?>/mailto:info@newlobofish.co.uk">info@newlobofish.co.uk</a>
				</p>
				
				</div>
				
				<div class="col-md-4">
				
				<h3 class="mt-0"><i class="fa fa-clock-o"></i> OPENING HOURS</h3>
				
				<p>
				Monday -Saturday <br /> 09:30 to 19:00<br />
				Sunday <br /> 11:00 to 16:00
				</p>
				
				</div>
			
			</div>
			
			<div class="row mt-20">
			
				<div class="col-md-12">
				
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2474.5723767432655!2d-0.04417768411096897!3d51.66766530679333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761f9ea7fc5e53%3A0x701e6ba03a87f614!2s544+Hertford+Rd%2C+Enfield+EN3!5e0!3m2!1sen!2suk!4v1485949496752" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>

				
				</div>
			
			</div>
		
		</div>

	</div>

</div>


<?php require 'footer.php'; ?>