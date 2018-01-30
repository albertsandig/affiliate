		<!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Follow our page <a href="http://bc.vc/hKdu7QI" >Eshitify</a>.</strong> 
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
	 <!-- Javascript -->      

     <?php 	
			if(isset($javascript)):
				echo $javascript; 
			endif;
		?>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
		<?php if (isset($menu_quiz_create)) {?>
		<script>
			$(function () {
			  CKEDITOR.replace('editor1', {
				 height: '275px',
				 resize_enabled: false
			} );
			});
		</script>
		<?php } ?>
		<?php if (isset($menu_update_account)) {?>
		<script>
      $(function () {
        $("[data-mask]").inputmask();
		});
		</script>
		<?php } ?>
		<?php if (!isset($menu_adBlock)) {?>
		<script>
			 if( window.canRunAds === undefined ){
			  window.location.href = "<?php echo base_url(); ?>admin/error";
			}
		</script>
		<?php } ?>
		<?php if (isset($menu_reward)) {?>
			<script>
				//setInterval("timer('<?php //echo $rtp; ?>','id_point')", 1000);
				//setInterval("timer('<?php //echo $rtm; ?>','id_money')", 1000);
			</script>
		<?php } ?>
		<?php if (isset($dashboard)) {?>
		<script>
			load_overall_contribution_chart('<?php echo base_url(); ?>');
			load_user_contribution_chart('<?php echo base_url(); ?>');
		</script>
		<?php } ?>
		
		<?php 
		if (isset($menu_c_transaction_type) || isset($menu_raffle_create)) {?>
		<script>
			$(function () {
				  CKEDITOR.replace('editor1', {
					 height: '250px',
					 resize_enabled: false
				} );
			});
		</script>
		<?php } ?>
		<?php if (isset($menu_account)) {?>
		<script>
			/*
			var test = document.getElementById("referralLink");
			var bcvc=require("bc.vc")("b22429d79b7b267d62ec628365517bd0","235882"); // You will find your API key in Tools section.
			// var bcvc=require("bc.vc")(); still works but you won't earn money
			 
			bcvc.short('https://alsolution.000webhostapp.com/',function(url){
				 console.log("Short URL is: "+url);
			});
			*/
		</script>
		<?php } ?>
  </body>
</html>
