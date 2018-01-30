				</div><!-- ./row -->
			</div><!-- ./wrapper -->
		</div><!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="container">
			<div class="pull-right hidden-xs">
				Powered by <b>Als Solution</b>
			</div>
			<strong>Follow our page <a href="http://bc.vc/hKdu7QI">Eshitify</a>.
			</div><!-- /.container -->
		</footer>
	</div>
	
	<!-- REQUIRED JS SCRIPTS -->
	<!-- Javascript -->      
	
		<?php 	
			if(isset($javascript)):
				echo $javascript; 
			endif;
		?>
		
		<?php if (!isset($menu_adBlock)) {?>
		<script>
			 if( window.canRunAds === undefined ){
			  window.location.href = "<?php echo base_url('error'); ?>";
			}
		</script>
		<?php } ?>
	</body>
</html>
