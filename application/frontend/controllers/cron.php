<?php

class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        ini_set('memory_limit', '-1');
        $ip = $_SERVER['REMOTE_ADDR']; 

        $vips = array("127.0.0.1","localhost");

        if(!in_array($ip,$vips)){echo "La ip: ".$ip." tiene acceso restringido";exit;}
    }

    //CONTROLADOR PARA TAREAS PROGRAMADAS
}

?>