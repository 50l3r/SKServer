<?php

$CI =& get_instance();
if($CI->config->item('online_mode')){$Mode = "Online";}else{$Mode = "Offline";}
if($CI->config->item('invitaciones_default')){$Invitaciones = "Activas";}else{$Invitaciones = "Desactivadas";}

//INICIO
$lang['inicio_titulo'] = $CI->config->item('marca').", tu servidor minecraft realizado con SKServer";
$lang['inicio_noticia'] = 'Estamos en fase de pruebas. Actualmente no tenemos ningun servicio operativo. Servidor, foro y web permaneceran en desarrollo hasta previo avio. Mas info en <a href="http://twitter.com/50l3r" target="_blank"><b>@50l3r</b></a>';

$lang['inicio_box1_icon'] = "fa-laptop";
$lang['inicio_box1_title'] = "Datos del servidor";
$lang['inicio_box1_desc'] = "<b>IP:</b> ".$CI->config->item('server_ip').":".$CI->config->item('server_port')."<br /><b>Versión:</b> ".$CI->config->item('server_version')."<br /><b>Modo:</b> ".$Mode."<br /><b>Invitaciones:</b> ".$Invitaciones;

$lang['inicio_box2_icon'] = "fa-bitbucket";
$lang['inicio_box2_title'] = "Crea tu perfil minecraft";
$lang['inicio_box2_desc'] = "Elige un nombre de usuario y rellena tus datos personales. Estos datos serán los que despues utilices a la hora de entrar a jugar en el servidor.";

$lang['inicio_box3_icon'] = "fa-users";
$lang['inicio_box3_title'] = "Avisa a tus amigos";
$lang['inicio_box3_desc'] = "Sabemos que el boca a boca es esencial y como no, cuantos más mejor. Trae a tus amigos a que conozcan ".$CI->config->item('marca');

$lang['inicio_box4_icon'] = "fa-rocket";
$lang['inicio_box4_title'] = "Despega tu creatividad";
$lang['inicio_box4_desc'] = "Construye, sobrevive y socializa con otras personas del servidor. Poseemos años de experiencia en servidores minecraft.";

//REGISTRO
$lang['registro_title'] = "Nuevo Usuario";
$lang['registro_user'] = "Usuario";
$lang['registro_mensaje_invitacion'] = "Para poder registrarte en ".$CI->config->item('marca')." es necesaria una invitación por parte de algún usuario de la comunidad. Consigue tu código de invitación y empieza a picar cubos como loco.";
$lang['registro_mensaje_unlock'] = "Registraté en ".$CI->config->item('marca')." para poder acceder a toda la comunidad de minecraft que tenemos preparada para ti. Al crearte una nueva cuenta podrás acceder a todos los servicios que ofrecemos.";
$lang['registro_ph_email'] = "Tu direccion de correo";
$lang['registro_ph_usuario'] = "Tu usuario en Minecraft (ej: Notch)";
$lang['registro_boton_submit'] = "Crea a tu picador!";
$lang['registro_help1'] = "¿Algun problema?";
$lang['registro_help2'] = "Obten Ayuda";
$lang['registro_invitacion_needcode'] = "Introduce tu código de invitación primero";
$lang['registro_invitacion_verify'] = "Verifica tu código de invitación antes de registrarte";
$lang['registro_invitacion_by'] = "Invitado por:";


$lang['registro_invitacion_code'] = "Código de invitación";
$lang['registro_invitacion_ph_code'] = "Tu código de invitación";
$lang['registro_invitacion_submit_verify'] = "Verificar código";
?>