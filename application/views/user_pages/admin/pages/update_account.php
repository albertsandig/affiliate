 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	<h1>
		Update Account
		<small>personal information</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-gears"></i> Settings</a></li>
		<li class="active">Update Account</li>
	</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<?php if($this->session->flashdata('message')) { ?>
				<div class="col-md-8">
					<div class="box box-default" >
						<div class="box-body">
							<div class="row">
								<div class="col-xs-12">
									<?php echo $this->session->flashdata('message'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="col-md-8">
				<div class="box box-primary">
               <div class="box-header with-border" style="padding-bottom:0px;">
                  <h3 class="box-title"> Account Info</h3>
               </div><!-- /.box-header -->
               <?php echo form_open('admin/update_credential'); ?>
						<div class="box-body">
							<div class="form-group">
								<label for="url">Picture</label>
								<?php echo form_input(array('name'=>'picture','id'=>'url','type'=>'url','class'=>'form-control','value'=>string_util($account_info,'img_source'),'placeholder'=>'http://www.example.com/img/myface.jpg')); ?>
							</div>
							<div class="form-group">
								<label for="fname">Firstname</label>
								<?php echo form_input(array('name'=>'fname','id'=>'fname','type'=>'text','class'=>'form-control','required'=>'','value'=>string_util($account_info,'firstname'))); ?>
							</div>
							<div class="form-group">
								<label for="lname">Lastname </label>
								<?php echo form_input(array('name'=>'lname','id'=>'lname','type'=>'text','class'=>'form-control','required'=>'','value'=>string_util($account_info,'lastname'))); ?>
							</div>
							<div class="form-group">
								<label for="age">Age </label>
								<?php echo form_input(array('name'=>'age','id'=>'age','type'=>'number','class'=>'form-control','required'=>'','value'=>string_util($account_info,'age'))); ?>
							</div>
							<div class="form-group">
								<label for="gender">Gender: </label>&nbsp;&nbsp;
								<?php
									$radio_is_checked = strcmp(strtoupper(string_util($account_info,'gender')),"MALE") == 0;									
									
									$male = array('name'=>'gender','type'=>'radio','required'=>'','value'=>"Male");
									$female = array('name'=>'gender','type'=>'radio','required'=>'','value'=>"Female");
									
									if($radio_is_checked)
										$male['checked'] = 1;
									else
										$female['checked'] = 1;
									
									?> 
									
									<?php echo form_input($male); ?> Male&nbsp; &nbsp;&nbsp
									<?php echo form_input($female); ?> Female
									
							</div>
							<div class="form-group">
								 <label>Birthday:</label>

								 <div class="input-group">
									<div class="input-group-addon">
									  <i class="fa fa-calendar"></i>
									</div>
									<input name="birthday" type="date" class="form-control" value="<?php echo string_util($account_info,'birthday'); ?>" >
								 </div>
								 <!-- /.input group -->
							</div>
							<div class="form-group">
							  <label>Phone Number:</label>
							  <div class="input-group">
								 <div class="input-group-addon">
									<i class="glyphicon glyphicon-phone "></i>
								 </div>
								 <?php echo form_input(array('name'=>'mobile_number','data-toogle'=>'tooltip','type'=>'text','title'=>'Enter your mobile number without including the leading 0','placeholder'=>'Mobile number','value'=>string_util($account_info,'mobile_number'),'data-inputmask'=>"'mask': '+639999999999'",'class'=>'form-control','data-mask'=>'','required'=>'')); ?>
							  </div><!-- /.input group -->
							</div>
							<div class="form-group">
								<label for="email">Email </label>
								<input  name="email"  type="email" class="form-control" id="email" value="<?php echo $this->session->userdata('email'); ?>">
							</div>
							<div class="form-group">
								<label for="password">Password </label>
								<input name="password"  type="password" class="form-control" id="password" >
							</div>
							<div class="form-group">
								<label for="cpassword">Confirm Password </label>
								<input name="cpassword"  type="password" class="form-control" id="cpassword" >
							</div>
							<div class="form-group">
								<label for="paddress">Peso Address <a href="https://coins.ph/m/join/lyytsa" title="Register in coins.ph"><i class="fa fa-fw fa-question-circle"></i></a></label>
								<input name="paddress"  type="text" class="form-control" id="paddress" value="<?php echo string_util($account_info,'peso_address'); ?>">
							</div>
							<div class="form-group">
								<label for="address">Address </label>
								<textarea  name="address"  id="address" class="form-control" style="resize: none;"> <?php echo string_util($account_info,'address'); ?>"</textarea>
							</div>
						</div><!-- /.box-body -->
						<div class="box-footer">
							 <button type="submit" class="btn btn-primary pull-right">Submit</button>
						</div>
					<?php echo form_close(); ?>
            </div>
			</div>
			
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
