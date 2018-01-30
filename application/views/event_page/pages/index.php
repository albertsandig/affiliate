
    <div id="win_load" class="about-section">
			<div class="container text-center">
				<div class="row">
					<div class="col-md-12">
							<a  href="http://ho.lazada.com.ph/SHY5MB?file_id=97722" target="_blank">
								<img id="ads"  src="https://media.go2speed.org/brand/files/lazada/693/PH_LaborDayCampaign_990x100.jpg" width="990" height="100" border="0" />
							</a>
							<img src="http://ho.lazada.com.ph/aff_i?offer_id=693&file_id=97722&aff_id=210940&source=https://www.lazada.com.ph/" width="1" height="1" />
					</div>
				</div>
				</br>
            <h2 class="section-title">How to win P 10.00 peso load in our website?</h2>
				<p>
					Just Enter your 11 digit phone number.</br>
					Example: 
						09351234567 - TM
						09181234567 - SMART
				</p>
				</br></br>
				<p>
					<b>Note:</b></br>
						1. Input your own number because if you win, the number you've input will receive the reward and not you as the owner.</br>
						2. There will be at least 10 winners a week.</br>
						3. The winners will be posted in the facebook page that we manage,so follow and like our page 
							<a href="https://www.facebook.com/shitify2017/" target="_blank"><b>Eshity</b></a> </br> or
							in this website.</br>
						4. Your phone numbers will not be posted in public or use.</br>
						5. We will send you a message in your phone number if you won.</br>
				</p>
				</br></br>
				<?php if($this->session->flashdata('message')) { ?>
					<p style="font-size:20px;color:#279619;font-weight:bold;">
					<?php echo $this->session->flashdata('message'); ?>
					</p></br></br>
				<?php } ?>
				<div class="row">
					<div class="col-md-12">
						<a href="https://go.pub2srv.com/afu.php?id=1484925" target="_blank" >
						<h4 style="color:green;font-weight:bold">Number of Participant(s) : <?php echo $no_of_participants; ?></h4>
						</a>
						</br></br>
					</div>
					<div class="col-md-4 col-md-offset-4">
						<?php echo form_open('event/participate'); ?>
							<div class="form-group">
								<label>Philippine phone number:</label>
								<input name="event_no" type="hidden"	value="<?php echo $event_no; ?>" />
								<div class="input-group">
									<div class="input-group-addon">
									  <i class="fa fa-phone"></i>
									</div>
									<?php echo form_input(array('onclick'=>'link_onclick()','name'=>'mobile_number','type'=>'text','placeholder'=>'Mobile number','value'=>'09','data-inputmask'=>"'mask': '09999999999'",'class'=>'form-control','data-mask'=>'','required'=>'')); ?>
								</div>
							</div>
							<div class="form-group">
								<?php echo form_input(array('name'=>'name','type'=>'text','placeholder'=>'Owner','class'=>'form-control')); ?>
								
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-info" onclick="link_onclick();" />
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
				
				<h2 class="section-title">The result in our draw will happen every friday</h2>
				<p>
					The reward will be dependent on the number of participants we gather. </br>
					Invite your friends to increase the rewards. </br>
					
				</p>
				</br></br>
        </div><!--//container-->
    </div><!--//about-section-->