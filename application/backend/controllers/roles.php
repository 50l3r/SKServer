<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends Skserver_Controller{

	public function __construct(){
	    parent::__construct();

	    $this->auth('manage.user.roles');
	}

	public function setRolUsuario($Nick){
    	$data['user'] = $this->usuarios_model->getInfo(null,$Nick);
	    if(!$data['user']){ //Si el usuario no existe o es superior al tuyo
	      redirect(base_url('errores/404/'));
	    }elseif(!$this->compareRoles($data['user'])){
	      set_error("014",'usuarios');
	    }

    	$roles = $this->roles_model->getRoles();
    	if(!empty($roles)){
    		$i=0;$c=0;$ci=0;
			$Roles = array();
			$DRoles = array();
			foreach($roles as $rol){ $i++;
				if(in_array($rol->RolId,$data['user']->URoles) || in_array($rol->RolId,$data['user']->ULRoles)){ //Permisos de usuario
					if(in_array($rol->RolId,$data['user']->ULRoles)){
						$rol = (object) array_merge((array)$rol, (array)array("Acceso" => 2));
					}else{
						$rol = (object) array_merge((array)$rol, (array)array("Acceso" => 1));
					}

					$Roles["Usuario"][$rol->CategoriaNombre][] = $rol;
				}elseif(in_array($rol->RolId,$data['user']->GRoles)){ //Permisos de grupo
					$rol = (object) array_merge((array)$rol, (array)array("Acceso" => 1));

					$Roles["Grupo"][$rol->CategoriaNombre][] = $rol;
				}else{ //Permisos sin establecer
					$rol = (object) array_merge((array)$rol, (array)array("Acceso" => 0));

					$DRoles["Otros"][$rol->CategoriaNombre][] = $rol;
				}
			}
    	}else{
    		set_error("018",'inicio');
    	}

    	$data['roles'] = $Roles;$data['droles'] = $DRoles;

    	$bread = array(
	      array("bread" => $Nick, "link" => "usuario/".$Nick),
	      array("bread" => "Permisos de Usuario")
	    );

		$this->vista('roles/usuarios',$bread,'Permisos de '.$Nick,$data,"roles");
	}

	public function setRolGrupo($Nick){
    	$data['grupo'] = $this->roles_model->getGrupoInfo(null,$Nick);
	    if(!$data['grupo']){ //Si el grupo no existe o es superior al tuyo
	      redirect(base_url('errores/404/'));
	    }elseif(!$this->compareRangos($data['grupo'])){
	      set_error("014",'grupos');
	    }

    	$roles = $this->roles_model->getRoles();
    	if(!empty($roles)){
    		$i=0;$c=0;$ci=0;
			$Roles = array();
			$DRoles = array();
			foreach($roles as $rol){ $i++;
				if(in_array($rol->RolId,$data['grupo']->URoles)){ //Permisos de grupo
					$Roles[$rol->CategoriaNombre][] = $rol;
				}else{ //Permisos sin establecer
					$DRoles["Otros"][$rol->CategoriaNombre][] = $rol;
				}
			}
    	}else{
    		set_error("018",'inicio');
    	}

    	$data['roles'] = $Roles;$data['droles'] = $DRoles;

    	$bread = array(
	      array("bread" => $Nick, "link" => "grupo/".$Nick),
	      array("bread" => "Permisos de Grupo")
	    );

		$this->vista('roles/grupos',$bread,'Permisos de '.$Nick,$data,"roles");
	}

	//////////////////////////////////////////////////////////////////////////////////////////
    //AJAX
    //////////////////////////////////////////////////////////////////////////////////////////
	public function UserScope(){
		$this->load->helper('form');
	    $this->load->library('form_validation');

	    $this->form_validation->set_rules('Type', 'Tipo', 'required|is_natural|less_than[4]');
	    $this->form_validation->set_rules('UsuarioId', 'Usuario', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('RolId', 'Rol', 'required|is_natural_no_zero');

	    if ($this->form_validation->run() == FALSE){
	      	die('{"estado": 0, "mensaje": "'.getError("019",true).'"}');
	    }else{
	    	$UsuarioId = set_value('UsuarioId');
	    	$RolId = set_value('RolId');
	    	$Type = set_value('Type');

	    	switch($Type){
	    		case 1:
	    			$act = $this->roles_model->addRolUsuario($UsuarioId,$RolId);
	    		break;

	    		case 2:
	    			$act = $this->roles_model->delRolUsuario($UsuarioId,$RolId);
	    		break;

	    		case 3:
	    			$act = $this->roles_model->banRolUsuario($UsuarioId,$RolId);
	    		break;

	    		default:
	    			die('{"estado": 0, "mensaje": "'.getError("007",true).'"}');
	    	}
    		
    		if($act){
    			die('{"estado": 1, "mensaje": ""}');
    		}else{
    			die('{"estado": 0, "mensaje": "'.getError("007",true).'"}');
    		}
	    }
	}

	public function GroupScope(){
		$this->load->helper('form');
	    $this->load->library('form_validation');

	    $this->form_validation->set_rules('Type', 'Tipo', 'required|is_natural|less_than[4]');
	    $this->form_validation->set_rules('GrupoId', 'Grupo', 'required|is_natural_no_zero');
	    $this->form_validation->set_rules('RolId', 'Rol', 'required|is_natural_no_zero');

	    if ($this->form_validation->run() == FALSE){
	      	die('{"estado": 0, "mensaje": "'.getError("019",true).'"}');
	    }else{
	    	$GrupoId = set_value('GrupoId');
	    	$RolId = set_value('RolId');
	    	$Type = set_value('Type');
	    	
	    	switch($Type){
	    		case 1:
	    			$act = $this->roles_model->addRolGrupo($GrupoId,$RolId);
	    		break;

	    		case 2:
	    			$act = $this->roles_model->delRolGrupo($GrupoId,$RolId);
	    		break;

	    		default:
	    			die('{"estado": 0, "mensaje": "'.getError("007",true).'"}');
	    	}
    		
    		if($act){
    			die('{"estado": 1, "mensaje": ""}');
    		}else{
    			die('{"estado": 0, "mensaje": "'.getError("007",true).'"}');
    		}
	    }
	}
}