<div class="container-fluid visible-lg visible-md">
	<div id="carrousel">
		<div id="title"><h2><?= $this->lang->line('registro_title') ?></h2></div>
		<img id="carSlide1" src="<?= base_url('img/recursos/headers/bgregistro.jpg') ?>" alt="Slider" />
	</div>
</div>

<div class="container-fluid header-fluid">
	<div class="container header-content">
		<p><?= $this->lang->line('registro_mensaje_invitacion') ?></p>
	</div>
</div>

<br />

<div class="container">
	<form id="FUser" method="post" action="<?= base_url('crear-usuario') ?>">
		<input type="hidden" name="UsuarioNick" value="" />
		<input type="hidden" name="InvitCode" value="" />
	</form>

	<div class="row">
		<div class="col-lg-12">
			<h3 class="text-center"><span id="checkStatusInvit"></span><?= $this->lang->line('registro_invitacion_code') ?></h3>
			<div class="input-group  input-group-lg">
				<input type="text" name="DInvitCode" class="form-control " placeholder="<?= $this->lang->line('registro_invitacion_ph_code') ?>" maxlength="150" <?= !empty($invitacion) ? "value='".$invitacion."'" : ""; ?> />
				<a href="#" id="check_invitcode" class="input-group-addon btn btn-info "><?= $this->lang->line('registro_invitacion_submit_verify') ?></a>
			</div>
		</div>
	</div>

	<br />

	<div class="row">
		<div class="col-lg-12">
			<i><?= $this->lang->line('registro_invitacion_by') ?> <span id="InvitFor"></span></i>
			<i id="InvitInfo" class="pull-right"><?= $this->lang->line('registro_invitacion_verify') ?></i>
		</div>
	</div>

	<br />

	<div class="row">
		<div class="col-lg-6">
			<div class="text-center">
				<img id="minecraft_avatar" class="img-response" src="<?= base_url('img/recursos/noavatar.jpg') ?>" alt="Minecraft Avatar" style="margin-top: 15px;" />
			</div>
		</div>

		<div class="col-lg-6 SignUp">
			<div class="visible-lg visible-md">
				<div id="SignUp-Lock">
					<h5><i><?= $this->lang->line('registro_invitacion_needcode') ?></i></h5>
					<img src="<?= base_url('img/recursos/skblock.png') ?>" alt="<?= $this->lang->line('registro_invitacion_needcode') ?>" />
				</div>
			</div>

			<h3 class="text-center"><span id="checkStatUser"></span><?= $this->lang->line('registro_user') ?></h3>
			
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<input type="text" name="DUsuarioNick" class="form-control input-lg" readonly placeholder="<?= $this->lang->line('registro_ph_usuario') ?>" maxlength="20" />
				</div>
			</div>
			
			<br />

			<a href="#" id="check_username" class="btn btn-default btn-block btn-lg"><?= $this->lang->line('registro_boton_submit') ?></a>
		
			<p class="pull-right"><?= $this->lang->line('registro_help1') ?> <a href="mailto:<?= $this->config->item('email_buzon') ?>"><b><?= $this->lang->line('registro_help2') ?></b></a></p>
		</div>
	</div>
</div>

<script src="<?= base_url('js/eventos/registro.js') ?>"></script>

<?php if(!empty($invitacion)){ ?>
<script>
	$(document).ready(function(){
		$("#check_invitcode").click();
	});
</script>
<?php } ?>

