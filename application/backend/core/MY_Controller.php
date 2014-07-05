<?php

class Skserver_Controller extends CI_Controller {

	public $usuario;

    public function __construct() {
        parent::__construct();
        $this->usuario = $this->getUsuario();
        $this->isOnline();
    
}	
	public function paginacion($segment=3,$perpage=10){
        $config['base_url'] = current_url();
        $config['uri_segment'] = $segment;
        $config['num_links'] = 4;
        $config['per_page'] = $perpage;
		$config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
         
        $config['first_link'] = '&laquo; Primero';
        $config['first_tag_open'] = '<li class="previous">';
        $config['first_tag_close'] = '</li>';
         
        $config['last_link'] = 'Ultimo &raquo;';
        $config['last_tag_open'] = '<li class="next">';
        $config['last_tag_close'] = '</li>';
         
        $config['next_link'] = '<i class="fa fa-arrow-right"></i>';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
         
        $config['prev_link'] = '<i class="fa fa-arrow-left"></i>';
        $config['prev_tag_open'] = '<li class="previous">';
        $config['prev_tag_close'] = '</li>';
         
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
         
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';         

        $config['anchor_class'] = '';
        return $config;
    }

	private function getUsuario() { //Obtenemos el usuario
        $UsuarioId = $this->session->userdata('UsuarioId');

        if (!isset($UsuarioId) or $UsuarioId == ""){return false;}

        $usuario = $this->usuarios_model->getInfo($UsuarioId);

        if ($usuario){
            if ($usuario->UsuarioEstado==2){redirect(base_url('salir'));}
            //echo var_dump($usuario);exit;
            return $usuario;
        }

        return false;
    }

    final function isOnline($Return = false){ //Verificamos si el usuario esta online
        if(empty($this->usuario)){
            if($Return){
                return false;
            }else{
                $wlist = $this->config->item('wlist');
                $CI =& get_instance();

                $controller = strtolower(get_class($CI));
                if(!in_array($controller,$wlist)){
                    redirect(base_url('login'));
                } 
            }
        }

        if($Return){return true;}
    }

    final function vista($nombre, $breads = null, $titulo = null, $datos = null, $source = null){ //Printeamos la vista
        !empty($titulo) ? $data['titulo'] = $titulo : $data['titulo'] = "GeoPack";
        if(!empty($breads)){
            foreach($breads as $bread){
                !empty($bread['link']) ? $link = $bread['link'] : $link = "";
                
                if(!empty($bread['bread'])){
                    $this->breadcrumbs->addCrumb($bread['bread'],$link);
                }
            }
        }

        $data['usuario'] = $this->usuario;
        $data['source'] = $source;
        $data['CI'] = $CI =& get_instance();

        $this->load->view('/template/header', $data);
        $this->load->view('/' . $nombre, $datos);
        $this->load->view('/template/footer', $data);
    } 

    final function auth($Roles, $Return = false, $Usuario = false){
        if(!empty($Roles)){
            if($Usuario){$UserRoles = $Usuario->Roles;}else{$UserRoles = $this->usuario->Roles;}

            if(is_array($Roles)){
                foreach($Roles as $Rol){
                    if(!in_array($Rol,$UserRoles)){
                        if($Return){return false;}else{set_error("016",'inicio');}
                    }
                }
            }else{
                if(in_array($Roles,$UserRoles)){return true;}
            }
        }else{
            return false;
        }

        if($Return){return false;}else{set_error("016",'inicio');}
    }

    final function authForm($Var, $Parameters){
        if(!empty($Parameters)){
            $Params = explode(",",$Parameters);
            $Rol = $Params[0];

            if(count($Params)>1){
                $Require = (bool)$Params[1];
            }else{
                $Require = false;
            }
        }

        if(empty($Var) && $Require){return true;}

        if(!in_array($Rol,$this->usuario->Roles)){
            $this->form_validation->set_message('authForm', 'No tienes los permisos suficientes para hacer esto');
            return false;
        }else{
            return true;
        }
    }

    final function compareRoles($DUsuario){ //Comparacion de rangos de usuario
        if($DUsuario->GrupoRango<$this->usuario->GrupoRango){
            return true;
        }elseif($DUsuario->GrupoRango==$this->usuario->GrupoRango){
            if($this->auth("manage.friends",true) || $DUsuario->UsuarioId==$this->usuario->UsuarioId){return true;}else{return false;}
        }else{
            return false;
        }
    }

    final function compareRangos($DRango){ //Comparacion de rangos de grupos
        if($DRango->GrupoRango<$this->usuario->GrupoRango){
            return true;
        }elseif($DRango->GrupoRango==$this->usuario->GrupoRango){
            if($this->auth("manage.groups",true)){return true;}else{return false;}
        }else{
            return false;
        }
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/frontend/core/MY_Controller.php */