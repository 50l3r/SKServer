-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2014 a las 15:15:24
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `skserver`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `GrupoId` int(11) NOT NULL AUTO_INCREMENT,
  `GrupoRango` int(11) NOT NULL,
  `GrupoNombre` varchar(45) NOT NULL,
  `GrupoDescripcion` varchar(500) NOT NULL,
  `GrupoSafe` int(1) NOT NULL,
  PRIMARY KEY (`GrupoId`),
  UNIQUE KEY `GrupoNombre` (`GrupoNombre`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`GrupoId`, `GrupoRango`, `GrupoNombre`, `GrupoDescripcion`, `GrupoSafe`) VALUES
(1, 10, 'Webmaster', 'Tienen acceso completo a toda la plataforma', 1),
(2, 1, 'Usuario', 'Usuario común de skimdoo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_roles`
--

CREATE TABLE IF NOT EXISTS `grupos_roles` (
  `GrupoId` int(11) NOT NULL,
  `RolId` int(11) NOT NULL,
  PRIMARY KEY (`GrupoId`,`RolId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos_roles`
--

INSERT INTO `grupos_roles` (`GrupoId`, `RolId`) VALUES
(1, 5),
(1, 6),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitaciones`
--

CREATE TABLE IF NOT EXISTS `invitaciones` (
  `InvitacionId` int(11) NOT NULL AUTO_INCREMENT,
  `InvitacionEstado` int(1) NOT NULL COMMENT '0: No Usada - 1: Usada - 2: Caducada',
  `UsuarioId` int(11) NOT NULL,
  `InvitacionCode` varchar(150) NOT NULL,
  `InvitacionFecha` datetime NOT NULL,
  `InvitacionEmail` varchar(360) NOT NULL,
  PRIMARY KEY (`InvitacionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `RolId` int(11) NOT NULL AUTO_INCREMENT,
  `CategoriaId` int(11) NOT NULL,
  `RolScope` varchar(50) NOT NULL,
  `RolDescripcion` varchar(500) NOT NULL,
  PRIMARY KEY (`RolId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`RolId`, `CategoriaId`, `RolScope`, `RolDescripcion`) VALUES
(1, 6, 'edit.myprofile', 'Editar información personal'),
(5, 3, 'view.users', 'Ver usuarios'),
(6, 3, 'add.users', 'Añadir usuarios'),
(8, 5, 'add.groups', 'Añadir un usuario nuevo a un grupo'),
(9, 3, 'delete.users', 'Borrar usuarios'),
(10, 3, 'lock.users', 'Bloquear/desbloquear usuarios'),
(11, 3, 'manage.friends', 'Gestionar usuarios con el mismo rango'),
(12, 3, 'edit.users', 'Editar usuarios'),
(13, 5, 'edit.users.group', 'Editar el grupo de un usuario'),
(14, 4, 'manage.user.roles', 'Gestionar roles de usuarios'),
(15, 4, 'manage.group.roles', 'Gestionar roles de grupos'),
(16, 5, 'view.groups', 'Ver grupos'),
(17, 5, 'edit.groups', 'Editar grupos'),
(18, 5, 'delete.groups', 'Eliminar grupos'),
(19, 5, 'manage.groups', 'Gestionar gupos con el mismo rango'),
(20, 7, 'view.invis', 'Ver invitaciones'),
(21, 7, 'add.invis', 'Crear invitaciones'),
(22, 7, 'delete.invis', 'Eliminar invitaciones'),
(24, 7, 'viewall.invis', 'Ver todas las invitaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_categorias`
--

CREATE TABLE IF NOT EXISTS `roles_categorias` (
  `CategoriaId` int(11) NOT NULL AUTO_INCREMENT,
  `CategoriaNombre` varchar(50) NOT NULL,
  `CategoriaDescripcion` varchar(500) NOT NULL,
  PRIMARY KEY (`CategoriaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `roles_categorias`
--

INSERT INTO `roles_categorias` (`CategoriaId`, `CategoriaNombre`, `CategoriaDescripcion`) VALUES
(1, 'Seguridad', ''),
(3, 'Gestion de Usuarios', ''),
(4, 'Gestion de Roles', ''),
(5, 'Gestion de Grupos', ''),
(6, 'Configuración Personal', ''),
(7, 'Invitaciones', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `UsuarioId` int(11) NOT NULL AUTO_INCREMENT,
  `GrupoId` int(11) NOT NULL,
  `GrupoCaducidad` datetime NOT NULL,
  `UsuarioEstado` int(1) NOT NULL COMMENT '0: Inactivo - 1: Activo - 2: Bloqueado',
  `UsuarioNotificacion` int(1) NOT NULL COMMENT '0: Si - 1: NO',
  `UsuarioNick` varchar(20) NOT NULL,
  `UsuarioNombre` varchar(45) NOT NULL,
  `UsuarioClave` varchar(150) NOT NULL,
  `UsuarioFechaRegistro` datetime NOT NULL,
  `UsuarioFecha` datetime NOT NULL,
  `UsuarioFechaUltima` datetime DEFAULT NULL,
  `UsuarioIp` varchar(45) DEFAULT NULL,
  `UsuarioUltimaIp` varchar(45) NOT NULL,
  `UsuarioCorreo` varchar(360) DEFAULT NULL,
  `UsuarioCorreoModificacion` varchar(360) NOT NULL,
  `UsuarioRestablecer` varchar(12) NOT NULL,
  `UsuarioReactivar` int(1) NOT NULL,
  `UsuarioInvitaciones` int(11) NOT NULL,
  PRIMARY KEY (`UsuarioId`),
  UNIQUE KEY `UsuarioNick` (`UsuarioNick`),
  UNIQUE KEY `UsuarioCorreo` (`UsuarioCorreo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE IF NOT EXISTS `usuarios_roles` (
  `UsuarioId` int(11) NOT NULL,
  `RolId` int(11) NOT NULL,
  PRIMARY KEY (`UsuarioId`,`RolId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles_lock`
--

CREATE TABLE IF NOT EXISTS `usuarios_roles_lock` (
  `UsuarioId` int(11) NOT NULL,
  `RolId` int(11) NOT NULL,
  PRIMARY KEY (`UsuarioId`,`RolId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
