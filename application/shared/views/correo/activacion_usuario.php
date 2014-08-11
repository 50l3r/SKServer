<?php $CI =& get_instance(); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php echo  $this->config->item('marca') ?> - Tu nuevo Usuario</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<style type="text/css">
			a:link {
				color: #61c7dd;
			}
			a:hover {
				color: #59b8cc;
			}
		</style>
	</head>
	
	<body bgcolor="#161616" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td valign="top" bgcolor="#161616"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="font: 14px Helvetica, Arial, sans-serif; color: #767572; line-height: 100%;">
			  <tr>
				<td valign="top"><table width="600" height="204" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td style="height: 63px;"><table width="100%" border="0" cellspacing="0" cellpadding="10">
					  <tr>
						<td style="font-family: Helvetica, Arial, sans-serif; font-size: 11px; color: #808080; padding-top: 15px;"><?= $CI->lang->line('correo_actus_placeholder') ?></td>
					  </tr>
					</table></td>
					<td style="height: 56px;"><img src="<?php echo base_url('img/correo/arrow.gif') ?>" width="96" height="56" alt="" style="display: block;"></td>
				  </tr>
				  <tr>
					<td colspan="2" style="background-image: url('<?php echo base_url('img/correo/header_top_separator.gif') ?>'); background-repeat: no-repeat; height: 7px;"><img src="<?php echo base_url('img/correo/header_top_separator.gif') ?>" alt="" width="600" height="7" style="display: block;"/></td>
				  </tr>
				  <tr>
					<td valign="top" style="width: 504px; height: 125px;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="height: 125px;">
					  <tr>
						<td valign="top" bgcolor="#161616" style="height: 10px;">&nbsp;</td>
					  </tr>
					  <tr>
						<td valign="top" bgcolor="#161616" style="height: 50px; font-family: Helvetica, Arial, sans-serif; font-size: 55px; font-weight: bold; color: #f9f8f2; letter-spacing: -2px; line-height: 90%;"> <?php echo  $this->config->item('titulo') ?> </td>
					  </tr>
					  <tr>
						<td valign="top" bgcolor="#161616" style="height: 25px; font-family: Helvetica, Arial, sans-serif; font-size: 19px; font-weight: bold; color: #4e4e4e; letter-spacing: -2px;"><currentmonthname>
						  <currentyear>
						  <?php echo  $this->config->item('eslogan') ?></td>
					  </tr>
					</table></td>
					<td valign="top"><img src="<?php echo base_url('img/correo/badge-whats-new.png') ?>" width="96" height="125" alt=""></td>
				  </tr>
				  <tr>
					<td colspan="2" valign="top" style="height: 16px; background-image: url('<?php echo base_url('img/correo/header_border.gif') ?>); background-repeat: no-repeat;"><img src="<?php echo base_url('img/correo/header_border.gif') ?>" width="600" height="16"/></td>
				  </tr>
				</table></td>
			  </tr>
			  <tr>
				<td valign="top" bgcolor="#161616"><table width="100%" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td valign="top" style="height: 35px;">&nbsp;</td>
				  </tr>
				  <tr>
					<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td style="height: 30px;">&nbsp;</td>
					  </tr>
					  <tr>
						<td><img src="<?php echo base_url('img/correo/addUsuarioColor.jpg') ?>" width="600" height="269" alt="" style='border-radius:5px;' ></td>
					  </tr>
					  <tr>
						<td style="height: 30px;">&nbsp;</td>
					  </tr>
					  <tr>
						<td style="height: 30px;">&nbsp;</td>
					  </tr>
					  <tr>
						<td style="font-family: Helvetica, Arial, sans-serif; font-size: 30px; font-weight: bold; color: #767572; letter-spacing: -2px;">Saludos <?php echo strip_tags($UsuarioNick); ?> :)</td>
					  </tr>
					  <tr>
						<td style="height: 10px;">&nbsp;</td>
					  </tr>
					  <tr>
						<td style="font-family: Helvetica, Arial, sans-serif; color: #767572;">
							<p><?= $CI->lang->line('correo_actus_desc') ?></p>
							<center><a href="<?= $AUrl ?>"><?= $AUrl ?></a></center>
							<p><?= $CI->lang->line('correo_actus_desc2') ?></p>
							<p>
								<b><?= $CI->lang->line('correo_actus_user') ?> </b> <?= $UsuarioNick ?>
								<br />
								<b><?= $CI->lang->line('correo_actus_key') ?> </b> <?= $UsuarioClave ?>
							</p>
						</td>
					  </tr>
					  <tr>
						<td style="height: 40px;">&nbsp;</td>
					  </tr>
					</table></td>
				  </tr>
				</table></td>
				</tr>
			  <tr>
				<td>
					<table width="600" border="0" cellpadding="0" cellspacing="0" style="padding-top: 10px;">
						  <tr>
							<td colspan="6"><img src="<?php echo base_url('img/correo/footer_05.gif') ?>" width="599" height="25" alt=""></td>
							<td width="1" rowspan="3"><img src="<?php echo base_url('img/correo/footer_02.gif') ?>" width="1" height="140" alt=""></td>
						  </tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>