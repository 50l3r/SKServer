<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends Skserver_Controller{

	public function __construct() {
    parent::__construct();
    $this->auth('view.users');
  }

	public function index(){ //Listar usuarios
		$segment = 2;
		$data['pagina']=$this->uri->segment($segment);
		if(empty($data['pagina'])){$data['pagina']=0;}

		$this->load->library('pagination');
		$config = $this->paginacion($segment,$this->config->item('ppage_users'));
   		$config['base_url'] = base_url('usuarios');

   		$UsuarioNombre = $this->input->get('n');

   		if(!empty($UsuarioNombre)){
            $data['usuarios'] = $this->usuarios_model->lista($this->config->item('ppage_users'),$data['pagina'],$UsuarioNombre);
            $config['total_rows'] = $this->usuarios_model->getTotal($UsuarioNombre);
        } else {
        	$data['usuarios'] = $this->usuarios_model->lista($this->config->item('ppage_users'),$data['pagina'],false);
            $config['total_rows'] = $this->usuarios_model->getTotal(false);
        }

    	$this->pagination->initialize($config);

		$this->vista('usuarios/inicio',array(array("bread" => "Usuarios")),'Todos los Usuarios',$data, "listado-usuarios");
	}

  public function addUsuario(){ //Crear nuevo usuario
    $this->auth('add.users');

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('UsuarioNick', 'Nick', 'trim|required|min_length[3]|max_length[20]|xss_clean');
    $this->form_validation->set_rules('UsuarioNombre', 'Nombre', 'trim|min_length[3]|max_length[45]|xss_clean');
    $this->form_validation->set_rules('Grupo', 'Grupo', 'is_natural|callback_authForm[add.group,false]');
    $this->form_validation->set_rules('UsuarioCorreo', 'Email', 'trim|required|valid_email|min_length[5]');
    $this->form_validation->set_rules('UsuarioClave', 'Clave', 'trim|required|min_length[4]|max_length[20]|matches[UsuarioClave2]');
    $this->form_validation->set_rules('UsuarioClave2', 'Clave', 'trim|required|min_length[4]|max_length[20]');

    if ($this->form_validation->run() == FALSE){
      $val_err = validation_errors();
      set_error($val_err,'usuarios/nuevo',true);
    }else{
      $UsuarioNombre = set_value('UsuarioNombre');
      $UsuarioNick = set_value('UsuarioNick');
      $UsuarioCorreo = set_value('UsuarioCorreo');
      $UsuarioClave = set_value('UsuarioClave');

      if (!preg_match('/^[a-z\d_]{3,20}$/i', $UsuarioNick)) {set_error("004",'usuarios/nuevo');}

      $usuario = $this->usuarios_model->existUsuario($UsuarioNick,$UsuarioCorreo);
      if($usuario!=0){
        set_error("005",'usuarios/nuevo');
      }else{
        if($this->auth('add.groups',true)){
          $Grupo = set_value('Grupo');
          $DBGrupo = $this->roles_model->getGrupo($Grupo);

          if(!$DBGrupo){ //Si el grupo no existe o es superior al tuyo
            $Grupo = 0;
          }elseif($DBGrupo->GrupoRango>$this->usuario->GrupoRango){
            $Grupo = 0;
          }
        }else{
          $Grupo = 0;
        }

        $useradd = $this->usuarios_model->addUsuario($UsuarioNick, $UsuarioClave, $UsuarioCorreo, $UsuarioNombre, $Grupo);
        
        if($useradd){
          $UsuarioId = $useradd["UsuarioId"];
        }else{
           set_error("007",'usuarios/nuevo');
        }

        set_error("009",'usuarios',false,'success');
      }
    }

    $data['grupos'] = $this->roles_model->getGruposAccesibles();

    $bread = array(
      array("bread" => "Usuarios", "link" => "usuarios"),
      array("bread" => "Nuevo")
    );

    $this->vista('usuarios/nuevo',$bread,'Nuevo Usuario',$data,'nuevo-usuario');
  }

  public function editUsuario($Nick){ //Editar usuario
    $Usuario = $this->usuarios_model->getInfo(null,$Nick);
    if(!$Usuario){ //Si el usuario no existe o es superior al tuyo
      redirect(base_url('errores/404/'));
    }elseif(!$this->compareRoles($Usuario)){
      set_error("014",'usuarios');
    }

    if($Usuario->UsuarioId==$this->usuario->UsuarioId){$this->auth('edit.myprofile');}else{$this->auth('edit.users');}
    

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('UsuarioNombre', 'Nombre', 'trim|min_length[3]|max_length[45]|xss_clean');
    $this->form_validation->set_rules('Grupo', 'Grupo', 'is_natural|callback_authForm[edit.users.group,false]');
    $this->form_validation->set_rules('UsuarioCorreo', 'Email', 'trim|required|valid_email|min_length[5]');
    $this->form_validation->set_rules('UsuarioClave', 'Clave', 'trim|min_length[4]|max_length[20]|matches[UsuarioClave2]');
    $this->form_validation->set_rules('UsuarioClave2', 'Clave', 'trim|min_length[4]|max_length[20]');

    if ($this->form_validation->run() == FALSE){
      $val_err = validation_errors();
      set_error($val_err,'usuario/'.$Nick,true);
    }else{
      $UsuarioNombre = set_value('UsuarioNombre');
      $UsuarioNick = $Nick;
      $UsuarioCorreo = set_value('UsuarioCorreo');
      $UsuarioClave = set_value('UsuarioClave');

      if (!preg_match('/^[a-z\d_]{3,20}$/i', $UsuarioNick)) {set_error("004",'usuario/'.$Nick);}

      $usuario = $this->usuarios_model->existUsuario($UsuarioNick,$UsuarioCorreo,true);
      
      if($usuario && $usuario->UsuarioId!=$Usuario->UsuarioId){ //Si el usuario existe y no es el mismo
        set_error("017",'usuario/'.$Nick);
      }else{
        if($this->auth('edit.users.group',true)){
          $Grupo = set_value('Grupo');
          $DBGrupo = $this->roles_model->getGrupo($Grupo);

          if(!$DBGrupo){//Si el grupo no existe o es superior al tuyo
            $Grupo = 0;
          }elseif($DBGrupo->GrupoRango>$this->usuario->GrupoRango){
            $Grupo = 0;
          }
        }else{
          $Grupo = 0;
        }

        $useredit = $this->usuarios_model->editUsuario($Nick, $UsuarioNick, $UsuarioClave, $UsuarioCorreo, $UsuarioNombre, $Grupo);
        
        if($useredit){
        }else{
           set_error("007",'usuario/'.$Nick);
        }

        set_error("009",'usuarios',false,'success');
      }
    }

    $data['grupos'] = $this->roles_model->getGruposAccesibles();
    $data['usuario'] = $Usuario;

    $bread = array(
      array("bread" => "Usuarios", "link" => "usuarios"),
      array("bread" => $Nick)
    );

    $this->vista('usuarios/edit',$bread,'Editar Usuario: '.$Nick,$data,'editar-usuario');
  }

  public function delUsuario(){ //Eliminar usuario
    $this->auth('delete.users');

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('UsuarioId', 'Usuario', 'required|is_natural_no_zero');

    if ($this->form_validation->run() == FALSE){
      $val_err = validation_errors();
      set_error($val_err,'usuarios',true);
    }else{
      $UsuarioId = set_value('UsuarioId');
      $Usuario = $this->usuarios_model->getInfo($UsuarioId);

      if($Usuario){
        if($UsuarioId!=$this->usuario->UsuarioId){
          if($this->compareRoles($Usuario)){
            $del = $this->usuarios_model->delUsuario($UsuarioId);

            if($del){
              @unlink($this->config->item('imgrack_apath')."/avatares/".$UsuarioId.".".$this->config->item('img_config_avatar')['sext']);
              
              $PHPBB_Mode = $this->config->item('forum_enable');

              if($PHPBB_Mode){
                $this->load->library('phpbb');
                $this->load->model('Phpbbuser_model');
                $phpbb_user = $this->Phpbbuser_model->get_user($Usuario->UsuarioNick);
                if($phpbb_user){
                  $this->phpbb->deleteUser($phpbb_user->user_id);
                }
              }

              set_error("012",'usuarios',false,'success');
            }else{
              set_error("007",'usuarios');
            }
          }else{
            set_error("014",'usuarios');
          }
        }else{
          set_error("011",'usuarios');
        }
      }else{
        set_error("013",'usuarios');
      }
    }
  }

  public function toogleStatus(){ //Bloquear/desbloquear usuario
    $this->auth('lock.users');

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('UsuarioId', 'Usuario', 'required|is_natural_no_zero');

    if($this->form_validation->run() == FALSE){
      $val_err = validation_errors();
      set_error($val_err,'usuarios',true);
    }else{
      $UsuarioId = set_value('UsuarioId');
      $Usuario = $this->usuarios_model->getInfo($UsuarioId);

      if($Usuario){
        if($UsuarioId!=$this->usuario->UsuarioId){
          if($this->compareRoles($Usuario)){
            $lock = $this->usuarios_model->toogleStatus($UsuarioId);

            if($lock){
              set_error("015",'usuarios',false,'success');
            }else{
              set_error("007",'usuarios');
            }
          }else{
            set_error("014",'usuarios');
          }
        }else{
          set_error("011",'usuarios');
        }
      }else{
        set_error("013",'usuarios');
      }
    }
  }
}