 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Raffle Promo
				</h1>
				<ol class="breadcrumb">
					<li><i class="fa fa-fw fa-ticket"></i> Raffle</a></li>
					<li class="active">List of raffles</a></li>
				</ol>
			</section>
	
			<!-- Main content -->
			<section class="content">
	
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">
						Promos
					</h3>
					<div class="box-tools">
						<?php echo form_open('admin/mod/raffle/list','class="input-group input-group-sm" style="width: 150px;"' ); ?>
							<input type="text" name="search" class="form-control pull-right" placeholder="Search" value="<?php echo $search; ?>">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
				<div class="box-body table-responsive no-padding" style="min-height:400px;max-height:400px;overflow-y: auto;">
					<table class="table table-hover ">
						<thead><tr>
							<th width="10%"  class="text-center" >Raffle Draw</th>
							<th width="5%" class="text-center" >Status</th>
							<th width="45%">Title</th>
							<th  width="10%" class="text-center" >Action</th>
						</tr>
						</thead>
						<tbody>
							<?php if(empty($raffles)):	?> 
								<tr><td colspan='4'  class="text-center">No data available. </td></tr>
							<?php	else:  ?>
								<?php foreach($raffles as $raffle): ?>
									<tr>
										<td class="text-center"><?php echo string_date_util($raffle,'raffle_draw'); ?></td>
										<td class="text-center" >
										<?php if($raffle->status) : ?>
											<span class="label label-success">DONE</span>
										<?php else : ?>
											<span class="label label-warning">ONGOING</span>
										<?php endif; ?>
										</td>
										<td ><a href="<?php echo base_url('raffle/view/'. $raffle->raffle_id); ?>"><?php echo  $raffle->title; ?></a></td>
										<td class="text-center" >
											<a href="<?php echo base_url('admin/mod/raffle/update/'. $raffle->raffle_id); ?>"><i class="fa fa-fw fa-pencil-square-o "></i></a>
										</td>
									</tr> 
								<?php endforeach;?>
							<?php	endif;?>
						</tbody>
					</table>
				</div><!-- /.box-body -->
				<div class="box-footer">
				</div><!-- /.box-footer-->
			</div><!-- /.box -->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
