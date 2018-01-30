	<div class="register-box">
      <div class="register-logo">
        <a href="<?php echo base_url(); ?>"><b>AL's</b> Solutions</a></br>
		  <h4><a href="<?php echo base_url(); ?>">We are making your life easier.</a></h4>
      </div>
      <div class="register-box-body">
			<p class="login-box-msg" style="font-size:18px;">
				Register as member
			</p>
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
			<?php echo form_open('register/create'); ?>
				<?php echo form_input(array('type'=>'hidden','name'=>'referral','required'=>'','value'=>$id)); ?>
				<div class="form-group has-feedback">
					<?php echo form_input(array('name'=>'firstname','class'=>'form-control','placeholder'=>'Firstname*','required'=>'')); ?>
				</div>
				<div class="form-group has-feedback">
					<?php echo form_input(array('name'=>'lastname','class'=>'form-control','placeholder'=>'Lastname*','required'=>'')); ?>
				</div>
				<div class="form-group has-feedback" style="color: White">
					<label style="font-size:18px;font-weight:400">Gender : </label>&nbsp;&nbsp;
					<label>
						<?php echo form_input(array('name'=>'gender','value'=>'Male','type'=>'radio','class'=>'form-control','required'=>'','checked'=>'')); ?>
						&nbsp; Male &nbsp;&nbsp;
						<?php echo form_input(array('name'=>'gender','value'=>'Female','type'=>'radio','class'=>'form-control','required'=>'')); ?>
						&nbsp; Female
					</label>
				</div>
				<div class="form-group has-feedback">
					<?php echo form_input(array('name'=>'email','type'=>'email','class'=>'form-control','placeholder'=>'Email*','required'=>'')); ?>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<?php echo form_input(array('name'=>'mobile_number','data-toogle'=>'tooltip','type'=>'text','title'=>'Enter your mobile number without including the leading 0','placeholder'=>'Mobile number','value'=>'+63','data-inputmask'=>"'mask': '+639999999999'",'class'=>'form-control','data-mask'=>'','required'=>'')); ?>
					<span class="glyphicon glyphicon-phone form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<?php echo form_password(array('id'=>'password','minlength'=>'8','onkeyup'=>'equal_password()','name'=>'password','class'=>'form-control','placeholder'=>'Password*','required'=>'')); ?>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input id="retype_pass" onkeyup="equal_password()" type="password" class="form-control" placeholder="Retype password*" required> 
					<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
				</div>
				
				
				<!--<div class="form-group has-feedback">
					<label>Birthdate :</label>
					<?php // echo form_input(array('name'=>'birthdate','type'=>'date','class'=>'form-control','placeholder'=>'Date','required'=>'')); ?>
					<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
				</div>
				
				<div class="form-group has-feedback">
					<?php // echo form_textarea(array('name'=>'address','type'=>'text','placeholder'=>'Current Address','class'=>'form-control','required'=>'','style'=>'max-height:100px')); ?>
				</div> -->
				<div class="row">
					<div class="col-xs-8">
						<div class="checkbox icheck">
							<label>
							<?php echo form_input(array('name'=>'terms','type'=>'checkbox','required'=>'')); ?> 
							 I agree to the <a href="#" data-toggle="modal" data-target="#terms" >terms</a>
							</label>
						</div>
					</div>
					<div class="col-xs-4">
						<?php echo form_input(array('type'=>'submit','class'=>'btn btn-primary btn-block btn-flat','value'=>'Register')); ?>
					</div>
				</div>
			<?php echo form_close(); ?>
			<!--
        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div>
			-->
        Already have an account? <a href="<?php echo base_url('credential/login'); ?>" class="text-center">Login here.</a>
      </div><!-- /.form-box -->
   </div><!-- /.register-box -->
	
<!-- Terms Modal -->
<div id="terms" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Terms</h4>
			</div>
			<div class="modal-body" >
				<h4><b>Terms of use</b></h4>
				<p>
					Welcome to the Als Solution platform. 
					Please read these terms and conditions carefully. 
					The following Terms of Use govern your use and access of the Platform (defined below) and the use of the Services. 
					By accessing the Platform and/or using the Services, you agree to be bound by these Terms of Use. 
					If you do not agree to these Terms of Use, do not access and/or use this Platform or the Services.

					Access to and use of password protected and/or secure areas of the Platform 
					and/or use of the Services are restricted to members with accounts only. 
					You may not obtain or attempt to obtain unauthorized access to such parts of this 
					Platform and/or Services, or to any other protected information, through any means not 
					intentionally made available by us for your specific use.
				</p>
				<h4><b>1. Definitions & Interpretation</b></h4>
				<p>
					Unless otherwise defined, the definitions and provisions in respect of 
					interpretation set out in Schedule 1 will apply to these Terms of Use.
				</p>
				<h4><b>2. Fees and Payment</b></h4>
				<p>
					< UNDECIDED >
				</p>
				<h4><b>3. Termination of membership account</b></h4>
				<p>
					< UNDECIDED >
				</p>
				<h4><b>4. Illegal Activities</b></h4>
				<p>
					< UNDECIDED >
				</p>
				<h4><b>5. Our limitation of responsibility and liability</b></h4>
				<p>
					< UNDECIDED >
				</p>
				<h4><b>6. Your submissions and information</b></h4>
				<p>
					< UNDECIDED >
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
	
	