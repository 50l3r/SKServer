<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invitaciones_model extends CI_Model {

    var $dbc;
    var $CI;

    public function __construct() {
        $this->dbc = $this->load->database('default', TRUE);
        $this->CI =& get_instance();
    }

    public function getInvitCode($InvitCode){ //Obtenemos informacion sobre la invitacion
        $this->dbc->select('invitaciones.*, usuarios.UsuarioNick');

        $this->dbc->where('InvitacionCode', $InvitCode);
        $this->dbc->where('InvitacionEstado', '0');
        
        $this->dbc->join('usuarios', 'usuarios.UsuarioId = invitaciones.UsuarioId', 'left');

        $query = $this->dbc->get('invitaciones');
        $datos = $query->result();

        //echo $this->dbc->last_query();exit;

        if (!isset($datos) or count($datos) == 0)
            return false;
        return $datos[0];
    }

    public function existInvitacion($InvitacionEmail){ //Obtenemos informacion sobre la invitacion
        $this->dbc->where('InvitacionEmail', $InvitacionEmail);
        
        $query = $this->dbc->get('invitaciones');
        $datos = $query->result();

        if (!isset($datos) or count($datos) == 0)
            return false;
        return true;
    }

    public function getCountInvitacionesUsuario($Usuario){
        $this->dbc->select('count(InvitacionId) as total');
        $this->dbc->where('invitaciones.UsuarioId', $Usuario->UsuarioId);
        $this->dbc->group_by('invitaciones.UsuarioId');

        $query = $this->dbc->get('invitaciones');
        $datos = $query->result();

        if (!isset($datos) or count($datos) == 0){
            return $Usuario->UsuarioInvitaciones;
        }else{
            $total = $datos[0]->total;
            if(($Usuario->UsuarioInvitaciones - $total) > 0){
                return ($Usuario->UsuarioInvitaciones - $total);
            }else{
                return 0;
            }
        }
    }

    public function setStatusInvitCode($InvitacionCode){
        $this->dbc->set('InvitacionEstado', 1);
        $this->dbc->where('InvitacionCode', $InvitacionCode);
        $this->dbc->where('InvitacionEstado', '0');

        $this->dbc->update('invitaciones');

        return true;
    }

    public function lista($MaximoPorPagina = false, $Pagina = false, $All = false) { //Listar invitaciones
        $cr = array(
            "usuarios.UsuarioNick",
            "InvitacionEstado",
            "InvitacionCode",
            "InvitacionFecha",
            "InvitacionEmail",
            "InvitacionId"
        );

        $this->dbc->select(implode(",",$cr)); 

        $this->dbc->join('usuarios', 'usuarios.UsuarioId = invitaciones.UsuarioId', 'left');

        if(!$All){$this->dbc->where('invitaciones.UsuarioId', $this->CI->usuario->UsuarioId);}

        if((!empty($MaximoPorPagina) || $MaximoPorPagina == 0) && (!empty($Pagina) || $Pagina==0)){$this->dbc->limit($MaximoPorPagina, $Pagina);}
        
        return  $this->dbc->get('invitaciones')->result();
    }

    public function getTotal($All = false) { //Contar total de invitaciones
        $this->dbc->from('invitaciones');
        if(!$All){$this->dbc->where('invitaciones.UsuarioId', $this->CI->usuario->UsuarioId);}
        return $this->dbc->count_all_results();
    }

    public function addInvitacion($UsuarioId, $InvitacionEmail) { //Dar de alta nueva invitacion   
        $code = $this->generarCadenaAleatoria(12);
        $crypt = $this->encriptarClave($code);
        
        $data = array(
            'InvitacionEstado' => 0,
            'UsuarioId' => $UsuarioId,
            'InvitacionFecha' => date("Y-m-d H:i:s"),
            'InvitacionEmail' => $InvitacionEmail,
            'InvitacionCode' => $crypt
        );

        $this->dbc->insert('invitaciones', $data);
        
        if($this->dbc->affected_rows()>0){
            return $crypt;
        }else{
            return false;
        }
    }

    public function delInvitacion($InvitacionId){ //Eliminar invitacion
        $this->dbc->where('InvitacionId',$InvitacionId);
        $this->dbc->delete('invitaciones');

        if($this->dbc->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    //////////////////////////////////////////////////////////
    /// FUNCIONES DE CLAVE
    //////////////////////////////////////////////////////////
    private function encriptarClave($UsuarioClave) {
        $salt = substr(hash('whirlpool', uniqid(rand(), true)), 0, 12);
        $hash = hash('whirlpool', $salt . $UsuarioClave);
        $saltPos = (strlen($UsuarioClave) >= strlen($hash) ? strlen($hash) : strlen($UsuarioClave));
        return substr($hash, 0, $saltPos) . $salt . substr($hash, $saltPos);
    }

    public function ComprobarClave($realPass, $checkPass) {
        $saltPos = (strlen($checkPass) >= strlen($realPass) ? strlen($realPass) : strlen($checkPass));
        $salt = substr($realPass, $saltPos, 12);
        $hash = hash('whirlpool', $salt . $checkPass);
        return substr($hash, 0, $saltPos) . $salt . substr($hash, $saltPos) == $realPass;
    }

    private function generarCadenaAleatoria($size) {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $cad = "";
        for ($i = 0; $i < $size; $i++) {
            $cad .= substr($str, rand(0, 62), 1);
        }
        return $cad;
    }
}