<div class="login-box">
	<div class="login-logo">
		<a href="<?php echo base_url(); ?>"><b>AL's</b> Solutions</a></br>
		<h4><a href="<?php echo base_url(); ?>">We are making your life easier.</a></h4>
	</div><!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg" style="font-size:18px;">Sign in</p>
		<?php if($this->session->flashdata('message')) { ?>
			<div class="box" >
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							<?php echo $this->session->flashdata('message'); ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php echo form_open('check_login'); ?>
			<div class="form-group has-feedback">
				<?php echo form_input(array('name'=>'email','type'=>'email','class'=>'form-control','placeholder'=>'Email','required'=>'')); ?>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<?php echo form_password(array('name'=>'password','type'=>'password','class'=>'form-control','placeholder'=>'Password','required'=>'')); ?>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			
			<div class="row">
				<!-- <div class="col-xs-8">
				<div class="checkbox icheck">
				<label>
				<input type="checkbox"> Remember Me
				</label>
				</div>
				</div> -->
				<div class="col-xs-12">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
				</div><!-- /.col -->
			</div>
		<?php echo form_close(); ?>
		</br>
		<!-- 
		<div class="social-auth-links text-center">
		<p>- OR -</p>
		<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
		<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
		</div>

		-->
		<a href="#">I forgot my password</a><br>
		<a href="register" class="text-center">Register a new membership</a>

	</div><!-- /.login-box-body -->
</div><!-- /.login-box -->