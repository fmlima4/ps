<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demograficos extends CI_Controller {

	function __construct() {
		parent::__construct();
		/* Carrega o modelo */
		$this->load->model('demograficosModel', 'model', TRUE);
		$ci = & get_instance();
	}

	function index()  {
			
		/* Aqui vamos definir o t�tulo da p�gina de edi��o */
		$this->template->set('title', 'Questionario demografico');
	 
	 	/* Carrega a p�gina */
		$this->template->load('layout', 'demografico.phtml');

	}

	function respostas()
	{
		$this->template->set('title', 'Lista de Demograficos');

		$config = array(
			"base_url" => base_url('demograficos/p'),
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
			"next_link" => "Proxima",
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


		$data['demografico'] = $this->model->listar('id_questionario_demografico','asc', $config['per_page'],$offset);
		$this->template->load('layout', 'demografico_lista.phtml', $data);
	}

	function inserir() {
		/* Carrega a biblioteca do CodeIgniter respons�vel pela valida��o dos formul�rios */
		$this->load->library('form_validation');
	
		/* Define as tags onde a mensagem de erro ser� exibida na p�gina */
		$this->form_validation->set_error_delimiters('<span>', '</span>');
	
		/* Define as regras para valida��o */
		$this->form_validation->set_rules('nome_respondente', 'nome_respondente', 'required|max_length[40]');
		$this->form_validation->set_rules('idade_respondente', 'idade_respondente', 'trim|required|max_length[20]');
		

		/* Executa a valida��o e caso houver erro chama a fun��o index do controlador */
		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> preencha todos os campos antes de salvar </div>");
				redirect('demograficos');
			/* Sen�o, caso sucesso: */
		} else {
			$usuario = $this->session->userdata('usuario_logado'); 
			$data['id_usuario'] = $usuario['id_usuario'];
			$data['nome_respondente'] = ucwords($this->input->post('nome_respondente'));
			$data['idade_respondente'] = $this->input->post('idade_respondente');
			$data['ec_respondente'] = $this->input->post('ec_select');
			$data['cidade_respondente'] = $this->input->post('cidade_respondente');
			$data['qtd_automoveis'] = $this->input->post('qtd_automoveis');
			$data['qtd_empregados'] = $this->input->post('qtd_empregados');
			$data['qtd_maquina_lavar'] = $this->input->post('qtd_maquina_lavar');
			$data['qtd_banheiro'] = $this->input->post('qtd_banheiro');
			$data['qtd_dvd'] = $this->input->post('qtd_dvd');
			$data['qtd_geladeira'] = $this->input->post('qtd_geladeira');
			$data['qtd_freezer'] = $this->input->post('qtd_freezer');
			$data['qtd_pc'] = $this->input->post('qtd_pc');
			$data['qtd_lava'] = $this->input->post('qtd_lava');
			$data['qtd_micro'] = $this->input->post('qtd_micro');
			$data['qtd_moto'] = $this->input->post('qtd_moto');
			$data['qtd_secadora'] = $this->input->post('qtd_secadora');
			$data['origem_agua'] = $this->input->post('origem_agua');
			$data['tipo_rua'] = $this->input->post('tipo_rua');
			$data['renda'] = $this->input->post('renda');
			$data['escolaridade_chefe'] = $this->input->post('escolaridade_chefe_select');

			
			/* Chama a fun��o inserir do modelo */
			if ($this->model->inserir($data)) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-success'> Questionario salvo com sucesso</div>");
				redirect('demograficos');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro </div>");
				redirect('demograficos');
			}

		}
	}
	
	function editar($id_demografico)  {
			
		/* Aqui vamos definir o t�tulo da p�gina de edi��o */
		$this->template->set('title', 'visualizar resposta demografico');
	 
		/* Busca os dados da pessoa que ser� editada */
		$data['dados_demografico'] = $this->model->editar($id_demografico);
	 
	 	/* Carrega a p�gina de edi��o com os dados da pessoa */
		$this->template->load('layout', 'demografico_edit.phtml', $data);

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
				redirect('demograficos');
		} else 
			/* Sen�o obt�m os dados do formul�rio */
			$data['id_demografico'] = ucwords($this->input->post('id_demografico'));
			$data['titulo'] = ucwords($this->input->post('titulo'));
			$data['descricao'] = ucwords($this->input->post('descricao'));
			$data['tipo'] = ucwords($this->input->post('tipo'));
			
	 
			/* Executa a fun��o atualizar do modelo passando como par�metro os dados obtidos do formul�rio */
			if ($this->model->atualizar($data)) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-success'> Questão editada com sucesso</div>");
				redirect('demograficos');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao editar Questão</div>");
			}
		}
	
	function deletar($id_demografico) {
	 					
		/* Executa a fun��o deletar do modelo passando como par�metro o id da pessoa */
		$confirmacao = $this->model->deletar($id_demografico);
		if ($confirmacao == 1) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-warning'> Questão deletado com sucesso</div>");
			redirect('demograficos');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao deletar Questão</div>");
					redirect('demograficos');
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
