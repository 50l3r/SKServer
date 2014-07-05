<?php

class Skserver_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
	}	

    final function vista($nombre, $titulo = null, $datos = null){ //Printeamos la vista
        !empty($titulo) ? $data['titulo'] = $titulo : $data['titulo'] = "";

        $this->load->driver('cache');
        if (!$data['server'] = $this->cache->get('server')){
            $this->load->library('MinecraftServerStatus');
            $server = $this->minecraftserverstatus->getStatus($this->config->item('server_ip'),$this->config->item('server_version'),$this->config->item('server_port'));

            if(!empty($server)){
                $this->cache->save('server', $server, $this->config->item('server_statcache'));
                $data['server'] = $server;
            }
        }

        $data['CI'] = $CI =& get_instance();

        $this->load->view('/template/header', $data);
        $this->load->view('/' . $nombre, $datos);
        $this->load->view('/template/footer', $data);
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/frontend/core/MY_Controller.php */