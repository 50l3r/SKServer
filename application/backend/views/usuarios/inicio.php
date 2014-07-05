<div class="popAction" id="PopEdit">
	<div class="popBox">
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<img class="user-avatar img-responsive" id="MAvatar" src="<?= base_url('img/recursos/noavatar.jpg') ?>">
			</div>

			<div class="col-sm-6 col-xs-6">
				<center>
					<h4 id="MTitle"></h4>
					<span id="MStatus" class="label"></span>
				</center>
			</div>
		</div>

			
		</center>

		<br />

		<?php if($CI->auth('edit.users',true)){ ?><a id="MEditUser" href="" class="btn btn-inverse btn-block">Editar</a><?php } ?>
	
		<?php if($CI->auth('manage.user.roles',true)){ ?>
			<a id="MPermUser" href="" class="btn btn-block btn-inverse">Permisos</a>
		<?php } ?>

		<?php if($CI->auth('lock.users',true)){ ?>
			<form id="FMStatUser" action="<?= base_url('cambiar-estado') ?>" method="post">
		  		<a rel="#" class="btn btn-block slink advertise" style="margin-top: 5px;"></a>
		  		<input type="hidden" name="UsuarioId" value="" />
		  	</form>
		<?php } ?>

		<?php if($CI->auth('delete.users',true)){ ?>
      		<form id="FMDelUser" class="hide" action="<?= base_url('eliminar-usuario') ?>" method="post">
			 	<input type="hidden" name="UsuarioId" value="" />
			</form>
			<a href="#" class="btn btn-danger btn-block srlink advertise" style="margin-top: 5px;" data-scope="fmob">Borrar</a>
		<?php } ?>


	</div>
</div>

<div class="container-full">
  <div class="row">
    <div class="col-lg-12 col-md-12 visible-md visible-lg">
      <h2><i class="fa fa-users"></i> Usuarios</h2>
      <table class="table table-responsive table-hover table-middle">
	      <thead>
	      	<th width="60px"></th>
	      	<th>Estado</th>
	      	<th>Nick</th>
	      	<th>Nombre</th>
	      	<th>Grupo</th>
	      	<th>Email</th>
	      	<th>Ultima Conexión</th>
	      	<th>Ultima Ip</th>
	      	<th>Acciones</th>
	      </thead>

	      <tbody>
	      	<?php $i = 0; ?>
	      	<?php foreach($usuarios as $usuario){$i++; ?>
		      	<tr>
			      	<td class="center"><img src="<?= avatar('avatar/'.$usuario->UsuarioNick) ?>" alt="<?= $usuario->UsuarioNick ?> Avatar" height="40px" /></td>
			      	<td>
			      		<?php
			      			switch($usuario->UsuarioEstado){
			      				case 1:
			      					$estado = "Activo";
			      					$cestado = "success";
			      				break;

			      				case 2:
			      					$estado = "Bloqueado";
			      					$cestado = "danger";
			      				break;

			      				case 0:
			      					$estado = "Inactivo";
			      					$cestado = "inverse";
			      				break;

			      				default:
			      					$estado = "Desconocido";
			      					$cestado = "default";

			      			}
			      		?>
			      		<span class="label label-<?= $cestado?>"><?= $estado ?></span>
			      	</td>
			      	<td><?= $usuario->UsuarioNick ?></td>
			      	<td><?= $usuario->UsuarioNombre ?></td>
			      	<td><?= $usuario->GrupoNombre ?></td>
			      	<td><?= $usuario->UsuarioCorreo ?></td>
			      	<td><span class="tip hand" title="<?= $usuario->UsuarioFecha ?>"><?= ucfirst(moment($usuario->UsuarioFecha)) ?></span></td>
			      	<td><small><?= $usuario->UsuarioIp ?></small></td>
			      	<td>
			      		<?php if($usuario->UsuarioId!=$this->usuario->UsuarioId){ ?>
			      			<?php if($CI->compareRoles($usuario)){ ?>
								
								<form action="<?= base_url('cambiar-estado') ?>" method="post">
						      		<div class="btn-group">
									  <?php if($CI->auth('edit.users',true)){ ?><a href="<?= base_url('usuario/'.$usuario->UsuarioNick) ?>" class="btn btn-xs btn-inverse">Editar</a><?php } ?>
									  <?php if($CI->auth('manage.user.roles',true)){ ?><a href="<?= base_url('permisos-usuario/'.$usuario->UsuarioNick) ?>" class="btn btn-xs btn-inverse">Permisos</a><?php } ?>
									  <?php if($CI->auth('lock.users',true)){ ?>
									  <a rel="#" class="btn btn-xs btn-<?= $usuario->UsuarioEstado == 2 ? "danger" : "warning" ?> slink advertise">
									  	<?= $usuario->UsuarioEstado == 2 ? "Desbloquear" : "Bloquear" ?>
									  </a>
									  <?php } ?>
									  <?php if($CI->auth('delete.users',true)){ ?><a href="#" class="btn btn-xs btn-danger srlink advertise" data-scope="fdel<?= $i ?>">Borrar</a><?php } ?>
									</div>
									<input type="hidden" name="UsuarioId" value="<?= $usuario->UsuarioId ?>" />
								</form>
							
								<?php if($CI->auth('delete.users',true)){ ?>
						      		<form id="fdel<?= $i ?>" class="hide" action="<?= base_url('eliminar-usuario') ?>" method="post">
									 	<input type="hidden" name="UsuarioId" value="<?= $usuario->UsuarioId ?>" />
									</form>
								<?php } ?>
							<?php } ?>
						<?php }else{ ?>
							<div class="btn-group">
								<?php if($CI->auth('edit.users',true)){ ?><a href="<?= base_url('usuario/'.$usuario->UsuarioNick) ?>" class="btn btn-xs btn-inverse">Editar</a><?php } ?>
								<?php if($CI->auth('manage.user.roles',true)){ ?><a href="<?= base_url('permisos-usuario/'.$usuario->UsuarioNick) ?>" class="btn btn-xs btn-inverse">Permisos</a><?php } ?>
							</div>
						<?php } ?>
			      	</td>
		      	</tr>
	      	<?php } ?>
	      </tbody>
      </table>

      <center><?php echo $this->pagination->create_links(); ?></center>
    </div>

    <div class="col-sm-12 col-xs-12 visible-xs visible-sm">
      <h5><i class="fa fa-users"></i> Usuarios</h5>
      <div class="row">
	      <?php foreach($usuarios as $usuario){$i++; ?>
	  		<div class="col-sm-3 col-xs-3 nopadleft">
	  			<a href="#" class="actionUser" data-id="<?= $usuario->UsuarioId ?>" data-nick="<?= $usuario->UsuarioNick ?>" data-status="<?= $usuario->UsuarioEstado ?>">
	  				<img class="img-responsive user-avatar" src="<?= avatar('avatar/'.$usuario->UsuarioNick) ?>" alt="<?= $usuario->UsuarioNick ?> Avatar" />
	  				<small><b><?= strlen($usuario->UsuarioNick)>7 ? substr($usuario->UsuarioNick,0,5).".." : $usuario->UsuarioNick ?></b></small>
	  			</a>
	  		</div>
	      <?php } ?>
      </div>
    </div>
  </div>
</div>