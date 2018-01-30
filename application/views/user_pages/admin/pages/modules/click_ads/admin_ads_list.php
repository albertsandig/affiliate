 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Advertisements</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-bullhorn"></i> Advertisement</a></li>
			<li class="active">List</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<div class="row">
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
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">
							List of advertisements
						</h3>
						<div class="box-tools">
							<?php echo form_open('admin/payment_request','class="input-group input-group-sm" style="width: 150px;"' ); ?>
								<input type="text" name="search" class="form-control pull-right" placeholder="Search" value="<?php echo (isset($search)) ? $search : ''; ?>">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
					<div class="box-body table-responsive no-padding" style="min-height:400px;max-height:400px;overflow-y: scroll;">
						<table class="table table-hover">
							<thead><tr>
								<th>Type ID</th>
								<th>Code</th>
								<th>Currency</th>
								<th>Amount</th>
								<th>Advertisment</th>
								<th>Duration</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
								<?php if(empty($list_advertisement)):	?> 
									<tr><td colspan='10'  style="text-align: center;">No data available. </td></tr>
								<?php	else:  ?>
									<?php foreach($list_advertisement as $ad): ?>
										<tr>
											<td><?php echo  $ad->transaction_type_id; ?></td>
											<td><?php echo  $ad->code; ?></td>
											<td><?php echo  $ad->currency_name; ?></td>
											<td><i class="fa fa-fw <?php echo  $ad->icon; ?>"></i><?php echo  $ad->amount; ?></td>
											<td><?php echo  $ad->advertisement_name; ?></td>
											<td><?php echo  $ad->duration; ?></td>
											<td><a href="<?php echo base_url().'admin/mod/ads/update/'.$ad->transaction_type_id; ?>"   ><i class="fa fa-fw fa-pencil-square-o"></i></a></td>
										</tr>
									<?php endforeach;?>
								<?php	endif;?>
							</tbody>
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
</script>