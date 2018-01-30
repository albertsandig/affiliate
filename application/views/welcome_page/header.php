<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Al's Solution</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 
	 <!-- FACEBOOK -->
    <meta name="description" content="Al's Solution">
    <meta name="author" content="Albert Sandig">    
    <link rel="shortcut icon" alt="icon" href="<?php echo base_url('components/assets/images/team_logo.png'); ?>">  
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	 
	<link rel="alternate" href="<?php echo base_url(); ?>"  />
	<meta property="og:url"           content="<?php echo base_url('raffle'); ?>" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Als Solution" />
	<meta property="og:description"   content="Advertisement website" />
	<meta property="og:image"         content="<?php echo base_url('components/assets/images/team_logo.png'); ?>" />

	 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
	 <?php 	
		//echo $advertisement;
		
		if(isset($css)):
			echo $css; 
		endif;
	?>
	 
	 	<?php echo (isset($advertisement))? $advertisement : '' ; ?>
</head> 

<body>
    <!-- ******HEADER****** --> 
    <header id="header" class="header">  
        <div class="container">       
            <h1 class="logo">
                <a class="scrollto" href="#hero">
                    <span class="logo-icon-wrapper"><img class="logo-icon" src="<?php echo base_url('components/assets/images/team_logo.png'); ?>" alt="icon"></span>
                    <span class="text"><span class="highlight">AL</span>Solutions</span></a>
            </h1><!--//logo-->
            <nav class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->
                <div id="navbar-collapse" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active nav-item"><a class="scrollto" href="#about">About</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('raffle'); ?>"> Raffle</a></li> 
                        <!--<li class="nav-item"><a class="scrollto" href="#features">Features</a></li>                        
                        <li class="nav-item"><a class="scrollto" href="#team">Team</a></li>-->
                        <li class="nav-item"><a class="scrollto" href="#donate">Donation</a></li>
                        <li class="nav-item"><a class="scrollto" href="#contact">Contact</a></li>
								<li class="nav-item"><a href="<?php echo base_url('/credential/register'); ?> ">Sign Up</a></li>
								<li class="nav-item"><a href="<?php echo base_url('/credential/login'); ?> ">Login</a></li>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->                     
        </div><!--//container-->
    </header><!--//header-->
    
   <div id="hero" class="hero-section">
        
      <div id="hero-carousel" class="hero-carousel carousel carousel-fade slide" data-ride="carousel" data-interval="10000">
            
         <div class="figure-holder-wrapper">
        		<div class="container">
            		<div class="row">
                		<div class="figure-holder">
                	         <img class="figure-image img-responsive" src="<?php echo base_url('components/assets/images/imac.png'); ?>" alt="image" />
                     </div><!--//figure-holder-->
            		</div><!--//row-->
        		</div><!--//container-->
    		</div><!--//figure-holder-wrapper-->
            
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li class="active" data-slide-to="0" data-target="#hero-carousel"></li>
				<li data-slide-to="1" data-target="#hero-carousel"></li>
				<!-- <li data-slide-to="2" data-target="#hero-carousel"></li> -->
			</ol>
			
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
    			
				<div class="item item-1 active">
					<div class="item-content container">
    					<div class="item-content-inner">
    				        
				            <h2 class="heading">It is a system that allows people to earn money through advertisement.</h2>
				            <p class="intro">It helps people to know how to gain profit from the advertisement they click </p>
				            <a class="btn btn-primary btn-cta" href="#about">Get Started</a>
    				        
    					</div><!--//item-content-inner-->
					</div><!--//item-content-->
				</div><!--//item-->
			
				<div class="item item-2">
					<div class="item-content container">
						<div class="item-content-inner">
    				        
				            <h2 class="heading">Monitize Contribution</h2>
				            <p class="intro">
									With our contribution dashboard you can monitor the contributions of all user in advertisement.
								</p>
				            <a class="btn btn-primary btn-cta" href="<?php echo base_url('/credential/register'); ?>" target="_blank">Contribute Now</a>
    				        
    					</div>
					</div>
				</div>
					<!--
				<div class="item item-3">
					<div class="item-content container">
						<div class="item-content-inner">
    				        
				            <h2 class="heading">Ready to become an online seller?</h2>
				            <p class="intro">Get AL's Solution today and enjoy selling your products for free. It's a must-have for any sellers who are serious about selling great products!</p>
				            <a class="btn btn-primary btn-cta" href="https://wrapbootstrap.com/theme/admin-appkit-admin-theme-angularjs-WB051SCJ1?ref=3wm" target="_blank">Try it now</a>
    				        
    					</div>
					</div>
				</div>
				
				-->
			</div><!--//carousel-inner-->

		</div><!--//carousel-->
    </div><!--//hero-->
    