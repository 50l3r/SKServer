<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "inicio";
$route['404_override'] = '';

$route['salir'] = "login/logout";

//////////////
//AVATARES
//////////////
$route['avatar/(:any)'] = 'avatar/getAvatar/$1';
$route['gavatar/(:any)'] = 'avatar/getAvatarGrupo/$1';

//////////////
//USUARIOS
//////////////
$route['usuario/(:any)'] = 'usuarios/editUsuario/$1';
$route['usuarios/(:num)'] = 'usuarios/index/$1';
$route['usuarios/nuevo'] = 'usuarios/addUsuario';
$route['eliminar-usuario'] = 'usuarios/delUsuario';
$route['cambiar-estado'] = 'usuarios/toogleStatus';

//////////////
//GRUPOS
//////////////
$route['grupo/(:any)'] = 'grupos/editGrupo/$1';
$route['grupos/(:num)'] = 'grupos/index/$1';
$route['grupos/nuevo'] = 'grupos/addGrupo';
$route['eliminar-grupo'] = 'grupos/delGrupo';

//////////////
//PERMISOS
//////////////
$route['permisos-usuario/(:any)'] = 'roles/setRolUsuario/$1';
$route['permisos-grupo/(:any)'] = 'roles/setRolGrupo/$1';

//////////////
//INVITACIONES
//////////////
$route['invitaciones/(:num)'] = 'invitaciones/index/$1';
$route['crear-invitacion'] = 'invitaciones/addInvitacion';
$route['eliminar-invitacion'] = 'invitaciones/delInvitacion';


/* End of file routes.php */
/* Location: ./application/config/routes.php */