	<div class="col-md-8 ">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Raffle	Promos
				<small>Get a chance to win</small>
			</h1>
			<ol class="breadcrumb">
				<li class="active"><a href="<?php echo base_url('raffle'); ?>"><i class="fa fa-fw fa-ticket"></i> Raffle</a></li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="fa fa-fw fa-info-circle"></i> How to participate?</h4>
				<p>
					<ol>
						<li>Select a Raffle Price on the left.</li>
						<li>Copy the code</li>
						<li>Fill up the participant form below.</li>
						<li>Paste the raffle code.</li>
						<li>Click the <span class="label label-primary">Submit Entry</span>button.</li>
					</ol>
					
					Note: The winners will be either contacted in their email or in facebook account. So be sure that your account or email is valid.
				</p>
			</div>
			<?php if($this->session->flashdata('message')) { ?>
				<div class="box box-success">
					<div class="box-header">
						<?php 
						echo $this->session->flashdata('message')['message']; 
						
						?>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
				</div>
				<?php
						$input = $this->session->flashdata('message')['input'];
				?>
			<?php } ?>
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Participant Form</h3>
				</div>
				<?php echo form_open('raffle/participate'); ?>
					<div class="box-body">
							<div class="form-group">
								<label for="fname">First Name</label>
								<input name="fname" type="text" class="form-control" value="<?php echo (isset($input)) ? $input['fname'] : '' ?>" id="fname" placeholder="First Name">
							</div>
							<div class="form-group">
								<label for="lname">Last Name</label>
								<input name="lname"  value="<?php echo (isset($input)) ? $input['lname'] : '' ?>"  type="text" class="form-control" id="lname" placeholder="First Name">
							</div>
							<div class="form-group">
								<label for="fprofile">Facebook Profile</label>
								<input name="fprofile" type="url"  value="<?php echo (isset($input)) ? $input['fprofile'] : '' ?>"  class="form-control" id="fprofile" placeholder="Example: https://www.facebook.com/username">
							</div>
							<div class="form-group">
								<label for="code">Raffle Prize Code</label>
								<input name="code" type="text"  value="<?php echo (isset($input)) ? $input['code'] : '' ?>" class="form-control" id="code" placeholder="Example: OE721FAAAO5KRPANPH-50306761">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<input name="email" type="email" value="<?php echo (isset($input)) ? $input['email'] : '' ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
							</div>
						
					</div><!-- /.box-body -->
					<div class="box-footer">
						
						<button type="submit" onclick="link_onclick()" class="btn btn-primary pull-right">Submit Entry</button>
						<div id="fb-root"></div>
						<script>
							(function(d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0];
								if (d.getElementById(id)) return;
								js = d.createElement(s); js.id = id;
								js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1";
								fjs.parentNode.insertBefore(js, fjs);
								}
							(document, 'script', 'facebook-jssdk'));
						</script>
						<!-- <div class="fb-share-button" data-href="<?php echo base_url('raffle'); ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true">
							<a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('raffle'); ?>">Share</a>
						</div> -->
						<div class="fb-share-button" data-href="<?php echo base_url('raffle'); ?>" data-layout="button" data-size="small" data-mobile-iframe="true">
							<a class="fb-xfbml-parse-ignore btn btn-social btn-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Falsolution.000webhostapp.com%2F&amp;src=sdkpreparse"><i class="fa fa-facebook"></i>  Share</a>
						</div>
						
					</div>
				<?php echo form_close(); ?>
			</div><!-- /.box -->
		</section><!-- /.content -->
	</div>
	 <!-- Load Facebook SDK for JavaScript -->
  <script>
		function link_onclick(){
			window.open("https://go.oclasrv.com/afu.php?zoneid=1527571", 'width=1000,height=1000');
		}
  </script>