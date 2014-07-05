<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
$CI =&get_instance();
$config['dominio']   = "http://".$_SERVER['SERVER_NAME'];



//***************************************************************************************************************
// CONFIGURACION BASICA
//***************************************************************************************************************

//////////////////////////////////////////////////////////////////////
//CONFIGURACION DEL SISTEMA
//////////////////////////////////////////////////////////////////////
$config['produccion'] = false; //¿Servidor de pruebas o produccion?

$config['marca']   = "SKServer Demo"; //Nombre de marca
$config['eslogan']   = "SKServer Demo, tu servidor minecraft de toda la vida."; //Eslogan del servidor
//////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////
//  CORREO
//////////////////////////////////////////////////////////////////////
$config['email_buzon'] = "info@skimdoo.com"; //Email de contacto
$config['email_mensajero'] = "noreply@skimdoo.com"; //Email de envío de correos

$config['parametros_correo'] = array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://in.mailjet.com',
  'smtp_port' => 465,
  'smtp_user' => '%%%REMPLAZAME%%%', //Usuario de Mailjet
  'smtp_pass' => '%%%REMPLAZAME%%%', //Clave de Mailjet
  'mailtype' => 'html',
);

//////////////////////////////////////////////////////////////////////
//  REGISTRO
//////////////////////////////////////////////////////////////////////
$config['reg_enable'] = true; //Habilitar registro
$config['forum_enable'] = false; //Habilitar sincronizacion de usuarios con phpbb3
$config['invit_enable'] = false; //Habilitar sistema de invitaciones
$config['online_mode'] = false; //Servidor Online/Offline
$config['invitaciones_default']   = 10; //Invitaciones disponibles para cada usuario

//////////////////////////////////////////////////////////////////////
//  SERVIDOR
//////////////////////////////////////////////////////////////////////
$config['server_ip'] = "skimdoo.com"; //Direccion ip o dominio del servidor
$config['server_version'] = "1.7.4"; //Versión del servidor
$config['server_port'] = 25565; //Puerto del servidor
$config['server_statcache'] = 300; //Actualización de estadisticas del servidor en segundos
//////////////////////////////////////////////////////////////////////
//  FORO
//////////////////////////////////////////////////////////////////////
if($config['produccion']===true){ //produccion
  $config['PHPBB-ROOT'] = '/home/www/skimdoo/foro/'; //Ruta absoluta del foro
  $config['PHPBB-PREFIX'] = "phpbb"; //Prefijo de tabla db foro
}else{ //pruebas
  $config['PHPBB-ROOT'] = "W:/Personal/workdir/Skimdoo/foro/"; //Ruta absoluta del foro
  $config['PHPBB-PREFIX'] = "phpbb"; //Prefijo de tabla db foro
}




//***************************************************************************************************************
// CONFIGURACION AVANZADA
//***************************************************************************************************************


//////////////////////////////////////////////////////////////////////
//  IMAGENES
//////////////////////////////////////////////////////////////////////
if($config['produccion']===true){ //produccion
    $config['imgrack_apath'] = "/home/www/skimdoo/img"; //Ruta absoluta de carpeta "img"
    $config['upload_path'] = "/home/www/skimdoo/img/uploads"; //Ruta absoluta de carpeta "img/uploads"
}else{ //pruebas
    $config['imgrack_apath'] = "W:/Personal/workdir/Skimdoo/img"; //Ruta absoluta de carpeta "img"
    $config['upload_path'] = "W:/Personal/workdir/Skimdoo/img/uploads"; //Ruta absoluta de carpeta "img/uploads"
}

//////////////////////////////////////////////////////////////////////
// REGLAS DE IMAGENES
//////////////////////////////////////////////////////////////////////
$config['img_config'] = array(
    'upload_path' => $config['upload_path'],
    'allowed_types' => 'jpg|png',
    'remove_spaces' => true,
    'encrypt_name'    => true
);

$config['img_config_avatar'] = array(
    'sext' => 'jpg',
    'width' => '200',
    'height' =>  '200',
    'allowed_types' => 'jpg|png|jpeg',
    'maxsize' => true
);

$config['img_config_gavatar'] = array(
    'sext' => 'jpg',
    'width' => '200',
    'height' =>  '200',
    'allowed_types' => 'jpg|png|jpeg',
    'maxsize' => true
);

//////////////////////////////////////////////////////////////////////
//  SEGURIDAD
/////////////////////////////////////////////////////////////////////
$config['linkigniter.enable_csrf_protection'] = TRUE;
$config['wlist'] = array('login','cron','avatar', 'salir');

//////////////////////////////////////////////////////////////////////
//  PAGINACION
/////////////////////////////////////////////////////////////////////
$config['ppage_users'] = 20; //Listado usuarios/pagina
$config['ppage_groups'] = 20; //Listado grupos/pagina
$config['ppage_invitaciones'] = 20; //Listado invitaciones/pagina


