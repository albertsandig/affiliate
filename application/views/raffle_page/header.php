<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Al's Solution</title>
		<link rel="shortcut icon" href="<?php echo base_url('components/assets/images/team_logo.png'); ?>">  
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		
		<link rel="alternate" href="<?php echo base_url(); ?>" hreflang="en-us" />
		<meta property="og:url"           content="<?php echo base_url('raffle'); ?>" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="Als Solution" />
		<meta property="og:description"   content="Advertisement website" />
		<meta property="og:image"         content="<?php echo base_url('components/assets/images/team_logo.png'); ?>" />
		
		<?php 	
			if(isset($css)):
				echo $css; 
			endif;
		?>
		
		<?php echo (isset($advertisement))? $advertisement : '' ; ?>
		<!-- MarketAds.com Popunder Code for Als Solution -->
		<!-- MarketAds.com Popunder Code End -->
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<!--
	BODY TAG OPTIONS:
	=================
	Apply one or more of the following classes to get the
	desired effect
	|---------------------------------------------------------|
	| SKINS         | skin-blue                               |
	|               | skin-black                              |
	|               | skin-purple                             |
	|               | skin-yellow                             |
	|               | skin-red                                |
	|               | skin-green                              |
	|---------------------------------------------------------|
	|LAYOUT OPTIONS | fixed                                   |
	|               | layout-boxed                            |
	|               | layout-top-nav                          |
	|               | sidebar-collapse                        |
	|               | sidebar-mini                            |
	|---------------------------------------------------------|
	-->
	<body class="hold-transition fixed skin-blue layout-top-nav">
		<div class="wrapper">
			<header class="main-header">
				<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a href="<?php echo base_url('home'); ?>" class="navbar-brand"><b><b>Als</b></b>Solution</a>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						<i class="fa fa-bars"></i>
						</button>
					</div>
		
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
						<ul class="nav navbar-nav ">
						<li ><a href="<?php echo base_url('home'); ?>">About<span class="sr-only">(current)</span></a></li>
						<li class="<?php echo (isset($menu_raffle))? $menu_raffle : ''; ?>" ><a href="<?php echo base_url('raffle'); ?>">Raffle</a></li>
						<li class="<?php echo (isset($menu_post))? $menu_post : ''; ?>"><a href="<?php echo base_url('post'); ?>">Posts</a></li>
						<!-- 
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
								<li class="divider"></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li> -->
						</ul>
					<!-- 
						<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
						</div>
						</form>
					
					-->
					</div><!-- /.navbar-collapse -->
					<!-- Navbar Right Menu -->
						<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<?php if(empty($this->session->userdata('user_no'))): ?>
								<li>
									<a href="<?php echo base_url('login'); ?>">
										Login
									</a>
								</li>
							<?php else : ?>
								<!-- User Account Menu -->
								<li class="dropdown user user-menu">
									<!-- Menu Toggle Button -->
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<!-- The user image in the navbar-->
									<img onerror="this.src='<?php echo base_url('/components/dist/img/avatar6.png'); ?>';"  src="<?php echo (!empty($this->session->userdata('profile_pic'))) ? $this->session->userdata('profile_pic') : base_url('/components/dist/img/avatar6.png'); ?>" class="user-image" alt="User Image">
									<!-- hidden-xs hides the username on small devices so only the image appears. -->
									<span class="hidden-xs"><?php echo (!empty($this->session->userdata('name'))) ? $this->session->userdata('name') : 'UNKNOWN'; ?></span>
									</a>
									<ul class="dropdown-menu">
									<!-- The user image in the menu -->
									<li class="user-header">
										<img onerror="this.src='<?php echo base_url('/components/dist/img/avatar6.png'); ?>';"  src="<?php echo (!empty($this->session->userdata('profile_pic'))) ? $this->session->userdata('profile_pic') : base_url('/components/dist/img/avatar6.png'); ?>" class="img-circle" alt="User Image">
										<p>
											<?php echo (!empty($this->session->userdata('name'))) ? $this->session->userdata('name') : 'UNKNOWN'; ?>
										<small> <?php echo $this->session->userdata('user_type'); ?></small>
										</p>
									</li>
									<!-- Menu Body -->
									<!-- <li class="user-body">
										<div class="col-xs-4 text-center">
										<a href="#">Followers</a>
										</div>
										<div class="col-xs-4 text-center">
										<a href="#">Sales</a>
										</div>
										<div class="col-xs-4 text-center">
										<a href="#">Friends</a>
										</div>
									</li>
									-->
									<!-- Menu Footer-->
										<li class="user-footer">
										<div class="pull-left">
											<a href="<?php echo base_url()."admin/account"; ?>" class="btn btn-default btn-flat">Profile</a>
										</div>
										<div class="pull-right">
											<a href="<?php echo base_url('admin/user/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
										</div>
										</li>
									</ul>
								</li>
							<?php endif; ?>
						</ul>
						</div><!-- /.navbar-custom-menu -->
				</div><!-- /.container-fluid -->
				</nav>
			</header>
			<div class="content-wrapper">
				<div class="container">
					<div class="row">