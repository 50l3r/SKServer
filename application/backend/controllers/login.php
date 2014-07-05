<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends Skserver_Controller {
    public function __construct(){
        parent::__construct();
    }
        
    public function index() {
        if (!empty($this->usuario)){redirect(base_url('inicio'), 'redirect');} //Si esta logueado redirigimos al dashboard

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Usuario', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('password', 'Clave', 'required|max_length[20]');

        if ($this->form_validation->run() == FALSE){
            $val_err = validation_errors();
            set_error($val_err,'login',true);
        }else{
            $username = set_value('username');
            $password = set_value('password');
   
            $result = $this->usuarios_model->get(null,$username);

            if ($result != false && strtolower($result->UsuarioNick) == strtolower($username) && $this->usuarios_model->ComprobarClave($result->UsuarioClave, $password)) {
                if ($result->UsuarioEstado == 0) { //Usuario inactivo
                    set_error('001','login');
                }elseif($result->UsuarioEstado == 2){
                    set_error('003','login');
                }else{
                    $this->usuarios_model->setUltimaConex($result->UsuarioId,$result->UsuarioFecha,$result->UsuarioIp);

                    $this->session->set_userdata(array('UsuarioId' => $result->UsuarioId));
                    redirect(base_url('inicio'));
                }
            }else{ //Usuario o clave incorrectos
                set_error('002','login');
            }
        }

        $this->vista('login/inicio',null,'Iniciar Sesión');
    }

    /*public function olvidoClave(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Nick', 'trim|min_length[3]|max_length[20]|xss_clean');
        $this->form_validation->set_rules('email', 'Correo', 'trim|valid_email');

        if ($this->form_validation->run() == FALSE){
            $err = validation_errors();
            set_error($err,'olvido-clave',true);
        }else{
            $UsuarioNombre = set_value("username");
            $UsuarioCorreo = set_value("email");

            if(empty($UsuarioNombre) && empty($UsuarioCorreo)){set_error("003",'olvido-clave');} //Introduce algun campo

            $user = $this->usuarios_model->getForgotUser($UsuarioNombre,$UsuarioCorreo);

            if($user){
                if($user->UsuarioEstado!=1){
                    set_error("004",'olvido-clave');
                }else{ 
                    $restablecer = $this->usuarios_model->setRestablecimiento($user->UsuarioId);

                    $datos = array(
                        'UsuarioNombre' => $user->UsuarioNombre,
                        'enlaceActivacion' => base_url('cambiar-clave/'.$user->UsuarioNombre.'/'.$restablecer),
                        'ipCambio'  => $_SERVER['REMOTE_ADDR'],
                    );
                    
                    $this->load->library('email', $this->config->item('parametros_correo'));
                    $this->email->set_newline("\r\n");

                    $this->email->from($this->config->item('email_mensajero'), $this->config->item('marca'));
                    $this->email->to($user->UsuarioCorreo);

                    $this->email->subject($this->lang->line('correo_oclave_subject'));
                    $this->email->message($this->load->view('correo/olvido_clave', $datos, true));

                    if (!$this->email->send()){
                        echo $this->email->print_debugger();exit;
                        set_error("005",'olvido-clave');
                    }else{
                        set_error("006",'olvido-clave',false,'success');
                    }
                
                }
            }
        }

        $this->load->view('login/olvido');
    }

    public function cambiarClave($UsuarioNombre=null,$Activacion=null){
        if(empty($UsuarioNombre) || empty($Activacion)){redirect(base_url('errores/404/'),'location');}

        $usuario = $this->usuarios_model->get(null,$UsuarioNombre);

        if($usuario->UsuarioEstado!=1){
            set_error("004",'olvido-clave');
        }else{
            if ($usuario->UsuarioRestablecer != $Activacion) {
                set_error("007",'olvido-clave');
            }else{
                $clave = $this->generarCadenaAleatoria(12);
                $chpass = $this->usuarios_model->setClave($usuario->UsuarioId,$clave);

                if($chpass){
                    $datos = array(
                        'UsuarioNombre' => $usuario->UsuarioNombre,
                        'UsuarioClave' => $clave
                    );
                    
                    $this->load->library('email', $this->config->item('parametros_correo'));
                    $this->email->set_newline("\r\n");

                    $this->email->from($this->config->item('email_mensajero'), $this->config->item('marca'));
                    $this->email->to($usuario->UsuarioCorreo);

                    $this->email->subject($this->lang->line('correo_rpass_subject'));
                    $this->email->message($this->load->view('correo/reseteo_clave', $datos, true));

                    if (!$this->email->send()){
                        set_error("005",'olvido-clave');
                    }else{
                        set_error("006",'login',false,'success');
                    }
                }else{
                    set_error("007",'olvido-clave');
                }
            }
        }
    }*/

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}