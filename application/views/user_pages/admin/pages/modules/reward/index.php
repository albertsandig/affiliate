 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Claim Reward</h1>
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-fw fa-gift"></i> Rewards</a></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-3">
				
				<?php echo form_open('admin/mod/reward/claim_points'); ?>
					<div class="box box-default">
						<?php if($this->session->flashdata('messageRewardPoints')) { ?>
							<div class="box-header with-border">
								<?php echo $this->session->flashdata('messageRewardPoints'); ?>
							</div>
						<?php } ?>
						<div class="box-body">
							<div class="small-box bg-aqua" style="margin: 0;">
								<div class="inner">
								<h3>10</h3>
								<p>Claim Points</p>
								</div>
								<div class="icon">
								<i class="ion ion-star"></i>
								</div>
							</div>
						</div><!-- /.box-body -->
						<div class="box-footer clearfix no-border">
							<a class="pull-right"><h4 id="id_point" style="color:red;font-weight: bold;margin: 8px;"></h4></a>
							<button id="id_point_button" type="submit" onclick="clickLink(4);" class="btn btn-info pull-right">Claim Here <i class="fa fa-arrow-circle-right"></i></button>
						</div>
				  </div>
			  <?php echo form_close(); ?>
			</div>
			<div class="col-lg-3">
				<?php echo form_open('admin/mod/reward/claim_money'); ?>
					<div class="box box-default">
						<?php if($this->session->flashdata('messageRewardMoney')) { ?>
							<div class="box-header with-border">
								<?php echo $this->session->flashdata('messageRewardMoney'); ?>
							</div>
						<?php } ?>
						<div class="box-body">
							<div class="small-box bg-green" style="margin: 0;">
								<div class="inner">
								<h3>0.10<sup style="font-size: 20px">¢</sup></h3>
								<p>Claim Money</p>
								</div>
								<div class="icon">
								<i class="ion ion-card"></i>
								</div>
							</div>
						</div><!-- /.box-body -->
						<div class="box-footer clearfix no-border">
							<a class="pull-right"><h4 id="id_money" class="timer" ></h4></a>
							<button id="id_money_button"  type="submit"  onclick="clickLink(1);" class="btn btn-success pull-right">Claim Here <i class="fa fa-arrow-circle-right"></i></button>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
	function clickLink(id){
		switch(id){
				// - LAXADA
			case 1:
				window.open("http://ho.lazada.com.ph/SHUrUY?url=https%3A%2F%2Fwww.lazada.com.ph%2Fcherry-mobile-onrev-5-in-display-4gb-black-46709123.html%3Foffer_id%3D%7Boffer_id%7D%26affiliate_id%3D%7Baffiliate_id%7D%26offer_name%3D%7Boffer_name%7D%26affiliate_name%3D%7Baffiliate_name%7D%26transaction_id%3D%7Btransaction_id%7D");
				break;
			case 2:
				window.open("http://ho.lazada.com.ph/SHUrUY?url=https%3A%2F%2Fwww.lazada.com.ph%2Fcherry-mobile-flare-p1-gold-64697209.html%3Foffer_id%3D%7Boffer_id%7D%26affiliate_id%3D%7Baffiliate_id%7D%26offer_name%3D%7Boffer_name%7D%26affiliate_name%3D%7Baffiliate_name%7D%26transaction_id%3D%7Btransaction_id%7D");
				break;
				// - PROPELLER
			case 3:
				window.open("https://go.oclasrv.com/afu.php?zoneid=1515399");
				break;
			case 4:
				window.open("https://go.oclasrv.com/afu.php?zoneid=1513005");
				break;
		}
		
	}
</script>