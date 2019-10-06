<?php

class usuariosModel extends CI_Model {

	var $table = "users";

	function __construct() {
		parent::__construct();
	}

	function inserir($data) {
		return $this->db->insert('users', $data);
	}

	function listar($sort = 'id_usuario', $order = 'asc', $limit =null, $offset = null) {
		$this->db->order_by($sort, $order);

		if($limit){
			$this->db->limit($limit,$offset);
		}

		$this->db->select('id_usuario, nome_usuario,email_usuario, tipo_usuario');
	 	$this->db->from('users');
		$query = $this->db->get(); 
	    return $query->result();
	}

	function countAll(){
		return $this->db->count_all($this->table);
	}

	function editar($id_usuario_usuario) {
	    $this->db->where('id_usuario', $id_usuario_usuario);
	    $query = $this->db->get('users');
	    return $query->result();
	}
	 
	function atualizar($data) {
	    $this->db->where('id_usuario', $data['id_usuario']);
	    $this->db->set($data);
	    return $this->db->update('users');
	}
	 
	function deletar($id_usuario_usuario) {
    $this->db->where('id_usuario', $id_usuario_usuario);    
    $db_debug = $this->db->db_debug; //salve a configuração
    $this->db->db_debug = FALSE; //desabilita o debug para consultas

    if ( !$this->db->delete('users') )
    {
        $error = $this->db->error();

        $this->session->set_flashdata('mensagemErro', "<div class='alert alert-warning'> Cliente nao pode ser deletado pois existe um documento referenciado !!</div>");

        $this->db->db_debug = $db_debug; //restaure a configuração de debug
    }

    if($this->db->affected_rows() == 1){
		return 1;
		} else{
		return 0;
		}
    
	}

	function busca_users($data) {
		$this->db->select('username');
		$this->db->where('id_usuario', $data);
		$query = $this->db->get('users')->result_array(); 
	    return $query;
	}

	public function search1(){

		$termo1 = $this->input->post('search1');
		
		$this->db->select('username');
		$this->db->from('users');
		$this->db->like('username', $termo1);
		$query = $this->db->get(); 
		return $query->result();
		}

}

?>
