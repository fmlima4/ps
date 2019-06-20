<?php

class clientesModel extends CI_Model {

	var $table = "cliente";

	function __construct() {
		parent::__construct();
	}

	function inserir($data) {
		return $this->db->insert('cliente', $data);
	}

	function listar($sort = 'id_cliente', $order = 'asc', $limit =null, $offset = null) {
		$this->db->order_by($sort, $order);

		if($limit){
			$this->db->limit($limit,$offset);
		}

		$this->db->select('nome, telefone, id_cliente, cidade,');
	 	$this->db->from('cliente');
		$query = $this->db->get(); 
	    return $query->result();
	}

	function countAll(){
		return $this->db->count_all($this->table);
	}

	function editar($id_cliente) {
	    $this->db->where('id_cliente', $id_cliente);
	    $query = $this->db->get('cliente');
	    return $query->result();
	}
	 
	function atualizar($data) {
	    $this->db->where('id_cliente', $data['id_cliente']);
	    $this->db->set($data);
	    return $this->db->update('cliente');
	}
	 
	function deletar($id_cliente) {
    $this->db->where('id_cliente', $id_cliente);    
    $db_debug = $this->db->db_debug; //salve a configuração
    $this->db->db_debug = FALSE; //desabilita o debug para consultas

    if ( !$this->db->delete('cliente') )
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

	function novo_documento($id_cliente) {
	    $this->db->where('id_cliente', $id_cliente);
	    $query = $this->db->get('cliente');
	    return $query->result();
	}

	function inserir_documento($data) {
		return $this->db->insert('fomularios_cliente', $data);
	}

	function listar_documentos($id_cliente) {
		$this->db->select('id, formulario, cliente,fomularios_cliente.data_inclusao');
		$this->db->where('id_cliente', $id_cliente);
		$this->db->from('cliente');
		$this->db->join('fomularios_cliente', 'fomularios_cliente.cliente = cliente.id_cliente');
		$query = $this->db->get(); 
	    return $query->result();
	}

}

?>