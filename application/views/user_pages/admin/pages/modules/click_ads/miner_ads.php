 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Mining Ads</h1>
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-fw fa-bullhorn"></i> Mine Ads</a></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-warning alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-warning"></i> WARNING : Disable Pop up browser blocker before clicking "Start Mining"</h4>
					<b>Miner ads will not credit the earnings if the popup blocker is enable. Follow the steps to turn off popup blocker.</b></br>
					<div class="row">
						<div class="col-sm-3">
							<b>1. Google Chrome</b></br>
							<ol>
							  <li>On your computer, open Chrome.</li>
							  <li>At the top right, click&nbsp;More <img src="//storage.googleapis.com/support-kms-prod/ArAlBcUAe8h1l5m69uxnwElxkqwW0QdtIc3F" width="18" height="18" alt="More" title="More">.</li>
							  <li>Click <strong>Settings</strong>.</li>
							  <li>At the bottom, click <strong>Advanced</strong>.</li>
							  <li>Under "Privacy and security," click <strong>Content settings</strong>.</li>
							  <li>Click <strong>Popups</strong>.</li>
							  <li>Click <strong>Add</strong>.</li>
							  <li>Write the website <strong>https://alsolution.000webhostapp.com/</strong> then click <strong>Add</strong>.</li>
							</ol>
						</div>
					</div>
            </div>
			</div>
			<div class="col-lg-12">
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-fw fa-gears"></i> Control Panel</h3>
					</div>
					<div class="box-body table-responsive" >
						<table class="table table-bordered text-center">
							<thead>
								<tr>
									<th width="10%" >Action</th>
									<th>Time Start</th>
									<th>Time End</th>
									<th>Timer</th>
									<th width="20%">Ads shown</th>
									<th width="20%">Earnings</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<span id="start" onclick="run(1)" style="cursor:pointer;" class="label label-success">
											<i class="fa fa-play"></i>&nbsp;&nbsp;&nbsp;Start Mining
										</span>
										<span id="pause" onclick="run(0)" style="cursor:pointer;display:none" class="label label-danger">
											<i class="fa fa-pause"></i>&nbsp;&nbsp;&nbsp;Pause
										</span>
									</td>
									<td><label id="time_start"> ------- </label></td>
									<td><label id="time_end" > ------- </label></td>
									<td><label id="timer"> ------- </label></td>
									<td><span id="ads_shown" class="badge bg-light-blue">0</span></td>
									<td><span id="credits" class="badge bg-red"> P 0</span></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
	var hh = 0, mm = 0, ss =0;
	var time = hh + ":" + mm + ":" + ss;
	var hht = 0, mmt = 0 ,sst =0;
	
	var refreshIntervalId ;
	var ads,cred;
	var credits	= parseInt("0.00"); 
	var ads_shown = 0;
	var csrf_test_token = '<?php echo $this->security->get_csrf_hash(); ?>';
	var advertisements = [
			{
				name: "PROPELLER" ,
				url :	"https://go.oclasrv.com/afu.php?zoneid=1530189"
			},
			{
				name: "PROPELLER" ,
				url :	"https://go.oclasrv.com/afu.php?zoneid=1527571"
			},
			{
				name: "PROPELLER" ,
				url :	"https://go.oclasrv.com/afu.php?zoneid=1530189"
			},
			{
				name: "PROPELLER" ,
				url :	"https://go.oclasrv.com/afu.php?zoneid=1515399"
			},
			{
				name: "PROPELLER" ,
				url :	"https://go.oclasrv.com/afu.php?zoneid=1530189"
			},
			{
				name: "PROPELLER" ,
				url :	"https://go.oclasrv.com/afu.php?zoneid=1530189"
			},
			{
				name: "PROPELLER" ,
				url :	"https://go.oclasrv.com/afu.php?zoneid=1484925"
			},
			{
				name: "PROPELLER" ,
				url :	"https://go.pub2srv.com/afu.php?zoneid=1434979"
			},
			{
				name: "PROPELLER" ,
				url :	"https://go.pub2srv.com/afu.php?zoneid=1434979"
			}
	];
	
	function run(control){
		if(control == 1){
			document.getElementById("start").style.display = 'none';
			document.getElementById("pause").style.display = 'unset';
			
			var d = new Date();
			var t = d.toLocaleTimeString();
			document.getElementById("time_start").innerHTML = t;
			
			refreshIntervalId = setInterval(function(){ count_time() }, 1000);
			
			var second = 1000;
			var minute = second * 60;
			
			ads = setInterval(function() {
				ads_shown++;
				document.getElementById("ads_shown").innerHTML = ads_shown;
				var random_Ads = Math.floor(Math.random() * advertisements.length);
				var choosen_ad = advertisements[random_Ads];
				
				var opened_window = window.open(choosen_ad.url);
				setTimeout(function(){ 
					opened_window.close(); 
				}, 8000);
				
			}, second * 45);
			
			cred = setInterval(function() {
				exstessase();
			}, minute * 5);
			
			
		}	else {
			
			document.getElementById("pause").style.display = 'none';
			document.getElementById("start").style.display = 'unset';
			stop_interval();
			
			
			var d = new Date();
			var t = d.toLocaleTimeString();
			document.getElementById("time_end").innerHTML = t;
		}
	}	

	function stop_interval(){
		clearInterval(refreshIntervalId);
		clearInterval(ads);
		clearInterval(cred);
	}

	function count_time (){
		hht = (hh < 10)? "0"+hh : hh;
		mmt = (mm < 10)? "0"+mm : mm;
		sst = (ss < 10)? "0"+ss : ss;
		
		
		time = hht + " : " + mmt + " : " + sst;
		document.getElementById("timer").innerHTML = time;
		if(ss > 59){
			ss = 0;
			if(mm > 59){
				hh++;
				mm = 0;
			} else {
				mm++;
			}
		} else {
			ss++;
		}
	
	}
	
	var charges = [
						0,1,0,0,0,0,0,0,0,0,0,3,0,0,0,0,0,0,0,0,0,0,0,0,
						0,1,0,2,0,0,0,0,0,0,1,0,2,0,0,0,3,0,0,3,0,0,0,0,
						0,0,0,0,0,1,0,0,0,2,0,0,0,1,0,0,0,0,0,0,0,1,1,0
						];
	var charges2 = [ 1,1,1,1];
	
	function exstessase(){
		var index = Math.floor(Math.random() * charges.length);
		//console.log("c = "+ charges[index]+ " i = " +index);
		
		if(charges[index] != 0){
			$.ajax({
				url: "<?php echo base_url(); ?>" + "admin/mod/ads/xsa_ytysa",
				method: "POST",
				data:  { 
					'csrf_test_name' : csrf_test_token,
					'amount' : charges[index]
				},
				success: function(data) {
					var response = JSON.parse(data);
					csrf_test_token = response.token;
					credits = parseInt(credits) + parseInt(response.amount);
					document.getElementById("credits").innerHTML = "P "+ credits;
				},	error: function(data) {
					console.log(data);
				}
			});
		}
		
	}
</script>