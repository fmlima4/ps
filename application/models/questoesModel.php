<?php

class questoesModel extends CI_Model {

	var $table = "questao";

	function __construct() {
		parent::__construct();
	}

	function inserir($data) {
		return $this->db->insert('questao', $data);
	}

	function listar($sort = 'id_questao', $order = 'asc', $limit =null, $offset = null) {
		$this->db->order_by($sort, $order);

		if($limit){
			$this->db->limit($limit,$offset);
		}

		$this->db->select('titulo, descricao, id_questao, tipo');
	 	$this->db->from('questao');
		$query = $this->db->get(); 
	    return $query->result();
	}

	function countAll(){
		return $this->db->count_all($this->table);
	}

	function editar($id_questao) {
	    $this->db->where('id_questao', $id_questao);
	    $query = $this->db->get('questao');
	    return $query->result();
	}
	 
	function atualizar($data) {
	    $this->db->where('id_questao', $data['id_questao']);
	    $this->db->set($data);
	    return $this->db->update('questao');
	}
	 
	function deletar($id_questao) {
    $this->db->where('id_questao', $id_questao);    
    $db_debug = $this->db->db_debug; //salve a configuração
    $this->db->db_debug = FALSE; //desabilita o debug para consultas

    if ( !$this->db->delete('questao') )
    {
        $error = $this->db->error();

        $this->session->set_flashdata('mensagemErro', "<div class='alert alert-warning'> Questao nao pode ser deletado pois existe um documento referenciado !!</div>");

        $this->db->db_debug = $db_debug; //restaure a configuração de debug
    }

    if($this->db->affected_rows() == 1){
		return 1;
		} else{
		return 0;
		}
    
	}

	public function search1(){

		$termo1 = $this->input->post('search1');
		
		$this->db->select('nome, telefone, id_questao, cidade');
		$this->db->from('questao');
		$this->db->like('nome', $termo1);
		$query = $this->db->get(); 
		return $query->result();
		}

}

?>
