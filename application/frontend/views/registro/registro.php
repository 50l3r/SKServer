<div class="container-fluid visible-lg visible-md">
	<div id="carrousel">
		<div id="title"><h2><?= $this->lang->line('registro_title') ?></h2></div>
		<img id="carSlide1" src="<?= base_url('img/recursos/headers/bgregistro.jpg') ?>" alt="Slider" />
	</div>
</div>

<div class="container-fluid header-fluid">
	<div class="container header-content">
		<p><?= $this->lang->line('registro_mensaje_unlock') ?></p>
	</div>
</div>

<br />

<div class="container">
	<form id="FUser" method="post" action="<?= base_url('nuevo-usuario') ?>">
		<div class="row">
			<div class="col-lg-6">
				<center>
					<img class="img-responsive" src="<?= base_url('img/recursos/registro.png') ?>" alt="Minecraft Registro" style="margin-top: 15px;height:300px;" />
				</center>
			</div>

			<div class="col-lg-6 SignUp">

				<h3 class="text-center"><span id="checkStatUser"></span><?= $this->lang->line('registro_user') ?></h3>
				
				<div class="row">
					<div class="col-lg-12 col-xs-12">
						<input type="text" name="UsuarioCorreo" class="form-control input-lg" placeholder="<?= $this->lang->line('registro_ph_email') ?>" maxlength="360" />
					</div>
					<br />
					<div class="col-lg-12 col-xs-12">
						<input type="text" name="UsuarioNick" class="form-control input-lg" placeholder="<?= $this->lang->line('registro_ph_usuario') ?>" maxlength="20" />
					</div>
				</div>
				
				<br />

				<a href="#" id="check_username" class="btn btn-success btn-block btn-lg"><?= $this->lang->line('registro_boton_submit') ?></a>
			
				<p class="pull-right"><?= $this->lang->line('registro_help1') ?> <a href="mailto:<?= $this->config->item('email_buzon') ?>"><b><?= $this->lang->line('registro_help2') ?></b></a></p>
			</div>
		</div>

	</form>
</div>

<script src="<?= base_url('js/eventos/registro_unlock.js') ?>"></script>
