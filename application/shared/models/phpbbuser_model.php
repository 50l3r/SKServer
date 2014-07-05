<?php
class Phpbbuser_model extends CI_Model {
	var $dbf;

	public function __construct(){
		$this->dbf = $this->load->database('foro', TRUE);
	}

	public function get_user($UsuarioNombre){
		$query = $this->dbf->get_where('phpbb_users', array('username_clean' => strtolower($UsuarioNombre)));
		$datos = $query->result();

		if (!isset($datos) or count($datos) == 0)
            return false;
        return $datos[0];
	}

	public function countTemas($user_id){
		
		$this->dbf->where('topic_poster', $user_id); 
		$this->dbf->where_in('forum_id',array(4,7,8,9,10,12,22,36));
		
		$this->dbf->from('phpbb_topics');
		return $this->dbf->count_all_results();
	}
	
	public function countPost($user_id){
		
		$this->dbf->where('poster_id', $user_id); 
		$this->dbf->where_in('forum_id',array(4,5,7,8,9,10,11,12,22,36));
		
		$this->dbf->from('phpbb_posts');
		return $this->dbf->count_all_results();
	}

	public function getUsersByGroup($groupId){
        $query = $this->dbf->get_where('phpbb_users', array('group_id' => $groupId));
		$datos = $query->result();

		if (!isset($datos) or count($datos) == 0)
            return false;
        return $datos;
    }
        
    public function getInactiveUsers(){
        $query = $this->dbf->get_where('phpbb_users', array('user_type' => 1));
		$datos = $query->result();

		if (!isset($datos) or count($datos) == 0)
            return false;
        return $datos;
    }
}
?>