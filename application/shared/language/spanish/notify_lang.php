<?php $CI =& get_instance();

$ErrExpresion = array('Ups!','Caramba!', 'Caracoles!', 'Rayos y retruecanos!');
$DoneExpresion = array('Hecho!','Nice!', 'Genial!', 'Asombroso!');

$lang['msg_error'] = array(
	'001'		=>	array(
		'titulo' 	=>	'Usuario Inactivo',
		'mensaje'	=>	'El usuario no ha sido activado aún.'
	),
	'002'		=>	array(
		'titulo' 	=>	'Credenciales invalidas',
		'mensaje'	=>	'El usuario o clave no coinciden.'
	),
	'003'		=>	array(
		'titulo' 	=>	'Usuario Bloqueado',
		'mensaje'	=>	'El usuario se encuentra bloqueado.'
	),
	'004'		=>	array(
		'titulo' 	=> 	$ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 	'El nombre de usuario puede contener caracteres numericos, alfanumericos y "_".'
	),
	'005'		=>	array(
		'titulo' 	=>	$ErrExpresion[array_rand($ErrExpresion)],
		'mensaje'	=>	'Ese nombre ya existe.'
	),
	'006'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'El correo que intentas registrar ya existe.'
	),
	'007'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'Ocurrió un error inesperado. Contacte con un personal de soporte.'
	),
	'008'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'No se pudo subir la imagen. Aseguraté de que cumple con los requisitos que se informa.'
	),
	'009'		=>	array(
		'titulo' 	=> $DoneExpresion[array_rand($DoneExpresion)],
        'mensaje' 	=> 'Operacion ejecutada correctamente.'
	),
	'010'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'Asegurese de introducir los datos correctamente.'
	),
	'011'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'No puedes interactuar con tu propio perfil de esa manera.'
	),
	'012'		=>	array(
		'titulo' 	=> $DoneExpresion[array_rand($DoneExpresion)],
        'mensaje' 	=> 'Usuario eliminado correctamente.'
	),
	'013'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'El usuario no existe.'
	),
	'014'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'No puedes interactuar con un usuario con un rango superior o similar a ti.'
	),
	'015'		=>	array(
		'titulo' 	=> $DoneExpresion[array_rand($DoneExpresion)],
        'mensaje' 	=> 'El usuario se des/bloqueó correctamente.'
	),
	'016'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'No tienes los suficientes permisos para hacer eso.'
	),
	'017'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'El usuario o correo electronico ya existe en otro usuario.'
	),
	'018'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'No existen roles con los que operar.'
	),
	'019'		=>	array(
		'titulo' 	=> 'Falta Algo',
        'mensaje' 	=> 'No has introducido los campos necesarios..'
	),
	'020'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'El grupo no existe.'
	),
	'021'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'Este grupo no puede ser borrado.'
	),
	'022'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'No puedes interactuar con un grupo con un rango superior o similar a ti.'
	),
	'023'		=>	array(
		'titulo' 	=> $DoneExpresion[array_rand($DoneExpresion)],
        'mensaje' 	=> 'Grupo eliminado correctamente.'
	),
	'024'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'El nombre de grupo puede contener caracteres numericos, alfanumericos y "_".'
	),
	'025'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'No puedes crear o editar un grupo con rango mas elevado o similar al tuyo.'
	),
	'026'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'El usuario ya existe.'
	),
	'027'		=>	array(
		'titulo' 	=> 	$DoneExpresion[array_rand($DoneExpresion)],
        'mensaje' 	=> 'El usuario parece ser correcto.'
	),
	'028'		=>	array(
		'titulo' 	=> 'Acceso Denegado',
        'mensaje' 	=> 'El registro está desactivado.'
	),
	'029'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'El código de invitación es erroneo.'
	),
	'030'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'No se pudo enviar el correo al destinatario. Contacta con un administrador.'
	),
	'031'		=>	array(
		'titulo' 	=> $DoneExpresion[array_rand($DoneExpresion)],
        'mensaje' 	=> 'Se ha enviado a tu correo tus datos de usuario.'
	),
	'032'		=>	array(
		'titulo' 	=> $DoneExpresion[array_rand($DoneExpresion)],
        'mensaje' 	=> 'Objeto eliminado correctamente.'
	),
	'033'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'Has terminado tu cupo de invitaciones.'
	),
	'034'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'Este usuario ya existe en la Comunidad.'
	),
	'035'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'Este usuario ya ha sido invitado.'
	),
	'036'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'No se pudo comprobar el estado Premium de la cuenta.'
	),
	'037'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'Tu usuario no es Premium. Compra tu cuenta en <a href="https://minecraft.net/store/minecraft" target="_blank">Minecraft.net</a>'
	),
	'038'		=>	array(
		'titulo' 	=> $DoneExpresion[array_rand($DoneExpresion)],
        'mensaje' 	=> 'El usuario ha sido verificado correctamente.'
	),
	'039'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'Necesitas activar el sistema de invitaciones previamente.'
	),
	'040'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'No es necesaria invitacion en el servidor para registrarse.'
	),
	'041'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'Es necesaria una invitación para registrarse como usuario.'
	),
	'042'		=>	array(
		'titulo' 	=> $DoneExpresion[array_rand($DoneExpresion)],
        'mensaje' 	=> 'Se te ha enviado un correo con tus datos de acceso para activar tu cuenta.'
	),
	'043'		=>	array(
		'titulo' 	=> $DoneExpresion[array_rand($DoneExpresion)],
        'mensaje' 	=> 'Tu usuario se ha activado correctamente. Ya puedes empezar a jugar.'
	),
	'044'		=>	array(
		'titulo' 	=> $ErrExpresion[array_rand($ErrExpresion)],
        'mensaje' 	=> 'El usuario ya esta activado.'
	)
);