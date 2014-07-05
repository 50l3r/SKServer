<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grupos_model extends CI_Model {

    var $dbc;
    var $CI;

    public function __construct() {
        $this->dbc = $this->load->database('default', TRUE);
        $this->CI =& get_instance();
    }

    public function lista($MaximoPorPagina = false, $Pagina = false, $GrupoNombre = false, $Order = false) { //Listar grupos
        $cr = array(
            "grupos.GrupoId",
            "GrupoRango",
            "GrupoNombre",
            "GrupoDescripcion",
            "COUNT(usuarios.GrupoId) as Integrantes",
        );
        $this->dbc->select(implode(",",$cr)); 

        if ($GrupoNombre){
            $this->dbc->where('GrupoNombre Like', '%' . $GrupoNombre . '%');
            $this->dbc->or_where('GrupoDescripcion Like', '%' . $GrupoNombre . '%');
        }

        $this->dbc->join('usuarios', 'usuarios.GrupoId = grupos.GrupoId', 'left');
        
        switch($Order){
            case "GrupoRango":
                $this->dbc->order_by("GrupoRango", "desc");
            break;

            default:
                $this->dbc->order_by("GrupoId", "desc");
        }

        $this->dbc->group_by("GrupoId");

        if((!empty($MaximoPorPagina) || $MaximoPorPagina == 0) && (!empty($Pagina) || $Pagina==0)){$this->dbc->limit($MaximoPorPagina, $Pagina);}
        
        return  $this->dbc->get('grupos')->result();
    }

    public function getTotal($GrupoNombre = false) { //Contar total de grupos
        $this->dbc->from('grupos');
        
        if ($GrupoNombre){
            $this->dbc->where('GrupoNombre Like', '%' . $GrupoNombre . '%');
            $this->dbc->or_where('GrupoDescripcion Like', '%' . $GrupoNombre . '%');
            return $this->dbc->count_all_results();
        }

        return $this->dbc->count_all_results();
    }

    public function addGrupo($Grupo) { //Dar de alta nuevo grupo   
        $data = array(
            'GrupoNombre' => $Grupo->GrupoNombre,
            'GrupoDescripcion' => $Grupo->GrupoDescripcion,
            'GrupoRango' => $Grupo->GrupoRango
        );

        $this->dbc->insert('grupos', $data);
        
        if($this->dbc->affected_rows()>0){
            return array("GrupoId" => $this->dbc->insert_id());
        }else{
            return false;
        }
    }

    public function editGrupo($Nick, $Grupo) { //Editar grupo
         $data = array(
            'GrupoNombre' => $Grupo->GrupoNombre,
            'GrupoDescripcion' => $Grupo->GrupoDescripcion,
            'GrupoRango' => $Grupo->GrupoRango
        );

        $this->dbc->where('GrupoNombre', $Nick);
        $this->dbc->update('grupos', $data);
        
        return true;
    }

    public function delGrupo($GrupoId){ //Eliminar grupo
        $this->dbc->where('GrupoId',$GrupoId);
        $this->dbc->delete('grupos');

        if($this->dbc->affected_rows()>0){
            $this->dbc->where('GrupoId',$GrupoId);
            $this->dbc->update('usuarios',array('GrupoId' => 0));

            $this->dbc->where('GrupoId',$GrupoId);
            $this->dbc->delete('grupos_roles');

            return true;
        }else{
            return false;
        }
    }

}