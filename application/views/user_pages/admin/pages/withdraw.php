 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Withdrawal
			<small>request for payment</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-gears"></i></i> Settings</a></li>
			<li class="active">Withdraw</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		 <!-- Default box -->
		<div class="row" >
			<div class="col-md-6">
				<div class="box">
					<div class="box-header with-border">
					  <h3 class="box-title">Request for Payment</h3>
					</div>
					<?php if($this->session->flashdata('message')) { ?>
						<div  class="box-body">
							<?php echo $this->session->flashdata('message'); ?>
						</div>
					<?php } ?>
					<?php echo form_open('admin/request_w'); ?>
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1">Peso Address <a href="https://coins.ph/m/join/lyytsa" title="Register in coins.ph"><i class="fa fa-fw fa-question-circle"></i></a></label>
								<input type="text" class="form-control"disabled id="exampleInputEmail1" value="<?php echo string_util($account_info,'peso_address'); ?>" >
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Balance (Peso)</label>
								<input type="text" class="form-control"disabled id="exampleInputEmail1" value="<?php echo string_util($wallet_php,'amount'); ?>" >
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Amount (Peso)</label>
								<input name="amount" required type="number" class="form-control" id="exampleInputEmail1" placeholder="Balance must be at least P 1,000.00">
							</div>
						</div><!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-info pull-right">Submit</button>
						</div><!-- /.box-footer-->
					<?php echo form_close(); ?>
				</div><!-- /.box -->
			</div>
		</div>
	</section><!-- /.content -->
 </div><!-- /.content-wrapper -->
