<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends Skserver_Controller{

	public function index(){
		$this->vista('inicio/inicio',null,'Dashboard');
	}
}