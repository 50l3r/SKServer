<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    var $dbc;
    var $CI;

    public function __construct() {
        $this->dbc = $this->load->database('default', TRUE);
        $this->CI =& get_instance();
    }

    // 0 = No existe, 1 = Existe Usuario, 2 = Existe correo
    public function existUsuario($UsuarioNick, $UsuarioCorreo, $ReturnData=false) { //Comprobar estado de un usuario
        $this->dbc->where('UsuarioNick', $UsuarioNick);
        $this->dbc->or_where('UsuarioCorreo', $UsuarioCorreo);
        $datos = $this->dbc->get("usuarios")->result();
        
        if($ReturnData){
            if(!empty($datos)){return $datos[0];}else{return false;}
        }else{
            if (!isset($datos) or count($datos) == 0)
                return 0;
            if (strtolower($datos[0]->UsuarioNick) == strtolower($UsuarioNick))
                return 1;
            if (strtolower($datos[0]->UsuarioCorreo) == strtolower($UsuarioCorreo))
                return 2;
        }
    }

    public function get($UsuarioId,$UsuarioNick=false) { //Obtener usuario por id o nombre
		if(!empty($UsuarioNick)){
            $this->dbc->where('UsuarioNick', $UsuarioNick); 
        }else{
            $this->dbc->where('UsuarioId', $UsuarioId);
        }
        
        $query = $this->dbc->get('usuarios');
        $datos = $query->result();
        if (!isset($datos) or count($datos) == 0)
            return false;
        return $datos[0];
    }

    public function searchUsuarios($UsuarioNick, $Limit = 20){ //Funcion de busqueda de usuarios por su nick
        $this->dbc->where('UsuarioNick LIKE ', '%'.$UsuarioNick.'%');
        $query = $this->dbc->limit($Limit,0);
        $query = $this->dbc->get('usuarios');
        $datos = $query->result();
        if (!isset($datos) or count($datos) == 0)
            return false;
        return $datos;
    }

    public function lista($MaximoPorPagina = false, $Pagina = false, $UsuarioNombre = false, $Order = false) { //Listar usuarios
        $cr = array(
            "usuarios.UsuarioId",
            "UsuarioNick",
            "UsuarioFecha",
            "UsuarioNombre",
            "UsuarioFechaRegistro",
            "UsuarioIp",
            "UsuarioCorreo",
            "UsuarioEstado",
            "UsuarioFechaUltima",
            "UsuarioUltimaIp",
            "UsuarioCorreo",
            "grupos.GrupoNombre",
            "IF(grupos.GrupoRango IS NULL,'0',grupos.GrupoRango) as GrupoRango",
        );
        $this->dbc->select(implode(",",$cr), false); 

        if ($UsuarioNombre){
            $this->dbc->where('UsuarioNombre Like', '%' . $UsuarioNombre . '%');
            $this->dbc->or_where('UsuarioNick Like', '%' . $UsuarioNombre . '%');
        }

        $this->dbc->join('grupos', 'grupos.GrupoId = usuarios.GrupoId', 'left');
        
        switch($Order){
            case "UsuarioFechaUltima":
                $this->dbc->order_by("UsuarioFechaUltima", "desc");
            break;

            default:
                $this->dbc->order_by("UsuarioId", "desc");
        }

        if((!empty($MaximoPorPagina) || $MaximoPorPagina == 0) && (!empty($Pagina) || $Pagina==0)){$this->dbc->limit($MaximoPorPagina, $Pagina);}
        
        return $this->dbc->get('usuarios')->result();
    }

    public function getTotal($UsuarioNombre = false) { //Contar total de usuarios
        $this->dbc->from('usuarios');
        
        if ($UsuarioNombre){
            $this->dbc->where('UsuarioNombre Like', '%' . $UsuarioNombre . '%');
            $this->dbc->or_where('UsuarioNick Like', '%' . $UsuarioNombre . '%');
            return $this->dbc->count_all_results();
        }

        return $this->dbc->count_all_results();
    }

    public function getInfo($UsuarioId,$UsuarioNick=false) { //Obtener datos informativos del usuario
        $cr = array(
            "usuarios.UsuarioId",
            "UsuarioNick",
            "UsuarioNombre",
            "UsuarioFechaRegistro",
            "UsuarioIp",
            "UsuarioCorreo",
            "UsuarioEstado",
            "UsuarioFechaUltima",
            "UsuarioInvitaciones",
            "UsuarioUltimaIp",
            "UsuarioNotificacion",
            "UsuarioCorreo",
            "IF(grupos.GrupoId IS NULL,'0',grupos.GrupoId) as GrupoId",
            "IF(grupos.GrupoRango IS NULL,'0',grupos.GrupoRango) as GrupoRango",
            "grupos.GrupoNombre",
            "GROUP_CONCAT(DISTINCT grupos_roles.RolId) AS GRoles",
            "GROUP_CONCAT(DISTINCT usuarios_roles.RolId) AS URoles",
            "GROUP_CONCAT(DISTINCT usuarios_roles_lock.RolId) AS ULRoles"
        );

        $this->dbc->select(implode(",",$cr),false); 
        $this->dbc->join('grupos', 'grupos.GrupoId = usuarios.GrupoId', 'left');
        $this->dbc->join('grupos_roles', 'grupos_roles.GrupoId = usuarios.GrupoId', 'left');
        $this->dbc->join('usuarios_roles', 'usuarios_roles.UsuarioId = usuarios.UsuarioId', 'left');
        $this->dbc->join('usuarios_roles_lock', 'usuarios_roles_lock.UsuarioId = usuarios.UsuarioId', 'left');

        if(!empty($UsuarioNick)){
            $this->dbc->where('UsuarioNick', $UsuarioNick); 
        }else{
            $this->dbc->where('usuarios.UsuarioId', $UsuarioId);
        }

        $this->dbc->group_by('UsuarioId');
        
        $query = $this->dbc->get('usuarios');
        $datos = $query->result();

        //echo var_dump($datos);
        //echo $this->dbc->last_query();

        if (!empty($datos)){
            $usuario =  $datos[0];

            ////////////////
            //ROLES
            ////////////////
            if(!empty($usuario->GRoles)){$GRoles = explode(",",$usuario->GRoles);}else{$GRoles = array();}
            if(!empty($usuario->URoles)){$URoles = explode(",",$usuario->URoles);}else{$URoles = array();}
            $DBRoles = array_merge($GRoles, $URoles);

            if(!empty($usuario->ULRoles)){$ULRoles = explode(",",$usuario->ULRoles);}else{$ULRoles = array();}


            $Scopes = $this->CI->roles_model->getRolesUsuario($DBRoles);

            $Roles = array();
            if($Scopes){
                foreach($Scopes as $Scope){
                    if(!in_array($Scope->RolId,$ULRoles)){
                        $Roles[] = $Scope->RolScope;
                    }
                }
            }

            //Modificamos el objeto usuario editandole los campos de permisos
            $usuario = (object) array_merge((array)$usuario, (array)array("Roles" => $Roles));
            $usuario = (object) array_merge((array)$usuario, (array)array("Roles_lock" => $ULRoles));

            $usuario = (object) array_merge((array)$usuario, (array)array("GRoles" => $GRoles));
            $usuario = (object) array_merge((array)$usuario, (array)array("URoles" => $URoles));
            $usuario = (object) array_merge((array)$usuario, (array)array("ULRoles" => $ULRoles));

            return $usuario;
        }else{
            return false;
        }
    }

    public function getForgotUser($UsuarioNick, $UsuarioCorreo) { //Obtener usuario por nick o correo (OLVIDO CONTRASEÑA)
        $this->dbc->where('UsuarioNick', $UsuarioNick);
        $this->dbc->or_where('UsuarioCorreo', $UsuarioCorreo);
        
        $datos = $this->dbc->get("usuarios")->result();
        
        if(!empty($datos)){return $datos[0];}else{return false;}
    }

    public function addUsuario($UsuarioNick, $UsuarioCorreo, $Grupo = 2, $activate=false) { //Dar de alta nuevo usuario   
        $Clave = $this->generarCadenaAleatoria(12);
        $UsuarioClave = $this->encriptarClave($Clave);

        $data = array(
            'UsuarioNick' => $UsuarioNick,
            'UsuarioClave' => $UsuarioClave,
            'UsuarioCorreo' => $UsuarioCorreo,
            'GrupoId' => $Grupo,
            'UsuarioFecha' => date('Y-m-d H:i:s'),
            'UsuarioIp' => $_SERVER['REMOTE_ADDR'],
            'UsuarioFechaRegistro' => date("Y-m-d H:i:s"),
            'UsuarioEstado' => 1,
            'UsuarioInvitaciones' => $this->CI->config->item('invitaciones_default')
        );

        if($activate){
            $Activacion = $this->generarCadenaAleatoria(12);
            $data['UsuarioRestablecer'] =  $Activacion;
            $data['UsuarioEstado'] =  0;
        }

        $this->dbc->insert('usuarios', $data);
        
        if($this->dbc->affected_rows()>0){
            if($activate){
                return array("UsuarioId" => $this->dbc->insert_id(), 'Clave' => $Clave, 'Activacion' => $Activacion);
            }else{
                return array("UsuarioId" => $this->dbc->insert_id(), 'Clave' => $Clave);
            }
        }else{
            return false;
        }
    }

    public function editUsuario($Nick, $UsuarioNick, $Clave = null, $UsuarioCorreo, $UsuarioNombre, $Grupo = 0) { //Editar usuario   
        $data = array(
            'UsuarioNick' => $UsuarioNick,
            'UsuarioCorreo' => $UsuarioCorreo,
            'UsuarioNombre' => $UsuarioNombre,
            'GrupoId' => $Grupo
        );

        if(!empty($Clave)){
            $UsuarioClave = $this->encriptarClave($Clave);
            $data['UsuarioClave'] = $UsuarioClave;
        }

        $this->dbc->where('UsuarioNick', $Nick);
        $this->dbc->update('usuarios', $data);
        
        return true;
    }

    public function delUsuario($UsuarioId){
        $this->dbc->where('UsuarioId',$UsuarioId);
        $this->dbc->delete('usuarios');

        if($this->dbc->affected_rows()>0){
            $this->dbc->where('UsuarioId',$UsuarioId);
            $this->dbc->delete('usuarios_roles');

            $this->dbc->where('UsuarioId',$UsuarioId);
            $this->dbc->delete('usuarios_roles_lock');

            return true;
        }else{
            return false;
        }
    }

    public function toogleStatus($UsuarioId){
        $this->dbc->set('UsuarioEstado','IF(UsuarioEstado=1, 2, 1)',false);
        $this->dbc->where('UsuarioId',$UsuarioId);

        $this->dbc->update('usuarios');
        if($this->dbc->affected_rows()>0){return true;}else{return false;}
    }

    public function setRestablecimiento($UsuarioId){ //Activamos el restablecimiento de la clave y generamos la clave aleatoria
        $restablecer = $this->generarCadenaAleatoria(12);
        $data = array(
               'UsuarioRestablecer' => $restablecer
        );
        $this->dbc->where('UsuarioId', $UsuarioId);
        $this->dbc->update('usuarios', $data); 
        return $restablecer;
    }

    public function setClave($UsuarioId,$UsuarioClave){ //Modificacion de clave de usuario
        $data = array(
               'UsuarioClave' => $this->encriptarClave($UsuarioClave),
               'UsuarioRestablecer' => ''
            );
        $this->dbc->where('UsuarioId', $UsuarioId);
        $this->dbc->update('usuarios', $data); 
        if($this->dbc->affected_rows()>0){return true;}else{return false;}
    }

    public function setUltimaConex($UsuarioId,$Fecha, $Ip){ //Establecemos ultima conexion
        $data = array( 
            'UsuarioFechaUltima' => $Fecha,
            'UsuarioUltimaIp' => $Ip,
            'UsuarioIp' => $_SERVER['REMOTE_ADDR'],
            'UsuarioFecha' => date("Y-m-d H:i:s"),

        );
        $this->dbc->where('UsuarioId', $UsuarioId);
        $this->dbc->update('usuarios', $data); 
    }

    public function setNuevoCorreo($UsuarioId,$UsuarioCorreo){ //Establecemos proceso para modificacion de nuevo correo
        $restablecer = $this->generarCadenaAleatoria(12);
        $data = array(
               'UsuarioRestablecer' => $restablecer,
               'UsuarioCorreoModificacion' => $UsuarioCorreo
        );
        $this->dbc->where('UsuarioId', $UsuarioId);
        $this->dbc->update('usuarios', $data); 
        return $restablecer;
    }

    public function setEmail($UsuarioId,$UsuarioCorreo){ //Establecemos nuevo correo
        $data = array(
               'UsuarioRestablecer' => '',
               'UsuarioCorreoModificacion' => '',
               'UsuarioCorreo' => $UsuarioCorreo
        );
        $this->dbc->where('UsuarioId', $UsuarioId);
        $this->dbc->update('usuarios', $data); 
        return true;
    }

    public function activarUsuario($UsuarioId){ //Activamos el usuario
        //Activamos el usuario
        $data = array(
               'UsuarioEstado' => 1,
               'UsuarioRestablecer' => ""
        );

        $this->dbc->where('UsuarioId', $UsuarioId);
        $this->dbc->update('usuarios', $data); 
    }

    public function editNotificacion($UsuarioId,$UsuarioNotificacion){ //Establecemos la opcion de notificacion del usuario
        $this->dbc->where('UsuarioId', $UsuarioId);

        $this->dbc->update('usuarios',array("UsuarioNotificacion" => $UsuarioNotificacion));
        if($this->dbc->affected_rows()>0){return true;}else{return false;}
    }

    public function setAvatar($UsuarioId,$UsuarioAvatar){ //Modificamos el avatar del usuario
        $this->dbc->where('UsuarioId', $UsuarioId);

        $this->dbc->update('usuarios',array("UsuarioAvatar" => $UsuarioAvatar));
        if($this->dbc->affected_rows()>0){return true;}else{return false;}
    }

    //////////////////////////////////////////////////////////
    /// FUNCIONES DE CLAVE
    //////////////////////////////////////////////////////////
    private function encriptarClave($UsuarioClave) {
        $salt = substr(hash('whirlpool', uniqid(rand(), true)), 0, 12);
        $hash = hash('whirlpool', $salt . $UsuarioClave);
        $saltPos = (strlen($UsuarioClave) >= strlen($hash) ? strlen($hash) : strlen($UsuarioClave));
        return substr($hash, 0, $saltPos) . $salt . substr($hash, $saltPos);
    }

    public function ComprobarClave($realPass, $checkPass) {
        $saltPos = (strlen($checkPass) >= strlen($realPass) ? strlen($realPass) : strlen($checkPass));
        $salt = substr($realPass, $saltPos, 12);
        $hash = hash('whirlpool', $salt . $checkPass);
        return substr($hash, 0, $saltPos) . $salt . substr($hash, $saltPos) == $realPass;
    }

    private function generarCadenaAleatoria($size) {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $cad = "";
        for ($i = 0; $i < $size; $i++) {
            $cad .= substr($str, rand(0, 62), 1);
        }
        return $cad;
    }
}