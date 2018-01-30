
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	<h1>
		Account
		<small>personal information</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-fw fa-user"></i> Profile</a></li>
		<li><a class="active">Account</a></li>
	</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<?php if($this->session->flashdata('message')) { ?>
			<div class="col-md-12">
				<div class="box" >
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
			<div class="col-md-3">
				<div class="box box-primary">
					 <div class="box-body box-profile">
						<img class="profile-user-img img-responsive img-circle"  src="<?php echo (!empty($this->session->userdata('profile_pic'))) ? $this->session->userdata('profile_pic') : base_url('/components/dist/img/avatar6.png'); ?>" alt="User profile picture">
							<h3 class="profile-username text-center"><?php echo $this->session->userdata('name'); ?></h3>
						<p class="text-muted text-center">USER</p> 

						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Referral ID</b> 
								
							</li>
							<li class="list-group-item">
								<div class="input-group input-group-sm pull-right ">
									<input id="referralLink" type="text" readonly class="form-control" value="<?php //echo get_url_shorter('https://alsolution.000webhostapp.com/credential/register/'.$this->session->userdata('user_no'));  ?><?php echo get_url_shorter(base_url().'credential/register/'.$this->session->userdata('user_no')); ?>">
									<span class="input-group-btn">
										<button  onclick="copy()" type="button" class="btn btn-info btn-flat"><i class="fa fa-fw fa-copy"></i></button>
									</span>
								</div>
						  </li>
						</ul>
						
					</div><!-- /.box-body -->
				</div>
				<div class="box box-primary">
                <div class="box-header with-border" style="padding-bottom:0px;">
                  <h3 class="box-title"> <i class="fa fa-fw fa-credit-card"></i> Wallet</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
						<ul class="list-group list-group-unbordered">
							<?php foreach($wallet as $w):?>
							
						  <li class="list-group-item">
							 <b><i class="fa fa-fw <?php echo string_util($w,'icon'); ?>"></i></b> <a class="pull-right"><?php echo string_util($w,'amount'); ?></a>
						  </li>
						  <?php endforeach; ?>
						</ul>
               </div><!-- /.box-body -->
            </div>
			</div>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#myprofile" data-toggle="tab">Profile</a></li>
						<li><a href="#team" data-toggle="tab">Team</a></li>
						<li><a href="#withdrawals" data-toggle="tab">Withdrawals</a></li>
						<li><a href="#deposit" data-toggle="tab">Deposit</a></li>
					</ul>
					<div class="tab-content" style="min-height:455px;">
						<div class="active tab-pane" id="myprofile">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Information</h3>
								 </div>
								 <div class="box-body">
									<table class="table table-bordered">
										<tbody>
											<tr>
												<th>User ID</th>
												<td>ALS-<?php echo $this->session->userdata('user_no'); ?></td>
												<th>Verified</th>
												<?php  if(string_util($account_info,'verify') == 1):  ?>
													<td><span class="label label-primary">Verified</span></td>
												<?php else: ?>
													<td><a href="<?php echo base_url().'register/send_verification'; ?>" class="label label-danger" >Click here to verify</a>
												<?php endif; ?>
											</tr>
											<tr>
												<th width="150px">Age</th>
												<td><?php echo string_util($account_info,'age'); ?></td>
												<th>Birthday</th>
												<td><?php echo string_util($account_info,'birthday'); ?></td>
											</tr>
											<tr>
												<th>Gender</th>
												<td><?php echo string_util($account_info,'gender'); ?></td>
												<th>Address</th>
												<td><?php echo string_util($account_info,'address'); ?></td>
											</tr>
											<tr>
												<th>Phone Number</th>
												<td><?php echo string_util($account_info,'mobile_number'); ?></td>
												<th>Email</th>
												<td><?php echo $this->session->userdata('email'); ?></td>
											</tr>
										</tbody>
									</table>
									<table class="table table-bordered">
										<tbody>
											<tr>
												<th width="125px">Peso Address 
												<a href="https://coins.ph/m/join/lyytsa" title="Register in coins.ph"><i class="fa fa-fw fa-question-circle"></i></a>
												</th>
												<td><?php echo string_util($account_info,'peso_address'); ?></td>
											</tr>
										</tbody>
									</table>
								</div><!-- /.box-body -->
							</div>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="withdrawals">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Withdrawals</h3>
									<div class="col-md-8 pull-right" >
										<div class="row "> 
											<div class="col-md-1 pull-right" >
												<input type="Submit" class="btn btn-primary" value="Go">
											</div>
											<div class="form-group  pull-right" style="padding-right:0px">
												<input type="date" class="form-control" >
											</div>
											<div class="col-md-4 pull-right"  >
												<select class="form-control" id="inputEmail3" >
													<option>ALL</option>
													<option>APPROVED</option>
													<option>PENDING</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="box-body" style="max-height:300px;overflow-y:auto;">
									<table class="table table-bordered">
										<thead>
											<th style="min-width: 115px;">Transaction ID</th>
											<th>Status</th>
											<th>Amount</th>
											<th style="min-width: 115px;">Date Requested</th>
											<th style="min-width: 115px;">Date Approved</th>
											<th style="min-width: 115px;">Reference ID</th>
											<th>Peso Address</th>
										</thead>
										<tbody>
											<?php if(empty($withdrawals)):	?> 
												<tr><td colspan='10'  style="text-align: center;">No data available. </td></tr>
											<?php	else:  ?>
												<?php foreach($withdrawals as $withdrawal): ?>
													<tr>
														<td><?php echo  $withdrawal->transaction_id; ?></td>
														<td>
															<?php if (strcmp($withdrawal->status,'APPROVED') == 0){ ?>
																<span class="label label-success"><?php echo $withdrawal->status; ?></span>
															<?php } else { ?>
																<span class="label label-warning"><?php echo $withdrawal->status; ?></span>
															<?php } ?>
														</td>
														<td><?php echo  $withdrawal->amount; ?></td>
														<td><?php echo  $withdrawal->request_date; ?></td>
														<td><?php echo  $withdrawal->approve_date; ?></td>
														<td><?php echo  $withdrawal->reference_id; ?></td>
														<td><?php echo  $withdrawal->peso_address; ?></td>
													</tr>
												<?php endforeach;?>
											<?php	endif;?>
										</tbody>		
									</table>
								</div>
							</div>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="deposit">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Deposit</h3>
									<div class="col-md-8 pull-right" >
										<div class="row "> 
											<div class="col-md-1 pull-right" >
												<input type="Submit" class="btn btn-primary" value="Go">
											</div>
											<div class="form-group  pull-right" style="padding-right:0px">
												<input type="date" class="form-control" >
											</div>
										</div>
									</div>
								</div>
								<div class="box-body" style="max-height:300px;overflow-y:auto;">
									<table class="table table-bordered">
										<thead>
											<th>Transaction ID</th>
											<th>Amount</th>
											<th>Date Received</th>
										</thead>
										<tbody>
											<?php if(empty($deposits)):	?> 
												<tr><td colspan='10'  style="text-align: center;">No data available. </td></tr>
											<?php	else:  ?>
												<?php foreach($deposits as $deposit): ?>
													<tr>
														<td><?php echo  $deposit->transaction_id; ?></td>
														<td>
														<?php echo (strcmp($deposit->currency_type,"POINTS") == 0) ? 
															'<i class="fa fa-fw fa-star-o"></i> ': 
															'<i class="fa fa-fw fa-ruble"></i> '; ?>
														<?php echo  $deposit->amount; ?>
														
														</td>
														<td><?php echo  $deposit->deposit_date; ?></td>
													</tr>
												<?php endforeach;?>
											<?php	endif;?>
										</tbody>		
									</table>
								</div>
							</div>
						</div><!-- /.tab-pane -->
						<div class="tab-pane" id="team">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Team</h3>
								</div>
								<div class="box-body" style="max-height:300px;overflow-y:auto;">
									<table class="table table-bordered">
										<thead>
											<th width="15%">Date Entered</th>
											<th width="50%">Name</th>
											<th>Total Contributions</th>
										</thead>
										<tbody>
											<?php if(empty($team)):	?> 
												<tr><td colspan='10'  style="text-align: center;">No data available. </td></tr>
											<?php	else:  ?>
												<?php foreach($team as $member): ?>
													<tr>
														<td><?php echo  $member->create_date; ?></td>
														<td><?php echo  $member->name; ?></td>
														<td><?php //echo  $member->total_contribution; ?></td>
													</tr>
												<?php endforeach;?>
											<?php	endif;?>
										</tbody>	
									</table>
								</div>	
							</div>
						</div><!-- /.tab-pane -->
					</div><!-- /.tab-content -->
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
	function copy() {
		var element = document.getElementById("referralLink");
		 var accountID = 235882;
		 var adType = "int";
		 var domains = [element.value];
		 alert(element.value);
		 
	   var copyText = document.getElementById("referralLink");
		copyText.select();
		document.execCommand("Copy");
		alert("Link has been succefully copy.");
	}
	
</script>