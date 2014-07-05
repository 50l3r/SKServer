<div class="popAction" id="popEdit">
	<div class="popBox">
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<img class="user-avatar img-responsive" id="MAvatar" src="<?= base_url('gavatar/0') ?>">
			</div>

			<div class="col-sm-6 col-xs-6">
				<center>
					<h4 id="MTitle"></h4>
				</center>
			</div>
		</div>

			
		</center>

		<br />

		<?php if($CI->auth('edit.groups',true)){ ?><a id="MEditGroup" href="" class="btn btn-inverse btn-block">Editar</a><?php } ?>
	
		<?php if($CI->auth('manage.group.roles',true)){ ?>
			<a id="MPermGroup" href="" class="btn btn-block btn-inverse">Permisos</a>
		<?php } ?>

		<?php if($CI->auth('delete.groups',true)){ ?>
			<form id="FMDelGroup" class="hide" action="<?= base_url('eliminar-grupo') ?>" method="post">
			 	<input type="hidden" name="GrupoId" value="" />
			</form>
			<a href="#" class="btn btn-danger btn-block srlink advertise" style="margin-top: 5px;" data-scope="FMDelGroup">Borrar</a>
		<?php } ?>
	</div>
</div>

<div class="container-full">
  <div class="row">
    <div class="col-lg-12 col-md-12 visible-md visible-lg">
      <h3><i class="fa fa-group"></i> Grupos</h3>
      <table class="table table-responsive table-hover table-middle">
	      <thead>
	      	<th width="60px"></th>
	      	<th>Nombre</th>
	      	<th>Descripcion</th>
	      	<th>Rango</th>
	      	<th>Usuarios</th>
	      	<th>Acciones</th>
	      </thead>

	      <tbody>
	      	<?php $i = 0; ?>
	      	<?php foreach($grupos as $grupo){$i++; ?>
		      	<tr>
			      	<td class="center"><img src="<?= avatar('gavatar/'.$grupo->GrupoId) ?>" alt="<?= $usuario->UsuarioNick ?> Avatar" height="40px" /></td>
			      	<td><?= $grupo->GrupoNombre ?></td>
			      	<td><?= $grupo->GrupoDescripcion ?></td>
			      	<td><?= $grupo->GrupoRango ?></td>
			      	<td><?= $grupo->Integrantes ?></td>
			      	<td>	
			      		<div class="btn-group">
						  <?php if($CI->auth('edit.groups',true)){ ?><a href="<?= base_url('grupo/'.$grupo->GrupoNombre) ?>" class="btn btn-xs btn-inverse">Editar</a><?php } ?>
						  <?php if($CI->auth('manage.group.roles',true)){ ?><a href="<?= base_url('permisos-grupo/'.$grupo->GrupoNombre) ?>" class="btn btn-xs btn-inverse">Permisos</a><?php } ?>

						  <?php if($CI->auth('delete.groups',true)){ ?><a href="#" class="btn btn-xs btn-danger srlink advertise" data-scope="fdel<?= $i ?>">Borrar</a><?php } ?>
						</div>
							
						<?php if($CI->auth('delete.groups',true)){ ?>
				      		<form id="fdel<?= $i ?>" class="hide" action="<?= base_url('eliminar-grupo') ?>" method="post">
							 	<input type="hidden" name="GrupoId" value="<?= $grupo->GrupoId ?>" />
							</form>
						<?php } ?>
			      	</td>
		      	</tr>
	      	<?php } ?>
	      </tbody>
      </table>

      <center><?php echo $this->pagination->create_links(); ?></center>
    </div>

    <div class="col-sm-12 col-xs-12 visible-xs visible-sm">
      <h5><i class="fa fa-group"></i> Grupos</h5>
      <div class="row">
	      <?php foreach($grupos as $grupo){$i++; ?>
	  		<div class="col-sm-3 col-xs-3 nopadleft">
	  			<a href="#" class="actionGroup" data-id="<?= $grupo->GrupoId ?>" data-nick="<?= $grupo->GrupoNombre ?>">
	  				<img class="img-responsive user-avatar" src="<?= avatar('gavatar/'.$grupo->GrupoId) ?>" alt="<?= $grupo->GrupoNombre ?> Avatar" />
	  				<small><b><?= strlen($grupo->GrupoNombre)>7 ? substr($grupo->GrupoNombre,0,5).".." : $grupo->GrupoNombre ?></b></small>
	  			</a>
	  		</div>
	      <?php } ?>
      </div>
    </div>
  </div>
</div>