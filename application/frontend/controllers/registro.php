<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registro extends Skserver_Controller{

	public function __construct() {
        parent::__construct();
    }

	public function index($Invitacion = false){
		if($this->config->item('reg_enable')){
			$data = array();

			$InvitMode = $this->config->item('invit_enable');

			if($InvitMode){
				if($Invitacion){
					$this->load->model('invitaciones_model');
		            $invit = $this->invitaciones_model->getInvitCode($Invitacion);

		            if($invit){
		            	$data['invitacion'] = $invit->InvitacionCode;
		            }else{
		            	$data['invitacion'] = $Invitacion;
		            }

				}
				$this->vista('registro/invitacion', 'Nuevo Usuario', $data);
			}else{
				$this->vista('registro/registro', 'Nuevo Usuario', $data);
			}
		}else{
			set_error("028",'inicio');
		}
	}

	public function addUsuario(){ //Registrar nuevo usuario
        if($this->config->item('reg_enable')){
        	$InvitMode = $this->config->item('invit_enable');
        	if(!$InvitMode){set_error("040",'registro');}

    		$this->load->helper('form');
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('UsuarioNick', 'Nick', 'trim|required|min_length[3]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('InvitCode', 'Invitacion', 'trim|required|min_length[3]|max_length[150]|xss_clean');

            if ($this->form_validation->run() == FALSE){
            	$err = validation_errors();

            	$InvitCode = set_value("InvitCode");
                $RUrl = "registro/".$InvitCode;

                set_error($err,$RUrl,true);
            }else{
            	$UsuarioNick = set_value('UsuarioNick');
            	$InvitCode = set_value("InvitCode");

                $RUrl = "registro/".$InvitCode;

                $this->load->model('invitaciones_model');
                $invit = $this->invitaciones_model->getInvitCode($InvitCode);

	    		if($invit){ //Pasamos check de invitación
					$this->load->model('usuarios_model');

					$usuario = $this->usuarios_model->get(null,$UsuarioNick);
			
					if($usuario){
						set_error("017",$RUrl);
					}else{
						$Online_mode = $this->config->item('online_mode');
						if($Online_mode){
							$paid = $this->checkPremium($UsuarioNick);
							if(!$paid){set_error("037","registro");}
						}

						$UsuarioCorreo = $invit->InvitacionEmail;
						$useradd = $this->usuarios_model->addUsuario($UsuarioNick, $UsuarioCorreo);

						if($useradd){
							$this->invitaciones_model->setStatusInvitCode($InvitCode);

							$UsuarioId = $useradd['UsuarioId'];
							$pass = $useradd['Clave'];

							$PHPBB_Mode = $this->config->item('forum_enable');

							if($PHPBB_Mode){
								$this->load->library('phpbb');
                				$this->phpbb->addUser($UsuarioNick, $UsuarioCorreo, $pass);
							}
							
							$datos = array(
					            'UsuarioNick' => $UsuarioNick,
					            'UsuarioClave' => $pass
					        );
					        
					        $this->load->library('email', $this->config->item('parametros_correo'));
					        $this->email->set_newline("\r\n");

					        $this->email->from($this->config->item('email_mensajero'), $this->config->item('marca'));
					        $this->email->to($UsuarioCorreo);

					        $this->email->subject($this->config->item('marca').' - '.$this->lang->line('correo_altaus_subject'));

					        $this->email->message($this->load->view('correo/alta_usuario', $datos, true));

					        if (!$this->email->send()){
					        	set_error("030",$RUrl);		
					        }else{
					         	set_error("031",'inicio',false,'success');
					        }
						}else{
							set_error("007",$RUrl);
						}
					}
			    }else{
			    	set_error("023",'registro');
			    }
			}
		}else{
			set_error("028",'inicio');
		}
	}

	public function addUsuarioUnlock(){ //Registrar nuevo usuario sin invitacion
        if($this->config->item('reg_enable')){
    		$InvitMode = $this->config->item('invit_enable');
        	if($InvitMode){set_error("041",'registro');}

    		$this->load->helper('form');
	        $this->load->library('form_validation');

	        $this->form_validation->set_rules('UsuarioNick', 'Nick', 'trim|required|min_length[3]|max_length[20]|xss_clean');
	        $this->form_validation->set_rules('UsuarioCorreo', 'Email', 'trim|required|valid_email');
	        
            if ($this->form_validation->run() == FALSE){
            	$err = validation_errors();

                set_error($err,"registro",true);
            }else{
            	$UsuarioNick = set_value('UsuarioNick');
            	$UsuarioCorreo = set_value('UsuarioCorreo');

				$this->load->model('usuarios_model');

				$usuario = $this->usuarios_model->existUsuario($UsuarioNick, $UsuarioCorreo);
				
				if($usuario!==0){
					set_error("017","registro");
				}else{
					$Online_mode = $this->config->item('online_mode');
					if($Online_mode){
						$paid = $this->checkPremium($UsuarioNick);
						if(!$paid){set_error("037","registro");}
					}

					$useradd = $this->usuarios_model->addUsuario($UsuarioNick, $UsuarioCorreo);

					if($useradd){
						$UsuarioId = $useradd['UsuarioId'];
						$pass = $useradd['Clave'];

						$PHPBB_Mode = $this->config->item('forum_enable');

						if($PHPBB_Mode){
							$this->load->library('phpbb');
            				$this->phpbb->addUser($UsuarioNick, $UsuarioCorreo, $pass);
						}
						
						$datos = array(
				            'UsuarioNick' => $UsuarioNick,
				            'UsuarioClave' => $pass
				        );
				        
				        $this->load->library('email', $this->config->item('parametros_correo'));
				        $this->email->set_newline("\r\n");

				        $this->email->from($this->config->item('email_mensajero'), $this->config->item('marca'));
				        $this->email->to($UsuarioCorreo);

				        $this->email->subject($this->config->item('marca').' - '.$this->lang->line('correo_altaus_subject'));

				        $this->email->message($this->load->view('correo/alta_usuario', $datos, true));

				        if (!$this->email->send()){
				        	set_error("030","registro");		
				        }else{
				         	set_error("031",'inicio',false,'success');
				        }
					}else{
						set_error("007","registro");
					}
				}
			}
		}else{
			set_error("028",'inicio');
		}
	}


	public function checkPremium($UsuarioNick){ //Verificar si el usuario es premium
		$paid = file_get_contents("https://minecraft.net/haspaid.jsp?user=".$UsuarioNick);

		if(!empty($paid)){
			if($paid=="true"){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	//////////////////////////////////////////////////
	// AJAX
	//////////////////////////////////////////////////

	public function checkAvailable(){ //Comprobamos que el usuario no este ya registrado o baneado
		$this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('UsuarioNick', 'Nick', 'trim|required|min_length[3]|max_length[20]|xss_clean');

    	if ($this->form_validation->run() == FALSE){
    		die('{"estado": 0, "mensaje": "'.getError("019",true).'"}');
    	}else{
    		$UsuarioNick = set_value('UsuarioNick');

    		$this->load->model('usuarios_model');
    		$user = $this->usuarios_model->get(null,$UsuarioNick);

    		if($user){
	    		switch($user->UsuarioEstado){
	    			case 2: //Baneado
	                    die('{"estado": 0, "mensaje": "'.getError("003",true).'"}');
	    			break;

	    			case 1:case 0: //Activo o Inactivo
	                    die('{"estado": 0, "mensaje": "'.getError("026",true).'"}');
	    			break;

	    			default:
	    				die('{"estado": 0, "mensaje": "'.getError("007",true).'"}');
	    		}
			}else{
	            die('{"estado": 1, "mensaje": "'.getError("027",true).'"}');
			}
    	}
    }

	public function checkInvitCode(){ //Comprobamos invitacion valida
		if($this->config->item('reg_enable')){
    		$this->load->helper('form');
	        $this->load->library('form_validation');
	        
	        $this->form_validation->set_rules('InvitCode', 'Invitación', 'trim|required|exact_length[140]|xss_clean');

	        if ($this->form_validation->run() == FALSE){
	    		die('{"estado": 0, "mensaje": "'.getError("029",true).'"}');
	    	}else{
	    		$InvitCode = set_value('InvitCode');

	    		$this->load->model('invitaciones_model');
	    		$invit = $this->invitaciones_model->getInvitCode($InvitCode);

	    		if($invit){
	    			$json = array(
	                    "estado" => 1,
	                    "invitacion" => $invit,
	                );

	    			die(json_encode($json));
	    		}else{
	    			die('{"estado": 0, "mensaje": "'.getError("029",true).'"}');
	    		}
	    	}
	    }else{
	    	die('{"estado": 0, "mensaje": "'.getError("028",true).'"}');
	    }
	}
}