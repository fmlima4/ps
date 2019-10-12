<?php

class demograficosModel extends CI_Model {

	var $table = "questionario_demografico";

	function __construct() {
		parent::__construct();
	}

	function inserir($data) {
		return $this->db->insert('questionario_demografico', $data);
	}

	function listar($sort = 'id_demografico', $order = 'asc', $limit =null, $offset = null) {
		$this->db->order_by($sort, $order);

		if($limit){
			$this->db->limit($limit,$offset);
		}

		$this->db->select('titulo, descricao, id_demografico, tipo');
	 	$this->db->from('questionario_demografico');
		$query = $this->db->get(); 
	    return $query->result();
	}

	function countAll(){
		return $this->db->count_all($this->table);
	}

	function editar($id_demografico) {
	    $this->db->where('id_demografico', $id_demografico);
	    $query = $this->db->get('questionario_demografico');
	    return $query->result();
	}
	 
	function atualizar($data) {
	    $this->db->where('id_demografico', $data['id_demografico']);
	    $this->db->set($data);
	    return $this->db->update('questionario_demografico');
	}
	 
	function deletar($id_demografico) {
    $this->db->where('id_demografico', $id_demografico);    
    $db_debug = $this->db->db_debug; //salve a configuração
    $this->db->db_debug = FALSE; //desabilita o debug para consultas

    if ( !$this->db->delete('demografico') )
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
		
		$this->db->select('nome, telefone, id_demografico, cidade');
		$this->db->from('demografico');
		$this->db->like('nome', $termo1);
		$query = $this->db->get(); 
		return $query->result();
		}

}

?>
