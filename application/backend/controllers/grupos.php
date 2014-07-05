<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupos extends Skserver_Controller{

	public function __construct() {
    parent::__construct();
    $this->load->model('grupos_model');
  }

	public function index(){ //Listar grupos
    $this->auth('view.groups');

		$segment = 2;
		$data['pagina']=$this->uri->segment($segment);
		if(empty($data['pagina'])){$data['pagina']=0;}

		$this->load->library('pagination');
		$config = $this->paginacion($segment,$this->config->item('ppage_groups'));
   	$config['base_url'] = base_url('grupos');

 		$GrupoNombre = $this->input->get('n');

 		if(!empty($GrupoNombre)){
      $data['grupos'] = $this->grupos_model->lista($this->config->item('ppage_groups'),$data['pagina'],$GrupoNombre);
      $config['total_rows'] = $this->grupos_model->getTotal($GrupoNombre);
    }else{
      $data['grupos'] = $this->grupos_model->lista($this->config->item('ppage_groups'),$data['pagina'],false);
      $config['total_rows'] = $this->grupos_model->getTotal(false);
    }

  	$this->pagination->initialize($config);

		$this->vista('grupos/inicio',array(array("bread" => "Grupos")),'Todos los Grupos',$data, "listado-grupos");
	}

  public function addGrupo(){
    $this->auth('add.groups');

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('GrupoNombre', 'Nombre', 'trim|required|min_length[3]|max_length[45]|xss_clean');
    $this->form_validation->set_rules('GrupoDescripcion', 'Descripcion', 'trim|required|min_length[3]|max_length[500]|xss_clean');
    $this->form_validation->set_rules('GrupoRango', 'Rango', 'trim|required|is_natural');

    if ($this->form_validation->run() == FALSE){
      $val_err = validation_errors();
      set_error($val_err,'grupos/nuevo',true);
    }else{
      $GrupoNombre = set_value('GrupoNombre');
      $GrupoDescripcion = set_value('GrupoDescripcion');
      $GrupoRango = set_value('GrupoRango');

      if (!preg_match('/^[a-z\d_]{3,20}$/i', $GrupoNombre)) {set_error("024",'grupos/nuevo');}

      $usuario = $this->roles_model->getGrupo(null,$GrupoNombre);

      if($usuario){
        set_error("005",'grupos/nuevo');
      }else{
        $NGrupo = (object)array(
          "GrupoNombre"       => $GrupoNombre,
          "GrupoDescripcion"  => $GrupoDescripcion,
          "GrupoRango"        => $GrupoRango,
        );

        if($this->compareRangos($NGrupo)){
          $useradd = $this->grupos_model->addGrupo($NGrupo);
        
          if($useradd){
            $GrupoId = $useradd["GrupoId"];

            if(!empty($_FILES['GrupoAvatar']['size'])){
              $this->load->helper('uimage');

              $avatar = $GrupoId.".".$this->config->item('img_config_gavatar')['sext'];
              $uimage = upload_img("GrupoAvatar",'img_config_gavatar','grupos/nuevo','gavatares',$avatar);

              if($uimage){
                  rename($this->config->item('imgrack_apath')."/gavatares/".$uimage,$this->config->item('imgrack_apath')."/gavatares/".$GrupoId.".".$this->config->item('img_config_gavatar')['sext']);
              }else{
                  set_error("008",'grupos/nuevo');
              }
            }
          }else{
            set_error("007",'grupos/nuevo');
          }
        }else{
          set_error("025",'grupos/nuevo');
        }
        set_error("009",'grupos',false,'success');
      }
    }

    $bread = array(
      array("bread" => "Grupos", "link" => "grupos"),
      array("bread" => "Nuevo")
    );

    $this->vista('grupos/nuevo',$bread,'Nuevo Grupo',null,'nuevo-grupo');
  }

  public function editGrupo($Nick){
    $Grupo = $this->roles_model->getGrupo(null,$Nick);
    if(!$Grupo){ //Si el usuario no existe o es superior al tuyo
      redirect(base_url('errores/404/'));
    }elseif(!$this->compareRangos($Grupo)){
      set_error("022",'grupos');
    }

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('GrupoNombre', 'Nombre', 'trim|required|min_length[3]|max_length[45]|xss_clean');
    $this->form_validation->set_rules('GrupoDescripcion', 'Descripcion', 'trim|required|min_length[3]|max_length[500]|xss_clean');
    $this->form_validation->set_rules('GrupoRango', 'Rango', 'trim|required|is_natural');

    if ($this->form_validation->run() == FALSE){
      $val_err = validation_errors();
      set_error($val_err,'grupo/'.$Nick,true);
    }else{
      $GrupoNombre = set_value('GrupoNombre');
      $GrupoDescripcion = set_value('GrupoDescripcion');
      $GrupoRango = set_value('GrupoRango');

      if (!preg_match('/^[a-z\d_]{3,20}$/i', $GrupoNombre)) {set_error("024",'grupos/nuevo');}

      $grupo = $this->roles_model->getGrupo(null,$GrupoNombre);
     
      if($grupo && $grupo->GrupoId!=$Grupo->GrupoId){ //Si el grupo existe y no es el mismo
        set_error("005",'grupo/'.$Nick);
      }else{
        $NGrupo = (object)array(
          "GrupoNombre"       => $GrupoNombre,
          "GrupoDescripcion"  => $GrupoDescripcion,
          "GrupoRango"        => $GrupoRango,
        );

        if($this->compareRangos($NGrupo)){
          $useredit = $this->grupos_model->editGrupo($Nick, $NGrupo);
          
          if($useredit){
            if(!empty($_FILES['GrupoAvatar']['size'])){
              $this->load->helper('uimage');

              $avatar = $Grupo->GrupoId.".".$this->config->item('img_config_gavatar')['sext'];
              $uimage = upload_img("GrupoAvatar",'img_config_gavatar','grupo/'.$Nick,'gavatares',$avatar);

              if($uimage){
                  rename($this->config->item('imgrack_apath')."/gavatares/".$uimage,$this->config->item('imgrack_apath')."/gavatares/".$Grupo->GrupoId.".".$this->config->item('img_config_gavatar')['sext']);
              }else{
                  set_error("008",'grupo/'.$Nick);
              }
            }
          }else{
             set_error("007",'grupo/'.$Nick);
          }

          set_error("009",'grupo/'.$GrupoNombre,false,'success');
        }else{
          set_error("025",'grupo/'.$Nick);
        }
      }

    }

    $data['grupo'] = $Grupo;

    $bread = array(
      array("bread" => "Grupos", "link" => "grupos"),
      array("bread" => $Nick)
    );

    $this->vista('grupos/edit',$bread,'Editar Grupo: '.$Nick,$data,'editar-grupo');
  }

  public function delGrupo(){
    $this->auth('delete.groups');

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('GrupoId', 'Grupo', 'required|is_natural_no_zero');

    if ($this->form_validation->run() == FALSE){
      $val_err = validation_errors();
      set_error($val_err,'grupos',true);
    }else{
      $GrupoId = set_value('GrupoId');
      $Grupo = $this->roles_model->getGrupo($GrupoId);

      if($Grupo){
        if($Grupo->GrupoSafe==0){
          if($this->compareRangos($Grupo)){
            $del = $this->grupos_model->delGrupo($GrupoId);

            if($del){
              @unlink($this->config->item('imgrack_apath')."/gavatares/".$GrupoId.".".$this->config->item('img_config_gavatar')['sext']);
              set_error("023",'grupos',false,'success');
            }else{
              set_error("007",'grupos');
            }
          }else{
            set_error("022",'grupos');
          }
        }else{
          set_error("021",'grupos');
        }
      }else{
        set_error("020",'grupos');
      }
    }
  }
}