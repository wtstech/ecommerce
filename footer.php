
<footer class="container-fluid footer-fluid-bg no-padding">		<!-- change footer-fluid-bg to same colour as footer if it needs to be fluid - default to white -->

      <div class="container footer pb-30">
	
	<div class="row">
	
		<div class="col-md-3 col-sm-6 white"> 
		<h3 class="white font-weight-300">CONTACT US</h3> 
		<i class="fa fa-phone white footer-phone"></i> 07896499990<br />
		<i class="fa fa-envelope white footer-envelope"></i> <a href="mailto:info@newlobofish.co.uk">info@newlobofish.co.uk</a>
		</div>
		<div class="col-md-3 col-sm-6">
		<h3 class="white font-weight-300">SOCIAL MEDIA</h3>

			<div class="row">
				<div class="col-md-12 mb-30">
					<div class="social-media fb pull-left ml-0"><a href="<?= DOMAIN ?>/#"><i class="fa fa-facebook"></i> </a> </div> 
					<div class="social-media go pull-left"><a href="<?= DOMAIN ?>/#"><i class="fa fa-google-plus"></i> </a> </div> 
					<div class="social-media tw pull-left"><a href="<?= DOMAIN ?>/#"><i class="fa fa-twitter"></i> </a></div> 
					<div class="social-media in pull-left"><a href="<?= DOMAIN ?>/#"><i class="fa fa-instagram"></i> </a> </div> 
				</div>
			</div>
		
		</div>
		<div class="col-md-3 col-sm-6">
		<h3 class="white font-weight-300">SITE MAP</h3>
		
		<div class="row">
			
			<div class="col-md-4 site-map col-sm-6">
			<li><a href="<?= DOMAIN ?>/index">Home</a></li>
			<li><a href="<?= DOMAIN ?>/services">Services</a></li>
			<li><a href="<?= DOMAIN ?>/our-store">Store</a></li>
			
			</div>
			<div class="col-md-6 site-map col-sm-6">
			
			<li><a href="<?= DOMAIN ?>/contact">Contact Us</a></li>
			<li><a href="<?= DOMAIN ?>/cookies">Cookie Policy</a></li>
			
			</div>
		
		</div>
		
		</div>
		<div class="col-md-3 col-sm-6">
		<h3 class="white font-weight-300">NEWSLETTER SIGN UP</h3>
		
		<form action="contact" method="post">
		
		<input type="text" name="newsletter_email" class="form-control no-border" placeholder="Email Address...">
		
		<button class="btn btn-default mt-20" type="submit"> SEND </button>
		
		</form>
		
		</div>
	
	</div>
	
	<div class="row">
	
		<div class="col-md-6 col-xs-12 pull-right text-left website-design-by">  Copyright <?= date('Y') ?> <?= COMPANY_NAME ?> &copy; <a href="<?= DOMAIN ?>/http://www.wtstechnologies.co.uk">Web Design</a> by WTS Technologies </div>
	
	</div>

      </div>

	</footer>
    
</body>
</html>