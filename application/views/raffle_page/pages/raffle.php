	<div class="col-md-12 ">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Raffle Information
			</h1>
			
			<ol class="breadcrumb">
				<li class="active"><a href="<?php echo base_url('raffle'); ?>"><i class="fa fa-fw fa-ticket"></i> Raffle</a></li>
				<li><a href="#"> Prize</a></li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-7">
					<div class="box box-success" >
						<div class="box-header">
							<h3 class="box-title"><b><?php echo string_util($raffle,'title'); ?></b></h3>
							<p class="text-muted">
								RAFFLE CODE:  <strong><?php echo string_util($raffle,'code'); ?></strong>
							</p>
						</div>
						<div class="box-body" style="min-height:350px;max-height:350px;overflow-y: auto;">
							<p>
								<img src="<?php echo string_util($raffle,'image'); ?>" alt="Smiley face" style="float:left;width:150px;height:150px;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
								<?php echo string_util($raffle,'description'); ?>				
							</p>
						</div>	
						<div class="box-footer" >
							<p class="text-muted">
								<i class="fa fa-fw fa-calendar-times-o"></i> RAFFLE Draw:  <b><?php echo string_date_util($raffle,'raffle_draw'); ?></b>
							</p>
						</div>
					</div><!-- /.box -->
				</div>
				<div class="col-md-5">
					<div class="box box-success" >
						<div class="box-header">
							<h3 class="box-title"><b>Participants</b></h3>
							<div class="box-tools">
								<?php echo form_open('raffle/view/'.$id,'class="input-group input-group-sm" style="width: 150px;"' ); ?>
									<input type="text" name="search" class="form-control pull-right" placeholder="Search" value="<?php echo $search; ?>">
									<div class="input-group-btn">
										<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
									</div>
								<?php echo form_close(); ?>
							</div>
						</div>
						<div class="box-body table-responsive"  style="min-height:175px;max-height:175px;overflow-y: auto;">
							<table class="table table-hover">
								<thead>
									<th width="65%">Name</th>
									<th>Date Participated</th>
								</thead>
								<tbody >
									<?php if(empty($participants)): ?>
										<td colspan="2" style="text-align: center;">No data available. </td>
									<?php else : ?>
										<?php foreach ($participants as $participant) :?>
											<tr>
												<td><a href="<?php echo string_util($participant,'fb_profile'); ?>"><?php echo string_util($participant,'name'); ?></a></td>
												<td><?php echo string_util($participant,'date_participated'); ?></td>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>	
						<div class="box-footer"></div>
						
					</div><!-- /.box -->
				</div>
				<div class="col-md-5">
					<div class="box box-success" >
						<div class="box-header">
							<h3 class="box-title"><b>Winners</b></h3>
							<div class="box-tools">
								<label><i class="fa fa-fw fa-trophy"></i> <?php echo string_util($raffle,'max_winner'); ?> Winner(s)</label>
							</div>
						</div>
						<div class="box-body  table-responsive" style="min-height:150px;max-height:150px;overflow-y: auto;">
							<table class="table table-hover">
								<thead>
									<th width="65%">Name</th>
									<th>Date Participated</th>
								</thead>
								<tbody >
									<?php if(empty($winners)): ?>
										<td colspan="2" style="text-align: center;">No data available. </td>
									<?php else : ?>
										<?php foreach ($winners as $winner) :?>
											<tr>
												<td><a href="<?php echo string_util($winner,'fb_profile'); ?>"><?php echo string_util($winner,'name'); ?></a></td>
												<td><?php echo string_util($winner,'date_participated'); ?></td>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
						<div class="box-footer"></div>
					</div><!-- /.box -->
				</div>
			</div>
		</section><!-- /.content -->
	</div>
	 <!-- Load Facebook SDK for JavaScript -->
  