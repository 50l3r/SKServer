<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//////////////////////////////////////////////////////////////////////
//MENU PRINCIPAL
//////////////////////////////////////////////////////////////////////
$config['menu_front'] = array(
    array(
        'ItemText'  => 'Inicio',
        'ItemId'    => 'inicio',
        'ItemLink'  => 'inicio',
        'ItemIcon'  => 'fa-home',
        'submenu'   => array()
    ),
    array(
        'ItemText'  => 'Foro',
        'ItemId'    => 'foro',
        'ItemLink'  => 'foro',
        'ItemIcon'  => 'fa-comments-o',
        'submenu'   => array()
    ),
    array(
        'ItemText'  => 'Mapa',
        'ItemId'    => 'mapa',
        'ItemLink'  => 'http://'.$_SERVER['SERVER_NAME'].':8080',
        'ItemIcon'  => 'fa-map-marker',
        'submenu'   => array()
    ),
    array(
        'ItemText'  => 'Panel',
        'ItemId'    => 'panel',
        'ItemLink'  => 'panel',
        'ItemIcon'  => 'fa-dashboard',
        'submenu'   => array()
    ),
    array(
        'ItemText'  => 'Nuevo Usuario',
        'ItemId'    => 'registro',
        'ItemLink'  => 'registro',
        'ItemIcon'  => 'fa-user',
        'submenu'   => array()
    )
);

//////////////////////////////////////////////////////////////////////
//MENU BACKEND
//////////////////////////////////////////////////////////////////////
$config['menu_back'] = array(
    array(
        'ItemText'  => 'Inicio',
        'ItemId'    => 'inicio',
        'ItemLink'  => 'http://'.$_SERVER['SERVER_NAME'],
        'ItemIcon'  => 'fa-home',
        'ItemClass' => null,
        'ItemScope' => null,
        'submenu'   => array()
    ),
    array(
        'ItemText'  => 'Foro',
        'ItemId'    => 'foro',
        'ItemLink'  => 'http://'.$_SERVER['SERVER_NAME'].'/foro',
        'ItemClass' => null,
        'ItemScope' => null,
        'ItemIcon'  => 'fa-comments-o',
        'submenu'   => array()
    ),
    array(
        'ItemText'  => 'Mapa',
        'ItemId'    => 'mapa',
        'ItemLink'  => 'http://'.$_SERVER['SERVER_NAME'].':8080',
        'ItemIcon'  => 'fa-map-marker',
        'ItemClass' => null,
        'ItemScope' => null,
        'submenu'   => array()
    ),
    array(
        'ItemText'  => 'Dashboard',
        'ItemId'    => 'inicio',
        'ItemLink'  => 'inicio',
        'ItemIcon'  => 'fa-tachometer',
        'ItemClass' => null,
        'ItemScope' => null,
        'submenu'   => array()
    ),
    array(
        'ItemText'  => 'Invitaciones',
        'ItemId'    => 'invitaciones',
        'ItemLink'  => 'invitaciones',
        'ItemIcon'  => 'fa-gift',
        'ItemClass' => null,
        'ItemScope' => 'view.invis',
        'submenu'   => array()
    ),
    array(
        'ItemText'  => 'Usuarios',
        'ItemId'    => 'usuarios',
        'ItemLink'  => 'usuarios',
        'ItemIcon'  => 'fa-users',
        'ItemClass' => null,
        'ItemScope' => 'view.users',
        'submenu'   => array(
            array(
                'ItemText' => 'Todos los usuarios',
                'ItemLink' => 'usuarios',
                'ItemIcon'  => 'fa-bars',
                'ItemClass' => null,
                'ItemScope' => 'view.users'
            ),array(
                'ItemText' => 'Nuevo Usuario',
                'ItemLink' => 'usuarios/nuevo',
                'ItemIcon'  => 'fa-plus-square',
                'ItemClass' => null,
                'ItemScope' => 'add.users'
            ),
        )
    ),
    array(
        'ItemText'  => 'Grupos',
        'ItemId'    => 'grupos',
        'ItemLink'  => 'grupos',
        'ItemIcon'  => 'fa-group',
        'ItemClass' => null,
        'ItemScope' => 'view.groups',
        'submenu'   => array(
            array(
                'ItemText' => 'Todos los grupos',
                'ItemLink' => 'grupos',
                'ItemIcon'  => 'fa-bars',
                'ItemClass' => null,
                'ItemScope' => 'view.groups'
            ),array(
                'ItemText' => 'Nuevo Grupo',
                'ItemLink' => 'grupos/nuevo',
                'ItemIcon'  => 'fa-plus-square',
                'ItemClass' => null,
                'ItemScope' => 'add.groups'
            ),
        )
    ),
    array(
        'ItemText'  => 'Permisos',
        'ItemId'    => 'permisos',
        'ItemLink'  => 'permisos',
        'ItemIcon'  => 'fa-rocket',
        'ItemClass' => null,
        'ItemScope' => 'view.roles',
        'submenu'   => array(
            array(
                'ItemText' => 'Permisos de Usuario',
                'ItemLink' => 'permisos-usuario',
                'ItemIcon'  => 'fa-user',
                'ItemClass' => null,
                'ItemScope' => 'view.user.roles'
            ),array(
                'ItemText' => 'Permisos de Grupo',
                'ItemLink' => 'permisos-grupo',
                'ItemIcon'  => 'fa-group',
                'ItemClass' => null,
                'ItemScope' => 'view.group.roles'
            ),
        )
    )
);