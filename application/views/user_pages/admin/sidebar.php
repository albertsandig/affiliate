<!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo (!empty($this->session->userdata('profile_pic'))) ? $this->session->userdata('profile_pic') : base_url('/components/dist/img/avatar6.png'); ?>" onerror="this.src='<?php echo base_url('/components/dist/img/avatar6.png'); ?>';" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><a style="color:white;" href="<?php echo base_url()."admin/account"; ?>" > <?php echo (!empty($this->session->userdata('name'))) ? $this->session->userdata('name') : 'UNKNOWN'; ?> </a></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
         </div>

			<!-- Accout Menu -->
			<ul class="sidebar-menu">
				<li class="<?php echo (isset($dashboard)) ? $dashboard : ''; ?>" ><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-fw fa-area-chart"></i> <span>Dashboard</span></a></li>
				<li class="<?php echo (isset($menu_account)) ? $menu_account : ''; ?>" ><a href="<?php echo base_url('admin/account'); ?>"><i class="fa fa-fw fa-user-secret"></i> <span>Profile</span></a></li>
				<li class="treeview <?php echo (
						isset($menu_update_account) || 
						isset($menu_withdraw) || 
						isset($menu_converter) 
						) ? 'active' : ''; ?>">
					<a href="#">
						<i class="fa fa-gears"></i><span>Settings</span>
						<i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li class="<?php echo (isset($menu_update_account)) ? $menu_update_account : ''; ?>"><a href="<?php echo base_url().'admin/update'; ?>"><i class="fa fa-fw fa-circle-o"></i><span> Update Account</span></a></li>
						<?php if(access_level_view('USER_ACCESS')): ?>
							<li class="<?php echo (isset($menu_withdraw)) ? $menu_withdraw : ''; ?>"><a href="<?php echo base_url().'admin/withdraw'; ?>"><i class="fa fa-fw fa-circle-o"></i><span> Withdraw</span></a></li>
							<!-- <li class="<?php //echo (isset($menu_converter)) ? $menu_converter : ''; ?>"><a href="<?php echo base_url().'admin/converter'; ?>"><i class="fa fa-fw fa-circle-o"></i><span> Convertion</span></a></li> -->
						<?php endif; ?>
					</ul>
				</li>
				<li class="<?php echo (isset($guide)) ? $guide : ''; ?>" ><a href="<?php echo base_url('admin/guide'); ?>"><i class="fa fa-fw fa-question-circle"></i> <span>Guide</span></a></li>
			</ul>
			<?php if(access_level_view('USER_ACCESS')): ?>
				<!-- Sidebar Menu -->
				<ul class="sidebar-menu">
					<li class="header"><i class="fa fa-fw fa-suitcase"></i> Available Work</li>
					<!-- 
					<li class="<?php //echo (isset($menu_reward)) ? $menu_reward : ''; ?>" >
						<a href="<?php // echo module('reward'); ?>" ><i class="fa fa-fw fa-gift"></i> <span>Claim Reward</span></a>
					</li> -->
					<li class="<?php echo (isset($menu_clkAds)) ? $menu_clkAds: ''; ?>" >
						<a href="<?php echo module('ads'); ?>" ><i class="fa fa-fw fa-bullhorn"></i> <span>Click Ads</span></a>
					</li>
					<li class="<?php echo (isset($miner_ads)) ? $miner_ads: ''; ?>" >
						<a href="<?php echo module('ads','miner_ads'); ?>" ><i class="fa fa-fw fa-bolt"></i> <span>Miner Ads</span></a>
					</li>
					<!-- Optionally, you can add icons to the links -->
					<?php /* Not available yet ?>
					<li class="treeview <?php echo (
							isset($menu_quiz) || 
							isset($menu_survey_create) || 
							isset($menu_participate)
							) ? 'active' : ''; ?>">
						<a href="#"><i class="fa fa-book"></i> <span>Quiz</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="<?php echo (isset($menu_quiz)) ? $menu_quiz : ''; ?>" >
								<a href="<?php echo module('quiz'); ?>"><i class="fa fa-circle-o"></i>List of Questions</a>
							</li>
							<li class="<?php echo (isset($menu_quiz_create)) ? $menu_quiz_create : ''; ?>" >
								<a href="<?php echo module('quiz','create'); ?>"><i class="fa fa-circle-o"></i>Create Question</a>
							</li>
							<li class="<?php echo (isset($menu_participate)) ? $menu_participate : ''; ?>" >
								<a href="<?php echo module('quiz','participate'); ?>"><i class="fa fa-circle-o"></i>Participate Quiz</a>
							</li>
						</ul>
					</li>
					<?php */ ?>
				</ul><!-- /.sidebar-menu -->
			<?php endif; ?>
			<!-- Admin Menu -->
			<?php if(access_level_view('ADMIN_ACCESS')) : ?>
				<ul class="sidebar-menu">
					<li class="header"><i class="fa fa-fw fa-user-secret"></i> Admin</li>
					<!-- Optionally, you can add icons to the links -->
					
					<li class="treeview <?php echo (
							isset($user_payment_request) 
							) ? 'active' : '';  ?>">
						<a href="#"><i class="fa fa-money"></i> <span>Payments</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="<?php echo (isset($user_payment_request)) ? $user_payment_request : ''; ?>" >
								<a href="<?php echo base_url().'admin/payment_request'; ?>"><i class="fa fa-circle-o"></i>Request</a>
							</li>
						</ul>
					</li>
					<li class="treeview <?php echo (
							isset($menu_transaction_type) || 
							isset($menu_c_transaction_type) 
							) ? 'active' : ''; ?>">
						<a href="#"><i class="fa fa-fw fa-bullhorn"></i> <span>Advertisement</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="<?php echo (isset($menu_transaction_type)) ? $menu_transaction_type : ''; ?>"><a href="<?php echo base_url().'admin/mod/ads/list'; ?>"><i class="fa fa-fw fa-circle-o"></i><span> List</span></a></li>
							<li class="<?php echo (isset($menu_c_transaction_type)) ? $menu_c_transaction_type : ''; ?>"><a href="<?php echo base_url().'admin/mod/ads/create'; ?>"><i class="fa fa-fw fa-circle-o"></i><span> Add</span></a></li>
						</ul>
					</li>
					<li class="treeview <?php echo (
							isset($menu_raffle) ||
							isset($menu_raffle_create) 
							) ? 'active' : ''; ?>">
						<a href="#"><i class="fa fa-fw fa-ticket"></i> <span>Raffle</span> <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li class="<?php echo (isset($menu_raffle)) ? $menu_raffle : ''; ?>"><a href="<?php echo base_url().'admin/mod/raffle/list'; ?>"><i class="fa fa-fw fa-circle-o"></i><span> List</span></a></li>
							<li class="<?php echo (isset($menu_raffle_create)) ? $menu_raffle_create : ''; ?>"><a href="<?php echo base_url().'admin/mod/raffle/create'; ?>"><i class="fa fa-fw fa-circle-o"></i><span> Add</span></a></li>
						</ul>
					</li>
				</ul><!-- /.sidebar-menu -->
			<?php endif; ?>
        </section>
        <!-- /.sidebar -->
      </aside>