<!DOCTYPE html>
<html lang="es">
  	<head>
	    <meta charset="utf-8">
	    <title><?= !empty($titulo) ? $this->config->item('marca')." | ".$titulo : $this->config->item('marca') ?></title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

	    <!-- Loading Bootstrap -->
		<link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />

	    <!-- Loading Flat UI -->
	    <!--<link href="<?= base_url('css/flat-ui.css') ?>" rel="stylesheet" type="text/css" />-->
	    
	    <!-- Loading Less Flat UI -->
		<link rel="stylesheet/less" type="text/css" href="<?= base_url('less/flat-ui.less') ?>" />
		<script src="<?= base_url('js/less-1.6.3.min.js') ?>"></script>		

	    <!-- Loading Font Awesome Icons and Favicon-->
	    <link rel="shortcut icon" href="<?= base_url('img/recursos/icono.png') ?>">
	    <link href="<?= base_url('css/font-awesome.min.css') ?>" rel="stylesheet">

	    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	    <!--[if lt IE 9]>
	      <script src="<?= base_url('js/ie/html5shiv.js') ?>"></script>
	    <![endif]-->

	    <!-- Loading Notifications -->
		<link href="<?= base_url('js/plugins/notifications/pines/jquery.pnotify.default.css') ?>" rel="stylesheet" />

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
		<nav class="navbar navbar-inverse navbar-fixed-top navbar-embossed" role="navigation">
		    <a class="navbar-brand visible-sm visible-xs" href="<?= base_url('inicio') ?>">
	      		<img src="<?= base_url('img/recursos/logo_sm.png') ?>" alt="Logo">
	      	</a>

		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
		        <span class="sr-only">Toggle navigation</span>
		      </button>
		      
		    </div>

		    <div class="row">
				<div class="container">
				    <div class="collapse navbar-collapse" id="navbar-collapse-01">
					    <a class="navbar-brand visible-md visible-lg" href="<?= base_url('inicio') ?>">
				      		<img src="<?= base_url('img/recursos/logo_sm.png') ?>" alt="Logo">
				      	</a>

					    <ul class="nav navbar-nav navbar-right">
					      	<?php
							$menu = $this->config->item('menu_front');
							$controller = strtolower(get_class($CI));

							foreach ($menu as $item){ ?>
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

									if($controller==$item['ItemId']){$liclass.="active";}
								?>

			            		<li class="<?= $aclass ?>">
			            			<a href="<?= $href ?>" class="<?= $aclass ?>" <?php if(count($item['submenu']) > 0 ){ ?>data-toggle="dropdown" <?php } ?>>
			            				<?= !empty($item['ItemIcon']) ? "<i class='fa ".$item['ItemIcon']."'></i>" : "" ?> <?= $item['ItemText'] ?> <?= $caret ?>
			            			</a>

			            			<?php if(count($item['submenu']) > 0 ){ ?><span class="dropdown-arrow"></span><ul class='dropdown-menu'><?php } ?>
				            			<?php foreach ($item['submenu'] as $submenu){ ?>
				            				<?php if(strpos($submenu['ItemLink'], 'http') === 0){$shref = $submenu['ItemLink'];}else{$shref = base_url($submenu['ItemLink']);} ?>
						                  	<li><a href='<?= $shref ?>'><?= !empty($submenu['ItemIcon']) ? "<i class='fa ".$submenu['ItemIcon']."'></i>" : "" ?> <?= $submenu['ItemText'] ?></a></li>
						            <?php } ?>
			            			<?php if(count($item['submenu']) > 0 ){ ?></ul><?php } ?>
			            		</li>
				       		<?php } ?>
					    </ul>
				    </div><!-- /.navbar-collapse -->
				</div>
			</div>
		</nav>