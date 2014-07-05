<div class="popAction" id="popEdit">
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

		<br />

		<center><span id="MEmail" class="label"></span></center>

		<br />

		<?php if($CI->auth('delete.invis',true)){ ?>
      		<form id="FMDelInvi" class="hide" action="<?= base_url('eliminar-invitacion') ?>" method="post">
			 	<input type="hidden" name="InvitacionId" value="" />
			</form>
			<a href="#" class="btn btn-danger btn-block srlink advertise" style="margin-top: 5px;" data-scope="FMDelInvi">Borrar</a>
		<?php } ?>
	</div>
</div>

<?php if($CI->auth('add.invis',true)){ ?>
	<div class="popAction" id="popAdd">
		<div class="popBox">
			<div class="container">
				<form action="<?= base_url('crear-invitacion') ?>" method="post">
					<div class="row">
						<div class="visible-md visible-lg col-lg-6 col-md-6">
							<img class="img-responsive" src="<?= avatar('avatar/'.$this->usuario->UsuarioNick)?>" alt="Avatar" />
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h2 class="text-center">Invitar a un amigo</h2>
						</div>
					</div>

					<br />

					<div class="row">
						<div class="col-lg-12">
							<input type="text" class="form-control" name="InvitacionEmail" placeholder="Introduce su dirección de correo" maxlength="360" />

							<br />

							<a href="#" class="btn btn-success btn-block slink advertise" style="margin-top: 5px;"><i class="fa fa-gift"></i> Invitar</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<a href="#" class="btn btn-danger btn-block closePop">Cerrar</a>
	</div>
<?php } ?>

<div class="container-full">
  <div class="row">
    <div class="col-lg-12 col-md-12 visible-md visible-lg">
      <h2>
      	<i class="fa fa-gift"></i> Invitaciones 
      	<div class="btn-group pull-right ">
      		<a class="btn btn-<?= $ninvitaciones > 0 ? 'success' : 'warning' ?> visible-md visible-lg"><?= $ninvitaciones ?> restantes</a>
      		<a href="#" class="btn btn-inverse actionAdd visible-md visible-lg"><i class="fa fa-gift"></i> Invitar</a>
      	</div>
      </h2>
      <table class="table table-responsive table-hover table-middle">
	      <thead>
	      	<th width="60px">Referidor</th>
	      	<th>Estado</th>
	      	<th>Código</th>
	      	<th>Correo</th>
	      	<th>Fecha</th>
	      </thead>

	      <tbody>
	      	<?php $i = 0; ?>
	      	<?php foreach($invitaciones as $invitacion){$i++; ?>
		      	<tr>
			      	<td class="center"><img src="<?= avatar('avatar/'.$invitacion->UsuarioNick) ?>" alt="<?= $invitacion->UsuarioNick ?> Avatar" height="40px" /></td>
			      	<td>
			      		<?php
			      			switch($invitacion->InvitacionEstado){
			      				case 1:
			      					$estado = "Usada";
			      					$cestado = "danger";
			      				break;

			      				case 2:
			      					$estado = "Caducada";
			      					$cestado = "warning";
			      				break;

			      				case 0:
			      					$estado = "Activa";
			      					$cestado = "success";
			      				break;

			      				default:
			      					$estado = "Desconocido";
			      					$cestado = "default";

			      			}
			      		?>
			      		<span class="label label-<?= $cestado?>"><?= $estado ?></span>
			      	</td>
			      	<td><input type="text" class="form-control input-sm" value="<?= $invitacion->InvitacionCode ?>" /></td>
			      	<td><?= $invitacion->InvitacionEmail ?></td>
			      	<td><?= $invitacion->InvitacionFecha ?></td>
			      	<td>
						<form id="fdel<?= $i ?>" class="hide" action="<?= base_url('eliminar-invitacion') ?>" method="post">
						 	<input type="hidden" name="InvitacionId" value="<?= $invitacion->InvitacionId ?>" />
						</form>
						<?php if($CI->auth('delete.invis',true) && $invitacion->InvitacionEstado == 0){ ?><a href="#" class="btn btn-xs btn-danger srlink advertise" data-scope="fdel<?= $i ?>">Eliminar</a><?php } ?>
			      	</td>
		      	</tr>
	      	<?php } ?>
	      </tbody>
      </table>

      <center><?php echo $this->pagination->create_links(); ?></center>
    </div>

    <div class="col-sm-12 col-xs-12 visible-xs visible-sm">
      <h5><i class="fa fa-gift"></i> Invitaciones</h5>
  
      <?php foreach($invitaciones as $invitacion){$i++; ?>
      	<?php
  			switch($invitacion->InvitacionEstado){
  				case 1:
  					$estado = "Usada";
  					$cestado = "danger";
  				break;

  				case 2:
  					$estado = "Caducada";
  					$cestado = "warning";
  				break;

  				case 0:
  					$estado = "Activa";
  					$cestado = "success";
  				break;

  				default:
  					$estado = "Desconocido";
  					$cestado = "default";

  			}
  		?>
  		<div class="row">
	  		<div class="col-sm-12 col-xs-12 nopadside text-center">
	  			<a href="#" class="actionInvit btn btn-block btn-xs btn-<?= $cestado?>" style="margin-bottom:5px;" data-id="<?= $invitacion->InvitacionId ?>" data-nick="<?= $invitacion->UsuarioNick ?>" data-status="<?= $invitacion->InvitacionEstado ?>" data-mail="<?= $invitacion->InvitacionEmail ?>"><?= $invitacion->InvitacionEmail ?></a>
	  		</div>
  		</div>
      <?php } ?>

      <div class="row text-center">
      	<?php echo $this->pagination->create_links(); ?>
      	<div class="btn-group col-xs-12 col-sm-12 nopadside">
      		<a class="btn btn-<?= $ninvitaciones > 0 ? 'success' : 'warning' ?> col-xs-6 col-sm-6"><?= $ninvitaciones ?> restantes</a>
      		<a href="#" class="btn btn-inverse col-sm-6 col-xs-6 actionAdd visible-sm visible-xs"><i class="fa fa-gift"></i> Invitar</a>
      	</div>
      </div>
    </div>
  </div>
</div>