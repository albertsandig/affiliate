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
    <meta name="description" content="Al's Solution">
    <meta name="author" content="Albert Sandig">    
	 <meta name="propeller" content="d55859087915893db68d57e380d09c4b">
    <link rel="shortcut icon" href="<?php echo base_url('components/assets/images/team_logo.png'); ?>">  
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
	 <?php 	
		if(isset($css)):
			echo $css; 
		endif;
	?>
	 
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
                        <li class="active nav-item"><a class="scrollto" href="#win_load">Win Load</a></li>
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
                	        <img class="figure-image img-responsive" src="<?php echo base_url('components/assets/images/winner.png'); ?>" alt="image" />
                        </div><!--//figure-holder-->
            		</div><!--//row-->
        		</div><!--//container-->
    		</div><!--//figure-holder-wrapper-->
            
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li class="active" data-slide-to="0" data-target="#hero-carousel"></li>
				<li data-slide-to="1" data-target="#hero-carousel"></li>
				<li data-slide-to="2" data-target="#hero-carousel"></li>
			</ol>
			
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
    			
				<div class="item item-1 active">
					<div class="item-content container">
    					<div class="item-content-inner">
    				        
				            <h2 class="heading">AL's Solutions is a beta website that allows people to participate in events</h2>
				            <p class="intro">We manage events that will give you reward such as load, money, and etc.</p>
								
				            <a class="btn btn-primary btn-cta" href="#win_load" onclick="link_onclick();"  >Get Started</a>
    				        
    					</div><!--//item-content-inner-->
					</div><!--//item-content-->
				</div><!--//item-->
				<div class="item item-2 ">
					<div class="item-content container">
    					<div class="item-content-inner">
    				        
				            <h2 class="heading">AL's Solutions is a beta website that allows people to participate in events</h2>
				            <p class="intro">We manage events that will give you reward such as load, money, and etc.</p>
								
				            <a class="btn btn-primary btn-cta" href="#win_load" onclick="link_onclick();"  >Get Started</a>
    				        
    					</div><!--//item-content-inner-->
					</div><!--//item-content-->
				</div><!--//item-->
			</div><!--//carousel-inner-->

		</div><!--//carousel-->
    </div><!--//hero-->
    