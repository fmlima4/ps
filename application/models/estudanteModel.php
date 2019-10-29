<?php

class estudanteModel extends CI_Model {

	var $table = "users";

	function __construct() {
		parent::__construct();
    }
    
    function busca_estudante($id_usuario) {
        $this->db->select('users.id_usuario, 1 as demografico_preench');
		$this->db->where('users.id_usuario', $id_usuario);
		$this->db->from('users');
		$this->db->join('questionario_demografico', 'questionario_demografico.id_usuario = users.id_usuario');
		$query = $this->db->get(); 
	    return $query->result();
	}
	

}

?>
