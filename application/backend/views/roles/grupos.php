

<div class="container-full">
  <div class="row">
    <div class="col-lg-12">
      	<h3><img class="valign-top" src="<?= avatar('gavatar/'.$grupo->GrupoId)?>" alt="Avatar" height="45px"/> Permisos de <?= $grupo->GrupoNombre ?></h3>
      	<br />
      	<?php if(!empty($roles)){ ?>
      		<div class="row">
	    		<div class="col-lg-12">
		    		<div class="col-lg-12 roleBox">
	    				<?php foreach($roles as $categoria => $roles){ ?>
	    					<big class="roleTitle"><?= $categoria ?></big>
	    					<ul class="roles">
	    						<?php foreach($roles as $rol){ ?>
	    							<li>
					    				<div class="btn-group btn-auth">
						    				<a class="btn btn-xs btn-success btn-authInfo" >
						    					<?= $rol->RolDescripcion ?>
						    				</a>
    				
						    				<a class="btn btn-inverse btn-xs htip delGScope" data-group="<?= $grupo->GrupoId ?>" data-role="<?= $rol->RolId ?>" title="Eliminar Permiso"><i class="fa fa-circle"></i></a>
					    				</div>
					    			</li>
	    						<?php } ?>
	    					</ul>
	    				<?php } ?>
	    			</div>
	    		</div>
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

							    				<a class="btn btn-inverse btn-xs htip authGScope" data-group="<?= $grupo->GrupoId ?>" data-role="<?= $rol->RolId ?>" title="Permitir"><i class="fa fa-check-circle"></i></a>
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