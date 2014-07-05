<!DOCTYPE html>
<html lang="es">
  	<head>
	    <meta charset="utf-8">
	    <title><?= !empty($titulo) ? $this->config->item('marca')." | ".$titulo : $this->config->item('marca') ?></title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

	    <!-- Loading Bootstrap -->
		<link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />

	    <!-- Loading Flat UI -->
	    <link href="<?= base_url('css/flat-ui.css') ?>" rel="stylesheet" type="text/css" />
	    
	    <!-- Loading Font Awesome Icons and Favicon-->
	    <link rel="shortcut icon" href="<?= base_url('../img/recursos/icono.png') ?>">
	    <link href="<?= base_url('css/font-awesome.min.css') ?>" rel="stylesheet">

	    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	    <!--[if lt IE 9]>
	      <script src="<?= base_url('js/ie/html5shiv.js') ?>"></script>
	    <![endif]-->

	    <!-- RESOURCE AUTO -->
		<?php if(!empty($source)){ ?>
			<?php set_resources($source, "header"); ?>
		<?php } ?>
		<!-- RESOURCE AUTO END-->

		<?php set_resource_header("NOTIFY") ?>

		<!-- Loading Personal CSS -->
	    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet" type="text/css" />

		<!-- JQuery -->
		<script src="<?= base_url('js/jquery/jquery-1.8.3.min.js') ?>"></script>

	    <?php if(empty($nojs)){ ?>
			<noscript><meta http-equiv="refresh" content="0;url=<?= base_url('nojs') ?>" /></noscript>
		<?php }else{ ?>
			<script type="text/javascript">window.location.href="<?= base_url('inicio') ?>"</script>
		<?php } ?>

  	</head>

	<body>
		<?php if($CI->isOnline(true)){ ?>
		<nav class="navbar navbar-inverse navbar-fixed-top navbar-embossed" role="navigation">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
		        <span class="sr-only">Toggle navigation</span>
		      </button>
		      <a class="navbar-brand" href="<?= $this->config->item('dominio') ?>">
		      	<img src="<?= base_url('img/recursos/logo_sm.png') ?>" alt="Logo">
		      </a>
		    </div>

		    <div class="collapse navbar-collapse" id="navbar-collapse-01">
		      <ul class="nav navbar-nav navbar-left">
		      	<?php
				$menu = $this->config->item('menu_back');
				
				foreach ($menu as $item){ ?>
					<?php if($CI->auth($item['ItemScope'],true) || $item['ItemScope']==null){ ?>

						<?php 
							if(count($item['submenu']) > 0 ){
								$liclass= "dropdown ";
								$aclass="dropdown-toggle";
								$href = "#";
								$caret = "<b class='caret'></b>";
							}else{
								$liclass= "";
								$aclass="";
								if(strpos($item['ItemLink'], 'http') === 0){$href = $item['ItemLink'];}else{$href = base_url($item['ItemLink']);}
								$caret = "";
							} 

							$controller = strtolower(get_class($CI));
							if($controller==$item['ItemId']){$liclass.="active";}
						?>

	            		<li class="<?= $aclass." ".$item['ItemClass'] ?>">
	            			<a href="<?= $href ?>" class="<?= $aclass ?>" <?php if(count($item['submenu']) > 0 ){ ?>data-toggle="dropdown" <?php } ?>>
	            				<?= !empty($item['ItemIcon']) ? "<i class='fa ".$item['ItemIcon']."'></i>" : "" ?> <?= $item['ItemText'] ?> <?= $caret ?>
	            			</a>

	            			<?php if(count($item['submenu']) > 0 ){ ?><span class="dropdown-arrow"></span><ul class='dropdown-menu'><?php } ?>
		            			<?php foreach ($item['submenu'] as $submenu){ ?>
		            				<?php if($CI->auth($submenu['ItemScope'],true)){ ?>
				                  		<?php if(strpos($submenu['ItemLink'], 'http') === 0){$shref = $submenu['ItemLink'];}else{$shref = base_url($submenu['ItemLink']);} ?>
				                  		<li><a href='<?= $shref ?>'><?= !empty($submenu['ItemIcon']) ? "<i class='fa ".$submenu['ItemIcon']."'></i>" : "" ?> <?= $submenu['ItemText'] ?></a></li>
				                  	<?php } ?>
		            			<?php } ?>
	            			<?php if(count($item['submenu']) > 0 ){ ?></ul><?php } ?>
	            		</li>

	            	<?php } ?>
	       		<?php } ?>
		      </ul>

		      <ul class="nav navbar-nav navbar-right navbar-user">
		        <li class="dropdown user-dropdown hidden-sm hidden-xs">
		        	<img id="UserAvatar" src="<?= avatar('avatar/'.$this->usuario->UsuarioNick)?>" height="50px" alt="Avatar" />
			        <a href="#" class="inline dropdown-toggle" data-toggle="dropdown"> 
				        <?= $this->usuario->UsuarioNick ?> <b class="caret"></b>
			        </a>
			        <span class="dropdown-arrow"></span>
			        <ul class="dropdown-menu">
			            <!--<li><a href="#"><i class="fa fa-user"></i> Perfil</a></li>-->
			            <?php if($CI->auth("edit.myprofile",true)){ ?><li><a href="<?= base_url('usuario/'.$this->usuario->UsuarioNick) ?>"><i class="fa fa-gear"></i> Ajustes</a></li>
			            <li class="divider"></li><?php } ?>
			            <li><a href="<?= base_url('salir') ?>"><i class="fa fa-power-off"></i> Salir</a></li>
			        </ul>
			    </li>

			    <li class="dropdown user-dropdown hidden-md hidden-lg">
			        <a href="#" class="inline dropdown-toggle" data-toggle="dropdown"> 
			        	<i class="fa fa-user" style="color:#16a085"></i>
				        <?= $this->usuario->UsuarioNick ?> <b class="caret"></b>
			        </a>
			        <span class="dropdown-arrow"></span>
			        <ul class="dropdown-menu">
			            <!--<li><a href="#"><i class="fa fa-user"></i> Perfil</a></li>-->
			            <li><a href="<?= base_url('usuario/'.$this->usuario->UsuarioNick) ?>"><i class="fa fa-gear"></i> Ajustes</a></li>
			            <li class="divider"></li>
			            <li><a href="<?= base_url('salir') ?>"><i class="fa fa-power-off"></i> Salir</a></li>
			        </ul>
			    </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		</nav>

		<ol class="breadcrumb">
		  <?= $CI->breadcrumbs->makeBread() ?>
		</ol>
		<?php } ?>