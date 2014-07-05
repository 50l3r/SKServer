
<div class="container-full">
  <div class="row">
    <div class="col-lg-12">
      	<h3><img class="valign-top" src="<?= avatar('avatar/'.$user->UsuarioNick)?>" alt="Avatar" height="45px"/> Permisos de <?= $user->UsuarioNick ?></h3>
      	<br />
      	<?php if(!empty($roles)){ ?>
      		<div class="row">
	      		<?php $row = (12 / count($roles)); ?>
			    <?php foreach($roles as $tipo => $croles){ ?>
			    		<div class="col-lg-<?= $row ?>">
				    		<h4><?= $tipo ?></h4>
				    		<div class="col-lg-12 roleBox">
			    				<?php foreach($croles as $categoria => $roles){ ?>
			    					<big class="roleTitle"><?= $categoria ?></big>
			    					<ul class="roles">
			    						<?php foreach($roles as $rol){ ?>
			    							<li>
							    				<div class="btn-group btn-auth">
							    					<?php if($rol->Acceso==1){$class= "success";}elseif($rol->Acceso==2){$class= "danger";} ?>

								    				<a class="btn btn-xs btn-<?= $class ?> btn-authInfo" >
								    					<?= $rol->RolDescripcion ?>
								    				</a>
		    				
		    										<?php if($tipo=="Usuario"){ ?>
								    					<a class="btn btn-inverse btn-xs htip delScope" data-user="<?= $user->UsuarioId ?>" data-role="<?= $rol->RolId ?>" title="Eliminar Permiso"><i class="fa fa-circle"></i></a>
								    				<?php } ?>	

								    				<?php if($tipo=="Usuario" && $rol->Acceso==2){ ?>
								    					<a class="btn btn-inverse btn-xs htip authScope" data-user="<?= $user->UsuarioId ?>" data-role="<?= $rol->RolId ?>" title="Activar Permiso"><i class="fa fa-check-circle"></i></a>
								    				<?php } ?>	

								    				<?php if($tipo=="Grupo" || ($tipo=="Usuario" && $rol->Acceso==1)){ ?>
								    					<a class="btn btn-inverse btn-xs htip banScope" data-user="<?= $user->UsuarioId ?>" data-role="<?= $rol->RolId ?>" title="Denegar Permiso"><i class="fa fa-exclamation-circle"></i></a>
								    				<?php } ?>	
							    				</div>
							    			</li>
			    						<?php } ?>
			    					</ul>
			    				<?php } ?>
			    			</div>
			    		</div>
			    <?php } ?>
		    </div>
	    <?php } ?>
	    
	    <div class="row">
	    	<?php foreach($droles as $tipo => $croles){ ?>
		    		<div class="col-lg-12">
			    		<h4><?= $tipo ?></h4>
			    		<div class="col-lg-12 roleBox">
		    				<?php foreach($croles as $categoria => $roles){ ?>
		    					<big class="roleTitle"><?= $categoria ?></big>
		    					<ul class="roles">
		    						<?php foreach($roles as $rol){ ?>
		    							<li>
						    				<div class="btn-group btn-auth">
							    				<a class="btn btn-xs btn-default btn-authInfo">
							    					<?= $rol->RolDescripcion ?>
							    				</a>

							    				<a class="btn btn-inverse btn-xs htip authScope" data-user="<?= $user->UsuarioId ?>" data-role="<?= $rol->RolId ?>" title="Permitir"><i class="fa fa-check-circle"></i></a>
							    				<a class="btn btn-inverse btn-xs htip banScope" data-user="<?= $user->UsuarioId ?>" data-role="<?= $rol->RolId ?>" title="Denegar"><i class="fa fa-exclamation-circle"></i></a>
						    				</div>
						    			</li>
		    						<?php } ?>
		    					</ul>
		    				<?php } ?>
		    			</div>
			    	</div>
			<?php } ?>   
	    </div>
    </div>
  </div>
</div>