 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Click Ads</h1>
		<ol class="breadcrumb">
			<li class="active"><i class="fa fa-fw fa-bullhorn"></i> Click Ads</a></li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<?php if($this->session->flashdata('message')) { ?>
				<div class="col-lg-12">
					<div class="box box-default">
						<div class="box-header with-border">
							<?php echo $this->session->flashdata('message'); ?>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="col-lg-12">
				<div class="box box-default">
					<div class="box-header with-border">
					  <h3 class="box-title">Advertisements</h3>
					</div>
					<div class="box-body table-responsive no-padding" style="min-height:400px;max-height:400px;overflow-y: scroll;">
						<table class="table table-hover">
							<thead>
								<tr>
								<th class="text-center">No</th>
								<th class="text-center">Code</th>
								<th>Content</th>
								<th class="text-center" >Amount</th>
								<th class="text-center" >Duration</th>
								<th class="text-center" >Action</th>
							</tr>
							</thead>
							<tbody>
								<?php if(empty($ads)):	?> 
									<tr><td colspan='10'  class="text-center">No data available. </td></tr>
								<?php	else:  
										$i = 0;
								?>
									<?php foreach($ads as $ad): ?>
										<tr>
											<td class="text-center"  width="5%"><?php echo  $i++; ?></td>
											<td class="text-center"  width="10%"><?php echo  $ad->code; ?></td>
											<td class="content_td"><a href="<?php echo $ad->content; ?>"><?php echo $ad->content; ?></a></td>
											<td class="text-center" width="15%"><i class="fa <?php echo $ad->icon; ?>"></i> <?php echo $ad->amount; ?></td>
											<td class="text-center" width="20%"><?php echo $ad->duration; ?></td>
											<td width="10%" ><a href="#<?php //echo $ad->url; ?>" onclick="clickLink('<?php echo $ad->content; ?>','<?php echo $ad->url; ?>');" class="btn btn-block btn-success">Promote</a></td>
										</tr> 
									<?php endforeach;?>
								<?php	endif;?>
							</tbody>
						</table>
					</div><!-- /.box-body -->
				</div>
			</div><!-- /.col -->
		</div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
	function clickLink(pop_up,destination){
		var ads = window.open(pop_up);
		window.location.href = destination;
	}
</script>