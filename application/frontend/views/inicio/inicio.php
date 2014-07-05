<style type="text/css">
	<?php //$rel = rand(1,5); ?>
	body{background: url('css/img/bgs/sg3.png') repeat left top fixed;background-size: 512px 512px;}
</style>

<div class="container-fluid visible-lg visible-md">
	<div id="carrousel">
		<div id="minecraft_status">
			<div class="row">
				<div class="col-lg-2">

					<?php if(empty($server)){ ?><img src="<?= base_url('img/recursos/tnt.png') ?>" height="64px" /><?php }else{ ?><img src="<?= $server['favicon']?>" height="64px" /><?php } ?>
				</div>
				<div class="col-lg-10">
					<span class="pull-right players"><?= empty($server) ? '0/0' : $server['players']."/".$server['maxplayers'] ?></span>
					<?= empty($server) ? $this->config->item('marca')."<br />"."<font style='color:#aa0000'>No se puede conectar</font>" : nl2br($this->minecraftcolors->convertToHTML($server['motd_raw'])) ?>
				</div>
			</div>
		</div>
		<img id="carSlide1" src="<?= base_url('img/recursos/headers/bginicio.jpg') ?>" alt="Slider" />
	</div>
</div>

<div class="container-fluid marketing-fluid">
	<div class="container marketing-content">
		<div class="visible-md visible-lg">
			<img id="anim1" src="<?= base_url('img/recursos/egg.png')?>" class="anim" />
			<a href="<?= base_url('registro') ?>">
				<img id="anim3" src="<?= base_url('img/recursos/duck.png')?>" class="anim noshow htip" title="<span style='color:#30f4e2'>Únete en un <b>CUACK!!</b></span>" />
			</a>
			<img id="anim2" src="<?= base_url('img/recursos/poof.png')?>" class="anim noshow" />
		</div>
		<h6><?= $this->lang->line('inicio_titulo') ?></h6>
	</div>
</div>

<br />

<div class="container">
	<div class="row visible-sm visible-xs">
		<div class="col-lg-12">
			<a class="btn btn-success btn-block btn-lg" href="<?= base_url('registro') ?>" style="border-radius:5px 5px 0 0;">Registraté</a>
		</div>
	</div>	

	<div class="row">
		<div class="col-lg-12">
			<div class="marketing"><?= $this->lang->line('inicio_noticia') ?></div>
		</div>
	</div>

	<br />

	<div class="row">
		<div class="col-lg-3">
			<div class="widget">
				<div class="widget-body">
					<center><i class="fa <?= $this->lang->line('inicio_box1_icon') ?> fa-4x"></i></center>
					<h2><?= $this->lang->line('inicio_box1_title') ?></h2>
					<p><?= $this->lang->line('inicio_box1_desc') ?></p>
				</div>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="widget">
				<div class="widget-body">
					<center><i class="fa <?= $this->lang->line('inicio_box2_icon') ?> fa-4x"></i></center>
					<h2><?= $this->lang->line('inicio_box2_title') ?></h2>
					<p><?= $this->lang->line('inicio_box2_desc') ?></p>
				</div>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="widget">
				<div class="widget-body">
					<center><i class="fa <?= $this->lang->line('inicio_box3_icon') ?> fa-4x"></i></center>
					<h2><?= $this->lang->line('inicio_box3_title') ?></h2>
					<p><?= $this->lang->line('inicio_box3_desc') ?></p>
				</div>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="widget">
				<div class="widget-body">
					<center><i class="fa <?= $this->lang->line('inicio_box4_icon') ?> fa-4x"></i></center>
					<h2><?= $this->lang->line('inicio_box4_title') ?></h2>
					<p><?= $this->lang->line('inicio_box4_desc') ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<audio id="player" src="<?= base_url('img/sounds/chicker.ogg') ?>"></audio>

<script type="text/javascript">
	$(document).ready(function(){
		$("#anim1").hover(function(){
			$("#anim2").css("display","block");
			$("#anim1").fadeOut("fast",function(){
				$("#anim3").css("display","block");
				setTimeout(function(){
					//$("#anim2").fadeOut("slow");
					$("#anim2").css("display","none");
					document.getElementById('player').play();

					$("#anim3").mouseenter(function(){
						document.getElementById('player').play();
					})
				},600);
			})
		});
	});
</script>
			


