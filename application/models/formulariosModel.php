<?php

class formulariosModel extends CI_Model {

	var $table = "formulario";

	function __construct() {
		parent::__construct();
	}

	function inserir($data) {
		return $this->db->insert('formulario', $data);
	}

	function listar($sort = 'id_formulario', $order = 'asc', $limit =null, $offset = null) {
		$this->db->order_by($sort, $order);

		if($limit){
			$this->db->limit($limit,$offset);
		}

		$this->db->select('titulo, descricao, id_formulario, conteudo');
	 	$this->db->from('formulario');
		$query = $this->db->get(); 
	    return $query->result();
	}

	function countAll(){
		return $this->db->count_all($this->table);
	}

	function editar($id_formulario) {
	    $this->db->where('id_formulario', $id_formulario);
	    $query = $this->db->get('formulario');
	    return $query->result();
	}
	 
	function atualizar($data) {
	    $this->db->where('id_formulario', $data['id_formulario']);
	    $this->db->set($data);
	    return $this->db->update('formulario');
	}
	 
	function deletar($id_formulario) {
    $this->db->where('id_formulario', $id_formulario);    
    $db_debug = $this->db->db_debug; //salve a configuração
    $this->db->db_debug = FALSE; //desabilita o debug para consultas

    if ( !$this->db->delete('formulario') )
    {
        $error = $this->db->error();

        $this->session->set_flashdata('mensagemErro', "<div class='alert alert-warning'> Formulario nao pode ser deletado pois existe um orçamento referenciado !!</div>");

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
		$termo2 = $this->input->post('search2');
		$termo3 = $this->input->post('search3');
		
		if (empty($termo1 and $termo2 and $termo3)){
			$this->db->select('titulo, descricao, id_formulario, conteudo');
	 		$this->db->from('formulario');
			$query = $this->db->get(); 
		}

		return $query->result();

		}

	function get_cliente($q){
		$this->db->select('cnome,id_formulario');   
	    $this->db->like('nome', $q);
	    $this->db->group_by('nome');
	    $query = $this->db->get('formulario');
	    if($query->num_rows() > 0){
	      foreach ($query->result_array() as $row){
	        $new_row['label']=htmlentities(stripslashes($row['nome']));
	        $new_row['value']=htmlentities(stripslashes($row['id_cliente']));
	        $row_set[] = $new_row; //build an array
	      }
	      echo json_encode($row_set); //format the array into json data
	    }
	}

	public function GetRow($keyword) {        
        $this->db->order_by('nome', 'DESC');
        $this->db->like("nome", $keyword);
        return $this->db->get('cliente')->result_array();
	}
	
	function search_blog($title){
        $this->db->like('nome', $title , 'both');
        $this->db->order_by('nome', 'ASC');
        $this->db->limit(10);
        return $this->db->get('cliente')->result();
	}
	
	function fetch_data($query)	{
	$this->db->like('nome', $query);
		$query = $this->db->get('cliente');
		if($query->num_rows() > 0)		{
			foreach($query->result_array() as $row){
				$output[] = array('name'  => $row["nome"]);
			}
		echo json_encode($output);
		}
	}

}

?>