<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questoes extends CI_Controller {

	function __construct() {
		parent::__construct();
		/* Carrega o modelo */
		$this->load->model('questoesModel', 'model', TRUE);
		$ci = & get_instance();
	}
		
	function index()
	{
		$this->template->set('title', 'Lista de Questoes');

		$config = array(
			"base_url" => base_url('questoes/p'),
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


		$data['questao'] = $this->model->listar('id_questao','asc', $config['per_page'],$offset);
		$this->template->load('layout', 'questao_lista.phtml', $data);
	}

	function inserir() {

		$this->template->set('title', 'Inserir Questão');
		/* Carrega a biblioteca do CodeIgniter respons�vel pela valida��o dos formul�rios */
		$this->load->library('form_validation');
	
		/* Define as tags onde a mensagem de erro ser� exibida na p�gina */
		$this->form_validation->set_error_delimiters('<span>', '</span>');
	
		/* Define as regras para valida��o */
		$this->form_validation->set_rules('titulo', 'titulo', 'required|max_length[40]');
		$this->form_validation->set_rules('descricao', 'descrição', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tipo', 'tipo', 'trim|required|max_length[20]');


		/* Executa a valida��o e caso houver erro chama a fun��o index do controlador */
		if ($this->form_validation->run() === FALSE) {
			
			$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> preencha todos os campos antes de salvar </div>");
				redirect('questoes');
			/* Sen�o, caso sucesso: */
		} else {

			/* Recebe os dados do formul�rio (vis�o) */
			$data['titulo'] = ucwords($this->input->post('titulo'));
			$data['descricao'] = ucwords($this->input->post('descricao'));
			$data['tipo'] = ucwords($this->input->post('tipo'));

			
			/* Chama a fun��o inserir do modelo */
			if ($this->model->inserir($data)) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-success'> Questao salva com sucesso</div>");
				redirect('questoes');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao inserir cliente</div>");
				redirect('questoes');
			}

		}
	}
	
	function editar($id_questao)  {
			
		/* Aqui vamos definir o t�tulo da p�gina de edi��o */
		$this->template->set('title', 'Editar questoes');
	 
		/* Busca os dados da pessoa que ser� editada */
		$data['dados_questao'] = $this->model->editar($id_questao);
	 
	 	/* Carrega a p�gina de edi��o com os dados da pessoa */
		$this->template->load('layout', 'questao_edit.phtml', $data);

	}

	function atualizar() {
 
		/* Carrega a biblioteca do CodeIgniter respons�vel pela valida��o dos formul�rios */
		$this->load->library('form_validation');
	 
		/* Define as tags onde a mensagem de erro ser� exibida na p�gina */
		$this->form_validation->set_error_delimiters('<span>', '</span>');
	 
		/* Aqui estou definindo as regras de valida��o do formul�rio, assim como 
		   na fun��o inserir do controlador, por�m estou mudando a forma de escrita */
			 $this->form_validation->set_rules('titulo', 'titulo', 'required|max_length[40]');
			 $this->form_validation->set_rules('descricao', 'descrição', 'trim|required|max_length[20]');
			 $this->form_validation->set_rules('tipo', 'tipo', 'trim|required|max_length[20]');
	
		/* Executa a valida��o e caso houver erro chama a fun��o editar do controlador novamente */
		if ($this->form_validation->run() === FALSE) {
	            	$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> preencha todos os campos antes de salvar </div>");
				redirect('questoes');
		} else 
			/* Sen�o obt�m os dados do formul�rio */
			$data['id_questao'] = ucwords($this->input->post('id_questao'));
			$data['titulo'] = ucwords($this->input->post('titulo'));
			$data['descricao'] = ucwords($this->input->post('descricao'));
			$data['tipo'] = ucwords($this->input->post('tipo'));
			
	 
			/* Executa a fun��o atualizar do modelo passando como par�metro os dados obtidos do formul�rio */
			if ($this->model->atualizar($data)) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-success'> Questão editada com sucesso</div>");
				redirect('questoes');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao editar Questão</div>");
			}
		}
	
	function deletar($id_questao) {
	 					
		/* Executa a fun��o deletar do modelo passando como par�metro o id da pessoa */
		$confirmacao = $this->model->deletar($id_questao);
		if ($confirmacao == 1) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-warning'> Questão deletado com sucesso</div>");
			redirect('questoes');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao deletar Questão</div>");
					redirect('questoes');
			}
	}


	public function pesquisar1() {

		$this->template->set('title', 'Resultado');

		$data['pagination'] = "";

		$data['cliente'] = $this->model->search1();
		
		$this->template->load('layout', 'clientes_lista.phtml', $data);
	}

}


?>
