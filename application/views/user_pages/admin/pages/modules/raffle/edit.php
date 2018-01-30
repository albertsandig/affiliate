 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo (isset($title))? $title : ''; ?> Raffle</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-bullhorn"></i> Raffle</a></li>
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
							<?php echo $this->session->flashdata('message')['message']; ?>
							<div class="pull-right box-tools">
								<button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
									<i class="fa fa-times"></i></button>
								</div>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php echo form_open('admin/mod/raffle/save'); ?>
				<input name="_id" type="hidden" value="<?php echo string_util($raffle,'raffle_id'); ?>" >
				<div class="col-md-8">
					<div class="box ">
						<div  class="box-body">
							<div class="form-group">
								<label>Title</label>
								<input required type="text" name="title" class="form-control" value="<?php echo string_util($raffle,'title'); ?>" />
							</div>
							<div class="form-group">
								<label>Content</label>
								<textarea required id="editor1" name="content" rows="10" cols="80" ><?php echo string_util($raffle,'description'); ?></textarea>
							</div>
						</div>
						<div class="box-footer">
							<div class="form-group  pull-right">
								<a href="<?php echo base_url().'admin/mod/ads/list'; ?>" class="btn btn-default" >Cancel</a> &nbsp;
								<input required type="submit" class="btn btn-info pull-right" value="Save">
							</div>
						</div>
					</div><!-- /.box -->
				</div><!-- /.box -->
				<div class="col-md-4">
					<div class="box ">
						<div  class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-gears"></i> Configuration</h3>
						</div>
						<div  class="box-body">
							<div class="form-group">
								<label>Code</label>
								<input required type="text" name="code" class="form-control" value="<?php echo  string_util($raffle,'code'); ?>" />
							</div>
							<div class="form-group">
								<label>Raffle Draw</label>
								<input type="date" name="raffle_draw" class="form-control" value="<?php echo string_util($raffle,'raffle_draw'); ?>" required  />
							</div>
							<div class="form-group">
								<label>Image</label>
								<input type="url" name="thumbnail" class="form-control" placeholder="https://www.example.com/example_image.jpg" required value="<?php echo string_util($raffle,'image'); ?>"/>
							</div>
							<div class="form-group">
								<label>Max winner</label>
								<input type="number" name="max_winner" class="form-control"  value="<?php echo string_util($raffle,'max_winner'); ?>" required/>
							</div>
						</div>
						<div class="box-footer">
						</div>
					</div><!-- /.box -->
				</div><!-- /.box -->
				<div class="col-md-4">
					<div class="box ">
						<div  class="box-header with-border">
							<h3 class="box-title"><i class="fa fa-fw fa-bullhorn"></i> Advertisement</h3>
						</div>
						<div  class="box-body">
							<iframe src="https://lap.lazada.com/banner/dynamic.php?banner_id=5a6dcfe424d8f&theme=2&p=3" frameborder="0" scrolling="no"></iframe>
						</div>
						<div class="box-footer">
						</div>
					</div><!-- /.box -->
				</div><!-- /.box -->
			<?php echo form_close(); ?>
		</div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
</script>