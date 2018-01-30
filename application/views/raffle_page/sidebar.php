<div class="col-md-4">
	<section class="content">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Raffle Prizes</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body"  style="min-height:300px;max-height:300px;overflow-y: auto;">
				<ul class="products-list product-list-in-box">
					<?php if(isset($raffles)): ?>
						<?php if(!empty($raffles)): ?>
							<?php foreach($raffles as $raffle): ?>
								<li class="item">
									<div class="product-img">
										<img src="<?php echo $raffle->image; ?>" alt="Product Image">
									</div>
									<div class="product-info">
										<a href="<?php echo base_url('raffle/view/'.$raffle->raffle_id); ?>" class="product-title"><?php echo $raffle->title; ?>
											<span class="label label-success pull-right"><i class="fa fa-fw fa-trophy"></i> <?php echo $raffle->max_winner; ?></span></a>
										<span class="product-description">
												<?php echo $raffle->description; ?>
										</span>
									</div>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-center"></div>
			<!-- /.box-footer -->
		</div>
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Raffle Draws</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body" style="min-height:300px;max-height:300px;overflow-y: auto;">
				<ul class="products-list product-list-in-box">
					<?php if(isset($ended_raffles)): ?>
						<?php if(!empty($ended_raffles)): ?>
							<?php foreach($ended_raffles as $raffle): ?>
								<li class="item">
									<div class="product-img">
										<img src="<?php echo $raffle->image; ?>" alt="Product Image">
									</div>
									<div class="product-info">
										<a href="<?php echo base_url('raffle/view/'.$raffle->raffle_id); ?>" class="product-title"><?php echo $raffle->title; ?>
											<span class="label label-success pull-right"><i class="fa fa-fw fa-trophy"></i> <?php echo $raffle->max_winner; ?></span></a>
										<span class="product-description">
												<?php echo $raffle->description; ?>
										</span>
									</div>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endif; ?>
				</ul>
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-center"></div>
			<!-- /.box-footer -->
		</div>
	</section>
</div>