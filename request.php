<?php

require __DIR__.'/includes/config.php';

use App\Helpers\Mail;

if( isset($_POST['title']) ){

	Mail::request();

}

require 'header.php';

?>

<div class="container no-padding-ever">
	<div class="page-title-container">
		<div class="col-sm-12">
		<i class="fa fa-envelope"></i>
		<h1>Request More Information</h1>			
		</div>
	</div>
</div>

<div class="container">

<?php require __DIR__.'/includes/flash-messages.php'; ?>

<p class="mb-30">If you would like a FREE quote, or would like to book an appointment or request a brochure, please enter your details below and we will get back to you ASAP.</p>

	<div class="row">
	
		<div class="col-md-12">
		
  <div class="panel panel-default">

    <div class="panel-body" >

            <form action="" method="post">
              <div class="form-group">
                <label for="name">
                  Title
                </label>
		<select class="form-control" name="title">

			<option value="">Please Select Title</option>
			<option value="Mr">Mr</option>
			<option value="Mrs">Mrs</option>
			<option value="Miss">Miss</option>
			<option value="Dr">Dr</option>
			<option value="Mr &amp; Mrs">Mr &amp; Mrs</option>

		</select>
              </div>
              <div class="form-group">
                <label for="name">
                  Surname
                </label>
                <input type="text" placeholder="" id="surname" name="surname" class="form-control">
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
                  Full Address (including postcode)
                </label>
                <textarea placeholder="" rows="3" name="address" class="form-control"></textarea>
              </div>
              <button class="btn btn-default font-bigger mb-30" type="submit">SUBMIT YOUR REQUEST</button>
            </form>
			
	</div>
	
	</div>
		
		</div>

	</div>

</div>


<?php require 'footer.php'; ?>