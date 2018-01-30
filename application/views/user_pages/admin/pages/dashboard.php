<!-- NOT SUPPORTED FOR CHARTJS V 1.0 -->
 <style>
 .legend_position{
		margin: 0 auto;
	   width: 50%;
 }
 
.legend {
  list-style: none;
  margin: 0;
  padding: 0;
}

.legend li{
	 float: left;
	 margin-right: 5px;
}

.legend li span {
  width: 20px;
  height: 10px;
  display: inline-block;
  margin-right: 10px;
  border-radius: 10px;
}

 </style>
 <!-- MarketAds.com Popunder Code for Als Solution -->
<script type='text/javascript'>
var pmauid = '1707'
var pmawid = '2151'
var fq = '0';
</script>
<script type='text/javascript' src='http://app.marketads.net/assets/js/marketads.popunder.js'></script>
<!-- MarketAds.com Popunder Code End -->
 
 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>reports</small>
          </h1>
          <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          </ol>
        </section>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success alert-dismissible">
						 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						 <h4><i class="fa fa-bullhorn"></i> New Update!</h4>
						 <p>
							- Miner Ads is now available.</br>
							- Guide feature has been updated today.</br>
							</br>
							To access guide : Click this link <a href="<?php echo base_url('admin/guide'); ?>"> GUIDE</a>
							
						 </p>
					</div>
				</div>
				<div class="col-md-6">
					 <!-- Default box -->
					 <div class="box box-success ">
						<div class="box-header with-border">
							<h3 class="box-title">Performance: Last 7 Days</h3>
						  <div class="box-tools pull-right">
							 <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
							 <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
						  </div>
						</div>
						<div class="box-body">
							<div class="legend_position">
								<ul class="legend">
								  <li><span style="background-color:rgb(255, 99, 132)"></span>PROPELLER</li>
								  <li><span style="background-color:rgb(54, 162, 235)"></span>LAZADA</li>
								</ul>
							</div>
							<div class="chart">
								<canvas id="user_lineChart" ></canvas>
							</div>
						</div><!-- /.box-body -->
					 </div><!-- /.box -->
				</div>
            <div class="col-md-6">
					 <!-- Default box -->
					 <div class="box box-danger ">
						<div class="box-header with-border">
							<h3 class="box-title">Over All Contribution of Users: Last 7 Days</h3>
						  <div class="box-tools pull-right">
							 <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
							 <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
						  </div>
						</div>
						<div class="box-body">
							<div class="legend_position">
								<ul class="legend">
								  <li><span style="background-color:rgb(255, 99, 132)"></span>PROPELLER</li>
								  <li><span style="background-color:rgb(54, 162, 235)"></span>LAZADA</li>
								</ul>
							</div>
							<div class="chart">
							 <canvas id="lineChart" ></canvas>
							</div>
						</div><!-- /.box-body -->
					 </div><!-- /.box -->
				</div>
			</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
