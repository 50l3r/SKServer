		<?php /*
		<footer>
	      <div class="container">
	        <div class="row">
	          <div class="col-md-7">
	            <h3 class="footer-title">¿Que es <?= $this->config->item('marca') ?>?</h3>
	            <p>Do you like this freebie? Want to get more stuff like this?<br/>
	              Subscribe to designmodo news and updates to stay tuned on great designs.<br/>
	              Go to: <a href="http://designmodo.com/flat-free" target="_blank">designmodo.com/flat-free</a>
	            </p>

	            <p class="pvl">
	              <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://designmodo.com/flat-free/" data-text="Flat UI Free - PSD&amp;amp;HTML User Interface Kit" data-via="designmodo">Tweet</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	              <iframe src="http://ghbtns.com/github-btn.html?user=designmodo&repo=Flat-UI&type=watch&count=true" height="20" width="107" frameborder="0" scrolling="0" style="width:105px; height: 20px;" allowTransparency="true"></iframe>
	              <iframe src="http://ghbtns.com/github-btn.html?user=designmodo&repo=Flat-UI&type=fork&count=true" height="20" width="107" frameborder="0" scrolling="0" style="width:105px; height: 20px;" allowTransparency="true"></iframe>
	              <iframe src="http://ghbtns.com/github-btn.html?user=designmodo&type=follow&count=true" height="20" width="195" frameborder="0" scrolling="0" style="width:195px; height: 20px;" allowTransparency="true"></iframe>
	            </p>

	            <a class="footer-brand" href="http://designmodo.com" target="_blank">
	              <img src="images/footer/logo.png" alt="Designmodo.com" />
	            </a>
	          </div> <!-- /col-md-7 -->

	          <div class="col-md-5">
	            <div class="footer-banner">
	              <h3 class="footer-title">Get Flat UI Pro</h3>
	              <ul>
	                <li>Tons of Basic and Custom UI Elements</li>
	                <li>A Lot of Useful Samples</li>
	                <li>More Vector Icons and Glyphs</li>
	                <li>Pro Color Swatches</li>
	                <li>Bootstrap Based HTML/CSS/JS Layout</li>
	              </ul>
	              Go to: <a href="http://designmodo.com/flat" target="_blank">designmodo.com/flat</a>
	            </div>
	          </div>
	        </div>
	      </div>
	    </footer> */
	    ?>

		<script src="<?= base_url('js/jquery/jquery-ui-1.10.3.custom.min.js') ?>"></script>
		<script src="<?= base_url('js/jquery/jquery.ui.touch-punch.min.js') ?>"></script>

		<script src="<?= base_url('js/plugins/bootstrap/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('js/plugins/bootstrap/bootstrap-select.js') ?>"></script>
		<script src="<?= base_url('js/plugins/bootstrap/bootstrap-switch.js') ?>"></script>
		
		<script src="<?= base_url('js/flat-ui/flatui-checkbox.js') ?>"></script>
		<script src="<?= base_url('js/flat-ui/flatui-radio.js') ?>"></script>

		<script src="<?= base_url('js/jquery/jquery.tagsinput.js') ?>"></script>
		<script src="<?= base_url('js/jquery/jquery.placeholder.js') ?>"></script>

		<script src="<?= base_url('js/application.js') ?>"></script>

		<script src="<?= base_url('js/custom.js') ?>"></script>

		
		<!-- RESOURCE AUTO -->
		<?php if(!empty($source)){ ?>
			<?php set_resources($source,"footer"); ?>
		<?php } ?>
		
		<?php set_resource_footer("NOTIFY") ?>

		<?php 
	      $error = retrieve_error();
	      if(isset($error)){echo showNotify($error['mensaje'],$error['titulo']);} 
	    ?>

	</body>
</html>