 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Payment Request
		</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-book"></i> Payments</a></li>
			<li class="active">Request</a></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Default box -->
		<?php if($this->session->flashdata('message')) { ?>
			<div class="box">		
				<div  class="box-body">
					<?php echo $this->session->flashdata('message'); ?>
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
							<i class="fa fa-times"></i></button>
						</div>
				</div>
			</div>
		<?php } ?>
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">
					Request of Payments
				</h3>
				<div class="box-tools">
					<?php echo form_open('admin/payment_request','class="input-group input-group-sm" style="width: 150px;"' ); ?>
						<input type="text" name="search" class="form-control pull-right" placeholder="Search" value="<?php echo $search; ?>">
						<div class="input-group-btn">
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="box-body table-responsive no-padding" style="min-height:400px;max-height:400px;overflow-y: scroll;">
				<table class="table table-hover">
					<thead><tr>
						<th>Name</th>
						<th>Status</th>
						<th>Amount</th>
						<th>Date Created</th>
						<th>Approved Date</th>
						<th>Reference ID</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
						<?php if(empty($payments)):	?> 
							<tr><td colspan='10'  style="text-align: center;">No data available. </td></tr>
						<?php	else:  ?>
							<?php foreach($payments as $payment): ?>
								<tr>
									<td><?php echo  $payment->name; ?></td>
									<td>
										<?php if (strcmp($payment->status,'APPROVED') == 0){ ?>
											<span class="label label-success"><?php echo $payment->status; ?></span>
										<?php } else { ?>
											<span class="label label-warning"><?php echo $payment->status; ?></span>
										<?php } ?>
									</td>
									<td><?php echo  $payment->amount; ?></td>
									<td><?php echo  $payment->request_date; ?></td>
									<td><?php echo  $payment->approve_date; ?></td>
									<td><?php echo  $payment->reference_id; ?></td>
									<td><a href="#" onclick="update_payment(<?php echo  $payment->withdrawal_transaction_id; ?>)" data-toggle="modal" data-target="#approve" ><i class="fa fa-fw fa-pencil-square-o"></i></a></td>
								</tr>
							<?php endforeach;?>
						<?php	endif;?>
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- Approve Modal -->
<div id="approve" class="modal modal-success fade" role="dialog">
	<div class="modal-dialog modal-sm">
	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Approve Payment</h4>
		</div>
		<?php echo form_open('admin/approve_withdrawal'); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="refId">Reference ID</label>
					<input type="hidden" class="form-control" id="tId"  name="tId" >
					<input type="text" class="form-control" id="refId" name="refId" placeholder="Example: XHAEOU21"  required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				<button type="Submit" class="btn btn-outline">Approve</button>
			</div>
		<?php echo form_close(); ?>
	</div>
	</div>
</div>
<!-- Mining ads -->
<script>
	function update_payment(id){
		document.getElementById("tId").value= id;
	}
</script>