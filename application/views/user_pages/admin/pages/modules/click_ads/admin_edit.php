 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo (isset($title))? $title : ''; ?> Advertisement</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-bullhorn"></i> Advertisement</a></li>
			<li class="active"><?php echo (isset($title))? $title : ''; ?></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row" >
			<!-- Default box -->
			<?php if($this->session->flashdata('message')) { ?>
				<div class="col-md-12">
					<div class="box">		
						<div  class="box-body">
							<?php echo $this->session->flashdata('message'); ?>
							<div class="pull-right box-tools">
								<button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
									<i class="fa fa-times"></i></button>
								</div>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php echo form_open('admin/mod/ads/process'); ?>
				<input name="_id" type="hidden" value="<?php echo (isset($id)) ? $id : '' ; ?>" >
				<div class="col-md-6">
					<div class="box ">
						<div  class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-edit"></i> Content</h3>
						</div>
						<div  class="box-body">
							<div class="form-group">
								<label >Advetisement URL</label>
								<input name="url" type="url" class="form-control" value="<?php echo string_util($advertisement,'url'); ?>" placeholder="Example: http://ho.example.com" required>
							</div>
							<div class="form-group">
								<label >Amount</label>
								<input name="amount" type="number" class="form-control" value="<?php echo string_util($advertisement,'amount'); ?>"  placeholder="0.00" required>
							</div>
							<div class="form-group">
								<label >Code</label>
								<input name="code" type="text" class="form-control" value="<?php echo string_util($advertisement,'code'); ?>"  placeholder="Unique Code">
							</div>
							<div class="form-group">
								<label >Duration</label>
								<input name="duration" type="number" class="form-control" value="<?php echo string_util($advertisement,'duration'); ?>"  placeholder="Must be a number">
							</div>
						</div>
					</div><!-- /.box -->
				</div><!-- /.box -->
				<div class="col-md-6">
					<div class="box ">
						<div  class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-gears"></i> Configuration</h3>
						</div>
						<div  class="box-body">
							<div class="form-group">
								<label>Duration unit</label>
								<?php echo get_duration_unit(string_util($advertisement,'duration_unit'),true); ?>
							</div>
							<div class="form-group">
								<label>Currency</label>
								<?php echo get_currency(string_util($advertisement,'currency_type_id'),true); ?>
							</div>
							<div class="form-group">
								<label>Advertisement</label>
								<?php echo get_ads_type(string_util($advertisement,'ads_type_id'),true); ?>
							</div>
						</div>
						<div class="box-footer">
							<div class="form-group  pull-right">
								<a href="<?php echo base_url().'admin/mod/ads/list'; ?>" class="btn btn-default" >Cancel</a> &nbsp;
								<input type="submit" class="btn btn-info pull-right" value="Save">
							</div>
						</div>
					</div><!-- /.box -->
				</div><!-- /.box -->
			<?php echo form_close(); ?>
		</div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
</script>