
	 <!-- JAVASCRIPT -->
	 <?php 	
			if(isset($javascript)):
				echo $javascript; 
			endif;
		?>
		
    <script>
      $(function () {
        $("[data-mask]").inputmask();
		  
		  $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });

		});
		</script>
  </body>
</html>
