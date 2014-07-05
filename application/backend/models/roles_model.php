<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roles_model extends CI_Model {

    var $dbc;
    var $CI;

    public function __construct() {
        $this->dbc = $this->load->database('default', TRUE);
        $this->CI =& get_instance();
    }

    public function getRoles() { //Obtener roles
        $this->dbc->select('RolId,RolScope,RolDescripcion,CategoriaNombre,CategoriaDescripcion, roles.CategoriaId');
        $this->dbc->join('roles_categorias', 'roles_categorias.CategoriaId = roles.CategoriaId','left');
        
        $this->dbc->order_by('roles.CategoriaId');

        $query = $this->dbc->get('roles');
        $datos = $query->result();

        if (empty($datos)){return false;}else{return $datos;}
    }

    public function existRolUsuario($UsuarioId, $RolId){ //Comprobamos existencia de rol en usuario
        $datos =  $this->dbc->query("SELECT RolId FROM usuarios_roles WHERE UsuarioId = '".$UsuarioId."' AND RolId = '".$RolId."' UNION SELECT RolId FROM usuarios_roles_lock WHERE UsuarioId = '".$UsuarioId."' AND RolId = '".$RolId."'")->result();
        if (empty($datos)){return false;}else{return true;}
    }

    public function existRolGrupo($GrupoId, $RolId){ //Comprobamos existencia de rol en grupo
        $datos =  $this->dbc->query("SELECT RolId FROM grupos_roles WHERE GrupoId = '".$GrupoId."' AND RolId = '".$RolId."'")->result();
        if (empty($datos)){return false;}else{return true;}
    }

    public function delRolUsuario($UsuarioId, $RolId){ //Elimina el rol de un usuario tanto negativo como positivo
        $exist = $this->existRolUsuario($UsuarioId,$RolId);

        if($exist){
            $del = false;

            $this->dbc->where('UsuarioId',$UsuarioId);
            $this->dbc->where('RolId',$RolId);
            $this->dbc->delete('usuarios_roles');
            if($this->dbc->affected_rows()>0){$del = true;}

            $this->dbc->where('UsuarioId',$UsuarioId);
            $this->dbc->where('RolId',$RolId);
            $this->dbc->delete('usuarios_roles_lock');
            if($this->dbc->affected_rows()>0){$del = true;}

            if($del){return true;}else{return false;}
        }else{
            return false;
        }
    }


    public function delRolGrupo($GrupoId, $RolId){ //Elimina el rol de un grupo tanto negativo como positivo
        $exist = $this->existRolGrupo($GrupoId,$RolId);

        if($exist){
            $this->dbc->where('GrupoId',$GrupoId);
            $this->dbc->where('RolId',$RolId);
            $this->dbc->delete('grupos_roles');
            if($this->dbc->affected_rows()>0){return true;}else{return false;}
        }else{
            return false;
        }
    }

    public function addRolUsuario($UsuarioId, $RolId){ //Limpiar permiso de usuario y autorizarlo
        $del = $this->delRolUsuario($UsuarioId,$RolId);

        $this->dbc->insert('usuarios_roles',array("UsuarioId" => $UsuarioId, "RolId" => $RolId));
        if($this->dbc->affected_rows()>0){return true;}else{return false;}
    }

    public function addRolGrupo($GrupoId, $RolId){ //Limpiar permiso de grupo y autorizarlo
        $del = $this->delRolUsuario($GrupoId,$RolId);

        $this->dbc->insert('grupos_roles',array("GrupoId" => $GrupoId, "RolId" => $RolId));
        if($this->dbc->affected_rows()>0){return true;}else{return false;}
    }

    public function banRolUsuario($UsuarioId, $RolId){ //Limpiar permiso de usuario y denegarlo
        $del = $this->delRolUsuario($UsuarioId,$RolId);

        $this->dbc->insert('usuarios_roles_lock',array("UsuarioId" => $UsuarioId, "RolId" => $RolId));
        if($this->dbc->affected_rows()>0){return true;}else{return false;}
    }

    public function getRolesUsuario($IDs = false) { //Obtener roles de usuario para sistema de permisos
        if(!empty($IDs)){
            $this->dbc->select('RolId,RolScope');

            if(is_array($IDs)){
                $CRoles = count($IDs);
                foreach($IDs as $Rol){
                    $this->dbc->or_where('RolId', $Rol);
                }
            }else{
                $CRoles = 1;
                $this->dbc->where('RolId', $IDs);
            }
            
            $query = $this->dbc->get('roles');
            $datos = $query->result();

            if (empty($datos)){return false;}else{return $datos;}
        }else{
            return false;
        }
    }

    public function getGruposAccesibles(){ //Obtener lista de grupos accesibles por el usuario
        if($this->CI->auth("manage.friends",true)){
            $this->dbc->where('GrupoRango <=', $this->CI->usuario->GrupoRango);
        }else{
            $this->dbc->where('GrupoRango <', $this->CI->usuario->GrupoRango);
        }

        $query = $this->dbc->get('grupos');
        $datos = $query->result();

        if (empty($datos)){return false;}else{return $datos;}
    }

    public function getGrupo($GrupoId, $GrupoNombre = false){
        if(!empty($GrupoNombre)){
            $this->dbc->where('GrupoNombre', $GrupoNombre); 
        }else{
            $this->dbc->where('GrupoId', $GrupoId);
        }
        
        $query = $this->dbc->get('grupos');
        $datos = $query->result();

        if (empty($datos)){return false;}else{return $datos[0];}
    }
    
    public function getGrupoInfo($GrupoId, $GrupoNombre = false){
        $cr = array(
            "grupos.*",
            "GROUP_CONCAT(DISTINCT grupos_roles.RolId) AS URoles",
        );

        $this->dbc->select(implode(",",$cr),false); 
        $query = $this->dbc->join('grupos_roles','grupos_roles.GrupoId = grupos.GrupoId','left');

        if(!empty($GrupoNombre)){
            $this->dbc->where('GrupoNombre', $GrupoNombre); 
        }else{
            $this->dbc->where('GrupoId', $GrupoId);
        }
        
        $query = $this->dbc->get('grupos');
        $datos = $query->result();

        if (!empty($datos)){
            $grupo =  $datos[0];

            ////////////////
            //ROLES
            ////////////////
            if(!empty($grupo->URoles)){$URoles = explode(",",$grupo->URoles);}else{$URoles = array();}
            $grupo = (object) array_merge((array)$grupo, (array)array("URoles" => $URoles));

            return $grupo;
        }else{
            return false;
        }
    }

}