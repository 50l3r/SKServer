<?php $CI =& get_instance();

//CORREO
	//ALTA USUARIO
	$lang['correo_altaus_placeholder'] = "Te enviamos este correo por que te has dado de alta en ".$CI->config->item('marca');
	$lang['correo_altaus_hi'] = "Que hay";
			$lang['correo_altaus_desc'] = "Gracias por empezar a formar parte de nuestra comunidad, estamos seguros de que pasarás buenos momentos jugando con nosotros. A continuación te ofrecemos los datos que nos facilitaste:";
	$lang['correo_altaus_user'] = "Usuario:";
	$lang['correo_altaus_key'] = "Clave:";
	$lang['correo_altaus_subject'] = "Tu nuevo Usuario";

	//ALTA USUARIO
	$lang['correo_invius_placeholder'] = "Te enviamos este correo por que te han invitado a ".$CI->config->item('marca');
	$lang['correo_invius_hi'] = "Hola desconocido :)";
			$lang['correo_invius_desc'] = "Un amigo te ha invitado a conocer ".$CI->config->item('marca'). ". Para poder crearte una cuenta y empezar a picar necesitas acceder al enlace que te ofrecemos a continuación:";
	$lang['correo_invius_link'] = "Enlace:";
	$lang['correo_invius_key'] = "Código:";
	$lang['correo_invius_subject'] = "Invitacion a ".$CI->config->item('marca');