<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formularios extends CI_Controller {

	function __construct() {
		parent::__construct();
		/* Carrega o modelo */
		$this->load->model('formulariosModel', 'model', TRUE);
		$ci = & get_instance();
	}
		
	function index()
	{
		$this->template->set('title', 'Lista de Formularios Cadastrados');

		$config = array(
			"base_url" => base_url('fomularios/p'),
			"per_page" => 9,
			"num_links" => 3,
			"uri_segment" => 3,
			"total_rows" => $this->model->countAll(),
			"full_tag_open" => "<ul class='pagination'>",
			"full_tag_close" => "</ul>",
			"first_link" => FALSE,
			"last_link" => FALSE,
			"first_tag_open" => "<li>",
			"first_tag_close" => "</li>",
			"prev_link" => "Anterior",
			"prev_tag_open" => "<li class='prev'>",
			"prev_tag_close" => "</li>",
			"next_link" => "Pr�xima",
			"next_tag_open" => "<li class='next'>",
			"next_tag_close" => "</li>",
			"last_tag_open" => "<li>",
			"last_tag_close" => "</li>",
			"cur_tag_open" => "<li class='active'><a href='#'>",
			"cur_tag_close" => "</a></li>",
			"num_tag_open" => "<li>",
			"num_tag_close" => "</li>"
			);

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();

		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3):0;


		$data['formulario'] = $this->model->listar('id_formulario','asc', $config['per_page'],$offset);
		$this->template->load('layout', 'formularios_lista.phtml', $data);
	}

	function novo_formulario(){
		$this->template->set('title', 'Inserir Formulario');
		$this->template->load('layout', 'formulario_insert.phtml');
	}

	function gerar_formulario(){
		$data['formulario'] = $this->model->listar('id_formulario','asc');
		$this->template->set('title', 'Inserir Formulario');
		$this->template->load('layout', 'gerar_formulario.phtml',$data);
	}

	function lista_formularios(){
		$data['formulario'] = $this->model->listar('id_formulario','asc');

	}

	function inserir() {

		$this->template->set('title', 'Inserir Formulario');
		/* Carrega a biblioteca do CodeIgniter respons�vel pela valida��o dos formul�rios */
		$this->load->library('form_validation');
	
		/* Define as tags onde a mensagem de erro ser� exibida na p�gina */
		$this->form_validation->set_error_delimiters('<span>', '</span>');
	
		/* Define as regras para valida��o */
		$this->form_validation->set_rules('titulo', 'Titulo', 'required|max_length[40]');
		$this->form_validation->set_rules('descricao', 'Descricao', 'trim|required|max_length[20]');

		/* Executa a valida��o e caso houver erro chama a fun��o index do controlador */
		if ($this->form_validation->run() === FALSE) {
			
			$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> preencha todos os campos antes de salvar </div>");
				redirect('formularios');
			/* Sen�o, caso sucesso: */
		} else {

			/* Recebe os dados do formul�rio (vis�o) */
			$data['titulo'] = ucwords($this->input->post('titulo'));
			$data['descricao'] = ucwords($this->input->post('descricao'));
			$data['conteudo'] = $this->input->post('conteudo_ck');
						
			/* Chama a fun��o inserir do modelo */
			if ($this->model->inserir($data)) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-success'> Cliente salvo com sucesso</div>");
				redirect('formularios');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao inserir cliente</div>");
				redirect('formularios');
			}

		}
	}
	
	function editar($id_formulario)  {
			
		/* Aqui vamos definir o t�tulo da p�gina de edi��o */
		$this->template->set('title', 'Editar Formulario');
	 
		/* Busca os dados da pessoa que ser� editada */
		$data['dados_formulario'] = $this->model->editar($id_formulario);
	 
	 	/* Carrega a p�gina de edi��o com os dados da pessoa */
		$this->template->load('layout', 'formulario_edit.phtml', $data);

	}

	function atualizar() {
 
		/* Carrega a biblioteca do CodeIgniter respons�vel pela valida��o dos formul�rios */
		$this->load->library('form_validation');
	 
		/* Define as tags onde a mensagem de erro ser� exibida na p�gina */
		$this->form_validation->set_error_delimiters('<span>', '</span>');
	 
		/* Aqui estou definindo as regras de valida��o do formul�rio, assim como 
		   na fun��o inserir do controlador, por�m estou mudando a forma de escrita */
			 $this->form_validation->set_rules('titulo', 'Titulo', 'required|max_length[40]');
	
		/* Executa a valida��o e caso houver erro chama a fun��o editar do controlador novamente */
		if ($this->form_validation->run() === FALSE) {
	            	$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> preencha todos os campos antes de salvar </div>");
				redirect('formularios');
		} else 
			/* Sen�o obt�m os dados do formul�rio */
			$data['id_formulario'] = ucwords($this->input->post('id_formulario'));
			$data['titulo'] = ucwords($this->input->post('titulo'));
			$data['descricao'] = ucwords($this->input->post('descricao'));
			$data['conteudo'] = $this->input->post('conteudo_edit_ck');	 
			/* Executa a fun��o atualizar do modelo passando como par�metro os dados obtidos do formul�rio */
			if ($this->model->atualizar($data)) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-success'> Formulario editado com sucesso</div>");
				redirect('formularios');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao editar Formulario</div>");
			}
		}
	
	function deletar($id_formulario) {
	 					
		/* Executa a fun��o deletar do modelo passando como par�metro o id da pessoa */
		$confirmacao = $this->model->deletar($id_formulario);
		if ($confirmacao == 1) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-warning'> Formulario deletado com sucesso</div>");
			redirect('formularios');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao deletar Formulario</div>");
					redirect('formularios');
			}
	}


	public function pesquisar1() {

		$this->template->set('title', 'Resultado');

		$data['pagination'] = "";

		$data['cliente'] = $this->model->search1();
		
		$this->template->load('layout', 'clientes_lista.phtml', $data);
	}

	function fetch() {
		
		echo $this->model->fetch_data($this->uri->segment(3));
	}


}


?>