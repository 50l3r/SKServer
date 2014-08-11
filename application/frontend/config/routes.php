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
$route['avatar/(:any)/1'] = 'avatar/getAvatar/$1/1';
$route['gavatar/(:any)'] = 'avatar/getAvatarGrupo/$1';

//////////////
//USUARIOS
//////////////
$route['usuario/(:any)'] = 'usuarios/getUsuario/$1';
$route['usuarios/(:num)'] = 'usuarios/index/$1';

//////////////
//REGISTRO
//////////////
$route['registro'] = 'registro/index';
$route['registro/(:any)'] = 'registro/index/$1';
$route['crear-usuario'] = 'registro/addUsuario';
$route['nuevo-usuario'] = 'registro/addUsuarioUnlock';
$route['activar/(:any)/(:any)'] = "registro/activarUsuario/$1/$2";
$route['checkInvitCode'] = 'registro/checkInvitCode';
$route['checkAvailable'] = 'registro/checkAvailable';
$route['checkPremium'] = 'registro/checkPremium';

/* End of file routes.php */
/* Location: ./application/config/routes.php */