		
		<p>&nbsp;</p>

		<footer>
	      <div class="container">
	        <div class="row">

	        <!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
	        <!-- SI DE VERDAD VALORAS MI TRABAJO, NO MODIFIQUES ESTAS LÍNEAS. ES EL ÚNICO COBRO QUE TE VOY A HACER ;)-->
	        <!-- //////////////////////////////////////////////////////////////////////////////////////////////////// -->
	          	<div class="col-md-6">
		            <h3 class="footer-title">¿Que es <?= $this->config->item('marca') ?>?</h3>
		            <p><?= $this->config->item('marca') ?> es una comunidad minecraft basada en la plataforma <a href="https://github.com/50l3r/SKServer" target="_blank">SKServer</a> creada por <a href="http://twitter.com/50l3r" target="_blank">@50l3r</a>.</p>

		            <p class="pvl">
		              	<a href="https://twitter.com/50l3r" class="twitter-follow-button" data-show-count="false" data-lang="es" >Seguir a @50l3r</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		              	<iframe src="http://ghbtns.com/github-btn.html?user=50l3r&repo=SKServer&type=watch&count=true" allowtransparency="true" frameborder="0" scrolling="0" width="110" height="20"></iframe>
		            </p>
	          	</div>
	        <!-- FIN -->

	        <div class="col-md-4 col-md-offset-2">
	          	<h3 class="footer-title">Servidor</h3>
	          	<div class="row">
	          		<div class="col-md-4">
	          			<center>
		          			<?php if(!empty($server)){ ?>
				          		<img src="<?= base_url('img/recursos/grass.png') ?>" alt="Información del servidor" height="90px" />
				          	<?php }else{ ?>
				          	<img src="<?= base_url('img/recursos/tnt.png') ?>" alt="Información del servidor" height="90px" />
				          	<?php } ?>
			          	</center>
		          	</div>

	          		<div class="col-md-8">
		          		<b>Estado:</b> <?php if(!empty($server)){ ?><font style="color:green"><b>Online</b></font> (<?= $server['players']."/".$server['maxplayers'] ?>)<?php }else{ ?><font style="color:red"><b>Offline</b></font><?php } ?>
		          		<br />
		          		<b>Invitación: </b> <?php if($this->config->item('invit_enable')){ ?>Activado<?php }else{ ?>Desactivado<?php } ?>
		            	<br />
		          		<b>Versión: </b> <?php if(!empty($server)){ echo $server['version']; }else{echo "No disponible";} ?>
		          		<br />
		          		<b>Modo: </b> <?php if($this->config->item('online_mode')){ echo "Online"; }else{echo "Offline";} ?>
		          	</div>
		        </div>
	          </div>
	        </div>
	        <p>&nbsp;</p>
	      </div>
	    </footer>
	    

		<script src="<?= base_url('js/jquery/jquery-ui-1.10.3.custom.min.js') ?>"></script>
		<script src="<?= base_url('js/jquery/jquery.ui.touch-punch.min.js') ?>"></script>

		<script src="<?= base_url('js/plugins/bootstrap/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('js/plugins/bootstrap/bootstrap-select.js') ?>"></script>
		<script src="<?= base_url('js/plugins/bootstrap/bootstrap-switch.js') ?>"></script>
		
		<script src="<?= base_url('js/flat-ui/flatui-checkbox.js') ?>"></script>
		<script src="<?= base_url('js/flat-ui/flatui-radio.js') ?>"></script>

		<script src="<?= base_url('js/jquery/jquery.tagsinput.js') ?>"></script>
		<script src="<?= base_url('js/jquery/jquery.placeholder.js') ?>"></script>

		<script src="<?= base_url('js/plugins/carrousel/carrousel.js') ?>"></script>

		<script src="<?= base_url('js/application.js') ?>"></script>

		<script src="<?= base_url('js/custom.js') ?>"></script>
		
		<script src="<?= base_url('js/plugins/notifications/pines/jquery.pnotify.js') ?>"></script>
		<script>
			$.pnotify.defaults.styling = 'bootstrap';
			$.pnotify.defaults.history = false;
		</script>

		<?php 
	      $error = retrieve_error();
	      if(isset($error)){echo showNotify($error['mensaje'],$error['titulo']);} 
	    ?>

	</body>
</html>