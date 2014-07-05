<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invitaciones extends Skserver_Controller{
	public function __construct() {
	    parent::__construct();
	    $this->load->model('invitaciones_model');
	}

	public function index(){ //Listar invitaciones
    	$this->auth('view.invis');

    	if($this->config->item('invit_enable')){
			$segment = 2;
			$data['pagina']=$this->uri->segment($segment);
			if(empty($data['pagina'])){$data['pagina']=0;}

			$this->load->library('pagination');
			$config = $this->paginacion($segment,$this->config->item('ppage_invitaciones'));
	   		$config['base_url'] = base_url('invitaciones');

	 		$GrupoNombre = $this->input->get('n');

		    $data['invitaciones'] = $this->invitaciones_model->lista($this->config->item('ppage_invitaciones'),$data['pagina'], $this->auth('viewall.invis',true));
		    $config['total_rows'] = $this->invitaciones_model->getTotal($this->auth('viewall.invis',true));

		    $data['ninvitaciones'] = $this->invitaciones_model->getCountInvitacionesUsuario($this->usuario);


	  		$this->pagination->initialize($config);
			$this->vista('invitaciones/inicio',array(array("bread" => "Invitaciones")),'Todas las Invitaciones',$data, "listado-invitaciones");
    	}else{
    		$this->vista('invitaciones/inicio-ko',array(array("bread" => "Invitaciones")),'Todas las Invitaciones');
    	}
	}

  	public function addInvitacion(){
	    $this->auth('add.invis');

	    if(!$this->config->item('invit_enable')){set_error("039", 'inicio');}

	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $this->form_validation->set_rules('InvitacionEmail', 'Email', 'trim|required|valid_email|min_length[5]');

	    if ($this->form_validation->run() == FALSE){
	      	$val_err = validation_errors();
	      	set_error($val_err,'invitaciones',true);
	    }else{
	      	$InvitacionEmail = set_value('InvitacionEmail');
			$invitaciones = $this->invitaciones_model->getCountInvitacionesUsuario($this->usuario);

			$this->load->model('usuarios_model');
			$Exist = $this->usuarios_model->existUsuario('',$InvitacionEmail);
			if($Exist!=2){
				$IExist = $this->invitaciones_model->existInvitacion($InvitacionEmail);

				if(!$IExist){
					if($invitaciones>0){
						$inviadd = $this->invitaciones_model->addInvitacion($this->usuario->UsuarioId, $InvitacionEmail);
		        
			          	if($inviadd){
			          		$datos = array(
					            'Invitacion' => "<a href='".$this->config->item('dominio')."/registro/".$inviadd."'>Aceptar Invitación</a>",
					            'InvitacionCode' => $inviadd
					        );
					        
					        $this->load->library('email', $this->config->item('parametros_correo'));
					        $this->email->set_newline("\r\n");

					        $this->email->from($this->config->item('email_mensajero'), $this->config->item('marca'));
					        $this->email->to($InvitacionEmail);

					        $this->email->subject($this->config->item('marca').' - '.$this->lang->line('correo_invius_subject'));

					        $this->email->message($this->load->view('correo/invitacion_usuario', $datos, true));

					        if (!$this->email->send()){
					        	set_error("030", 'invitaciones');
					        }else{
					        	set_error("009",'invitaciones',false,'success');
					        }
			        	}else{
				            set_error("007",'invitaciones');
				        } 
					}else{
						set_error("033",'invitaciones');
					}		
				}else{
					set_error("035",'invitaciones');	
				}
				
			}else{
				set_error("034",'invitaciones');
			}
    	}
	}

	public function delInvitacion(){
	    $this->auth('delete.invis');

	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $this->form_validation->set_rules('InvitacionId', 'InvitacionId', 'required|is_natural_no_zero');

	    if ($this->form_validation->run() == FALSE){
	      	$val_err = validation_errors();
	      	set_error($val_err,'invitaciones',true);
	    }else{
	      	$InvitacionId = set_value('InvitacionId');

    		$del = $this->invitaciones_model->delInvitacion($InvitacionId);

            if($del){
              	set_error("032",'invitaciones',false,'success');
            }else{
              	set_error("007",'invitaciones');
            }
	    }
	}
}