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

		/* Executa a valida��o e caso houver erro chama a fun��o index do controlador */
		if ($this->form_validation->run() === FALSE) {
			
			$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> preencha todos os campos antes de salvar </div>");
				redirect('questoes');
			/* Sen�o, caso sucesso: */
		} else {

			/* Recebe os dados do formul�rio (vis�o) */
			$data['titulo'] = ucwords($this->input->post('titulo'));
			$data['descricao'] = ucwords($this->input->post('descricao'));
			
			
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
	
	function editar($id_cliente)  {
			
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
	
		/* Executa a valida��o e caso houver erro chama a fun��o editar do controlador novamente */
		if ($this->form_validation->run() === FALSE) {
	            	$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> preencha todos os campos antes de salvar </div>");
				redirect('questoes');
		} else 
			/* Sen�o obt�m os dados do formul�rio */
			$data['id_cliente'] = ucwords($this->input->post('id_cliente'));
			$data['nome'] = ucwords($this->input->post('nome'));
			$data['titulo'] = ucwords($this->input->post('titulo'));
			$data['descricao'] = ucwords($this->input->post('descricao'));
			
	 
			/* Executa a fun��o atualizar do modelo passando como par�metro os dados obtidos do formul�rio */
			if ($this->model->atualizar($data)) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-success'> Questão editada com sucesso</div>");
				redirect('clientes');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao editar cliente</div>");
			}
		}
	
	function deletar($ccod) {
	 					
		/* Executa a fun��o deletar do modelo passando como par�metro o id da pessoa */
		$confirmacao = $this->model->deletar($ccod);
		if ($confirmacao == 1) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-warning'> Cliente deletado com sucesso</div>");
			redirect('clientes');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao deletar cliente</div>");
					redirect('clientes');
			}
	}


	function novo_documento($id_cliente)  {
		
		$this->template->set('title', 'Adicionar Formuario');
	 
		/* Busca os dados da pessoa que ser� editada */
		$data['dados_cliente'] = $this->model->novo_documento($id_cliente);
	 
	 	/* Carrega a p�gina de edi��o com os dados da pessoa */
		$this->template->load('layout', 'gerar_formulario.phtml', $data);

	}

	function insere_novo_documento()  {
		
		/* Carrega a biblioteca do CodeIgniter respons�vel pela valida��o dos formul�rios */
		$this->load->library('form_validation');
	 
		/* Define as tags onde a mensagem de erro ser� exibida na p�gina */
		$this->form_validation->set_error_delimiters('<span>', '</span>');
	 
		/* Aqui estou definindo as regras de valida��o do formul�rio, assim como 
		   na fun��o inserir do controlador, por�m estou mudando a forma de escrita */
			 $this->form_validation->set_rules('nome', 'Cliente', 'required');
			 $this->form_validation->set_rules('formulario', 'Formulario', 'trim|required');
			 
	
		/* Executa a valida��o e caso houver erro chama a fun��o editar do controlador novamente */
		if ($this->form_validation->run() === FALSE) {
	            	$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> preencha todos os campos antes de salvar </div>");
				redirect('clientes');
		} else 
			//busca daddos para realizar a subistitiuição de campos
			$dados_paciente = $this->model->busca_cliente($this->input->post('id_cliente'));
			$dados_formulario = $this->model->busca_formulario($this->input->post('formulario'));		
			//variaveis procuradas no conteudo do formulario que podem ser substituidas
			$nome = "{nome}";
			$cpf = "{cpf}";

			//faz a substituição
			$conteudo_nome = str_replace($nome, $dados_paciente[0]['nome'], $dados_formulario[0]['conteudo']);
			$conteudo_cpf = str_replace($cpf,$dados_paciente[0]['cpf'],$conteudo_nome);

			$conteudo_final = $conteudo_cpf;

			//dados a serem salvo na tabela fomrularios_cliente
			$data['cliente'] = $this->input->post('id_cliente');
			$data['formulario'] = $this->input->post('formulario');
			$data['data_inclusao'] = date("Y-m-d"); 
			$data['conteudo'] = $conteudo_final;
			
			/* Executa a fun��o atualizar do modelo passando como par�metro os dados obtidos do formul�rio */
			if ($this->model->inserir_documento($data)) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-success'> Cliente editado com sucesso</div>");
				redirect('clientes');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao editar cliente</div>");
		}
	}

	function historico($id_cliente)
	{
		$this->template->set('title', 'Lista de documentos');
		$data['documentos_cliente'] = $this->model->listar_documentos($id_cliente);
		$this->template->load('layout', 'documentos_cliente.phtml', $data);
	}

	function baixar_doc($id_cliente)
	{
	
	}

	public function pesquisar1() {

		$this->template->set('title', 'Resultado');

		$data['pagination'] = "";

		$data['cliente'] = $this->model->search1();
		
		$this->template->load('layout', 'clientes_lista.phtml', $data);
	}

}


?>
