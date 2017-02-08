<!DOCTYPE HTML>
<head>
<title><?= isset($meta_title) ? $meta_title : 'New Lobo Fishmongers, Poultry, Groceries' ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?= DOMAIN ?>/css/bootstrap.min.css" />
<link href="<?= DOMAIN ?>/css/bootstrap-touch-slider.css" rel="stylesheet" media="all">
<link rel="stylesheet" type="text/css" href="<?= DOMAIN ?>/css/styles.css?v=<?= time() ?>" />
<link rel="stylesheet" type="text/css" href="<?= DOMAIN ?>/font-awesome/css/font-awesome.css" />
<meta name="description" content="<?= isset($meta_description) ? $meta_description : 'New Lobo Fishmongers offer excellent deals on fresh fish, poultry and groceries.' ?>" />
<script src="<?= DOMAIN ?>/js/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="<?= DOMAIN ?>/lightbox/dist/css/lightbox.css">
<script src="<?= DOMAIN ?>/lightbox/dist/js/lightbox-plus-jquery.min.js"></script>
<script src="<?= DOMAIN ?>/js/jquery.matchHeight-min.js"></script>
<script>setTimeout(function() {
  $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
    $(this).remove();
  });
}, 3000); </script>
<script src="<?= DOMAIN ?>/js/bootstrap.min.js"></script>
</head>
<body>

<?php require __DIR__.'/includes/cookies.php'; ?>

<!-- container-fluid to make the top bar full width -->

<div class="container-fluid top-bar">

	<div class="container login-top-bit">
	
		<a  href="<?= DOMAIN ?>/basket"><i class="fa fa-shopping-basket white"></i> <span class="hidden-xs">ENQUIRY BASKET </span> (<?= FILE == 'complete.php' ? 0 : $cartObj->countItems() ?>)  </a>
		
		<?php if( !$user->auth() ){ ?>
	
		<a href="<?= DOMAIN ?>/login"><i class="fa fa-user"></i> SIGN IN</a>
		
		<?php } else { ?>
		
		<a href="<?= DOMAIN ?>/account"><i class="fa fa-cog"></i> ACCOUNT</a>  <a href="<?= DOMAIN ?>/login?log=out"><i class="fa fa-user"></i> SIGN OUT</a>
		
		<?php } ?>
	
	</div>

</div>

<div class="container">

	<div class="col-md-3 col-sm-4"> <a href="<?= DOMAIN ?>/index"> <img alt="Logo" class="img-responsive mt-5 logo-img center-block" src="<?= DOMAIN ?>/images/logo.jpg"> </a> </div>
	<div class="col-md-9 col-sm-8">
	
		<div class="row">
		
			<div class="col-md-12 social-media-div"> 
			
			<div class="social-media in"><a href="<?= DOMAIN ?>/#"><i class="fa fa-instagram"></i> </a> </div> 
			<div class="social-media tw"><a href="<?= DOMAIN ?>/#"><i class="fa fa-twitter"></i> </a></div> 
			<div class="social-media go"><a href="<?= DOMAIN ?>/#"><i class="fa fa-google-plus"></i> </a> </div> 
			<div class="social-media fb"><a href="<?= DOMAIN ?>/#"><i class="fa fa-facebook"></i> </a> </div> 

			</div>

			<div class="col-md-12 text-right need-help-div" >
			
			<span class="need-help dark-writing"><strong>NEED HELP? </strong> CALL US NOW </span> <span class="phone-number main-colour"> <em>07896499990</em></span>
			
			</div>
		
		</div>
	
	</div>

</div>

<!-- container-fluid to make nav full width -->

    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top mt-10 mb-0 container-fluid no-padding">
      <div class="container no-padding">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="link"><a href="<?= DOMAIN ?>/index"><i class="fa fa-home"></i> HOME</a></li>

            <li class="dropdown link">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PRODUCTS</a>
              <ul class="dropdown-menu">
	      <?php foreach( $categoryObj->getAll() as $category ){ ?>
	      
	      <li><a href="<?= DOMAIN ?>/<?= strtolower($category->seo_url) ?>"><?= strtoupper($category->title) ?></a></li>
	      
	     <?php } ?>

              </ul>
            </li>

	<li class="link"><a href="<?= DOMAIN ?>/services">SERVICES</a></li>

	<li class="link"><a href="<?= DOMAIN ?>/our-store">OUR STORE</a></li>

	<li class="link no-border"><a href="<?= DOMAIN ?>/contact">CONTACT US</a></li>
          </ul>

        </div><!--/.nav-collapse -->
      </div>
    </nav>
