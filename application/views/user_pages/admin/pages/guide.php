<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User Guide
            <small>by administrator</small>
          </h1>
          <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-question-circle"></i> Guide</a></li>
          </ol>
        </section>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box-group" id="accordion">
						<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
										What is Als Solution?
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in">
								<div class="box-body">
									<p>
										It is an application that specialize promotion of other website via clicking advertisements.
										This application was created by only 1 developer who is bored of his life (Yeah, I'm serious). 
										</br></br>
										<b>Benefits</b>
										</br>
										There is always a Benefit  becoming member on this website. 
										</br>
										The following mention below are benefits that you will acquire in this website :
										</br>
										1. You can earn money or points in this website via promoting or mining advertisements. 
										You can also earn points from referral which will be use in buying available items from us.
										</br>	</br>	
										A. What is <b>promoting advertisement</b>? </br>
										- Promotion of advertisement is a one way for you to earn.</br>
										- You click the button promote and earned from it.</br>
										B. What is <b>Mining Ads</b>? </br>
										- It is a feature where ads will automatically show in your browser.</br>
										- You may wonder if it is virus, which is not. </br>
										<b class="text-red" >WARNING : Do not follow or download anything from the ads that appearead. You just need to close it.</b>
										</br></br>
										2. You can acquire items(Not yet implemented). 
											</br>
											> As a developer, I will be gladly to give you reward items, if the daily performance which you can see in the dashboard
											will increase. 
											</br>
											> Acquire items via contribution points. Meaning, items will be posted on the website.
											
											</br></br>
											This will be implemented if the condition in number 1 is fulfilled.
											</br>
										3. Announcement is also a benefit for you because I will only give good news.
											(Announcement can be seen in the dashboard)
									</p>
									<h3>Our Services</h3>
									<b>To Clients</b>
									<p>
										
										We advertise the website, sell items, and promote items of our clients to make it popular and earn from it.
									</p>
									<b>To Members</b>
									<p>
										As a member who registered in this website, you are obliged to promote the advertisement that is provided by 
										the administrator (See the topic : Promotion). Members promotes the websites and earn contribution from it.
										The contribution you will receive will serves as a proof that you will be given the right to exchange it into money.
										(See the topic: Conversion of points)
										
									</p>
									<h3>Rules to be followed by members : </h3>
									<b> 1. Fill up your information correctly</b>
									</br>
									<p>
										Please!, fill up your information correctly because that is where your earnings and rewards go. 
									</p>
									<b> 2. Promote the website everyday</b>
									</br>
									<p>
										Promote the website to earn money and it is your obligation and we see your performance everyday. This will be no work no pay.
									</p>
									<b> 3. Hacking of user accounts</b>
									</br>
									<p>
										Do not attempt to acquire the password of the members. It is for your own good.
									</p>
									<b> 4. Do not cheat</b>
									</br>
									<p>
										There is no benefit in cheating. Your points won't grow up if you do that.
									</p>
								</div>
							</div>
						</div>
						<div class="panel box box-danger">
							<div class="box-header with-border">
							  <h4 class="box-title">
								 <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									Promotion
								 </a>
							  </h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="box-body">
									<b>How to promote?</b>
									<p>
									Promotion of advertisement is very simple in this site. Just follow the steps below.
									</br></br>
									
										<b>Steps:</b>
										</br>
										1. Login to website. After you login you can see the sidebar in the left side. 
										</br>
										2.	Then click the 'Click ads'. It will redirect you to the promotion page.
										</br>
										3. If you see a color green button called "Promote" then click it.
											Else, then there is nothing to promote.
										</br>	
											Note: The duration which is on the left side on the button is the time limit on when you can promote it again.
										</br></br>
										4. When you click the promote button, it will redirect you to the third party page.
											You must wait for 5 seconds and click skip ads.
										</br>
										5. After you click skip ads then it will go back to the Click ads page.
										</br>
										6. It will pop up a success message. And check your profile to see your points.
										</br>
									</p>
									</br></br>
									<b>How to mine advertisement?</b>
									<p>
									It is called mining because every advertisement that will popup will give you money.
									</br></br>
									
										<b>Steps:</b>
										</br>
										1. Login to website. After you login you can see the sidebar in the left side. 
										</br>
										2.	Then click the 'Mine ads'. It will redirect you to the mining page.
										</br>
										3. If you see a color green button called "Start" then click it.
										</br>	</br>
										The <span id="ads_shown" class="badge bg-light-blue">0</span> will indicate how many ads has been shown to you.</br>
										The <span id="credits" class="badge bg-red"> P 0</span> will indicate how much you earn from mining.
										
										</br></br>
										<b class="text-red">Note: You can stop the mining if you click the "Stop" button or close the tab or browser.</b></br>
										
										
											
										</br></br>
									
									</p>
								</div>
							</div>
						</div>
						<div class="panel box box-success">
							<div class="box-header with-border">
								<h4 class="box-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
										User Profile
									</a>
								</h4>
							</div>
							<div id="collapseFour" class="panel-collapse collapse">
								<div class="box-body">
									<b>What is User Profile?</b>
									<p>
										It is where the information you need will be shown. 
										</br></br>
										The information it will show are the following: 
										</br>
										<b>1. User Profile</b>
										</br> On the bottom left side, you can see a box called wallet.
										</br> That is where your money and points stored.
										</br>
										<b>2. Team</b>
										</br>
										 >> This will show the member that is under you.</br>
										 >> The member you referred will give 10% contribution points when they earned.
										</br>
										</br>
										<b>3. Withdrawal</b>
										</br>
										>> This will show your withdrawal of money.</br>
										>> Status : </br>
											Pending the money has not been send yet.</br>
											Approved the money has send and reference id will be filled up and where it was sent which is on the Peso Address.</br>											
										</br></br>
										<b>4. Deposit</b>
										</br>
										>> This is the list of contribution points you earn for every promotion you do.</br>
										</br>
										</br>
										<b>How to update profile?</b>
										</br>1. Login to website.
										</br>2. Click the settings on the sidebar which is located on the left side.
										</br>3. Click Update Account.
										</br>4. Fill up the necessary information.
											</br></br>
											<b>Note: </b>
											</br>In picture, can only use links that ends with .png,.jpeg and etc. 
											</br>Pictures will take effect if you relogin.
											</br>Phone number: you must not include the leading zero of your number. 
											</br>Example : 09123456789 -> +639123456789
											</br>
													
										</br>5. Click Submit.
									</p>
								</div>
							</div>
						</div>
						<div class="panel box box-default">
							<div class="box-header with-border">
								<h4 class="box-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
										Payments
									</a>
								</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse">
								<div class="box-body">
									<b>How do we pay?</b>
									<p>
										We pay you via coins.ph. The currency we used is PHP(Philippine money).</br></br>
										
										<b>Rules to remember when withdrawing of money :</b></br>
										1. Your account must be verified.</br>
										2. Correct peso address. We will not hold any responsibilites if you mistakenly input the wrong peso address.</br>
										3. You can only withdraw if you have a balance of P 1, 000.00. Meaning you can only withdraw it if your money will reach P 1,000.00.
										
										</br></br><b>Peso Address</b> </br>
										It is an electronic wallet made by coins.ph. This is where your money will be sent.</br>
										To have this wallet is you must register in this link : <a href="https://coins.ph/m/join/lyytsa" title="Register in coins.ph">Coins.ph</a></br>
										You need to provide valid ID in order to withdraw your money.
										</br></br><b style="color:red">
										We will not refund any withdrawal money if you made a mistakes of your peso address input.
										</b>
									</p>
								</div>
							</div>
						</div>
						<div class="panel box box-primary">
							<div class="box-header with-border">
								<h4 class="box-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFifth">
										Points 
									</a>
								</h4>
							</div>
							<div id="collapseFifth" class="panel-collapse collapse">
								<div class="box-body">
									<b>What is the use of points?</b>
									<p>
										The points you earned will be a ticket to buy items from us.
									</p>
								</div>
							</div>
						</div>
						<div class="panel box box-warning ">
							<div class="box-header with-border">
								<h4 class="box-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseSixth">
										Referral
									</a>
								</h4>
							</div>
							<div id="collapseSixth" class="panel-collapse collapse">
								<div class="box-body">
									<b>Invite your friends to earn more points</b>
									<p>
										In your profile, you can see a referral link.
										Copy the link and send it to your friends.</br></br>
										<b>Benefits</b>
										If the invited friend become a member, then you will receive
										10% of his/her points.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
