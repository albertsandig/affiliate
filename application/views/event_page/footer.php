
    <footer class="footer text-center">
        <div class="container">
            <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can check out other license options via our website: themes.3rdwavemedia.com */-->
				<small class="copyright">Copyright © 2017  <a href="http://themes.3rdwavemedia.com/" target="_blank">Al's Solutions</a> </small>
            
            
        </div><!--//container-->
    </footer>
     
    <!-- Javascript -->          
     <?php 	
			if(isset($javascript)):
				echo $javascript; 
			endif;
		?>
		
		<script>
      $(function () {
        $("[data-mask]").inputmask();
      });
    </script>
		
</script>
</body>
</html> 