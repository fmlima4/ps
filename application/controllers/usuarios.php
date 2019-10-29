<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	function __construct() {
		parent::__construct();
		/* Carrega o modelo */
		$this->load->model('usuariosModel', 'model', TRUE);
		$ci = & get_instance();
	}
		
	function index()
	{
		$this->template->set('title', 'Lista de Usuarios');

		$config = array(
			"base_url" => base_url('usuarios/p'),
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


		$data['usuario'] = $this->model->listar('id_usuario','asc', $config['per_page'],$offset);
		$this->template->load('layout', 'usuarios_lista.phtml', $data);
	}

	function inserir() {

		$this->template->set('title', 'Inserir Usuarios');
		/* Carrega a biblioteca do CodeIgniter respons�vel pela valida��o dos formul�rios */
		$this->load->library('form_validation');
	
		/* Define as tags onde a mensagem de erro ser� exibida na p�gina */
		$this->form_validation->set_error_delimiters('<span>', '</span>');
	
		/* Define as regras para valida��o */
		$this->form_validation->set_rules('nome_usuario', 'nome_usuario', 'required|max_length[40]');
		$this->form_validation->set_rules('email_usuario', 'email_usuario', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tipo_usuario', 'tipo_usuario', 'trim|required|max_length[20]');


		/* Executa a valida��o e caso houver erro chama a fun��o index do controlador */
		if ($this->form_validation->run() === FALSE) {
			
			$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> preencha todos os campos antes de salvar </div>");
				redirect('usuarios');
			/* Sen�o, caso sucesso: */
		} else {

			/* Recebe os dados do formul�rio (vis�o) */
			$data['email_usuario'] = ucwords($this->input->post('email_usuario'));
			$data['nome_usuario'] = ucwords($this->input->post('nome_usuario'));
			$data['tipo_usuario'] = ucwords($this->input->post('tipo_usuario'));
			$data['password'] = ucwords($this->input->post('password'));		

			
			/* Chama a fun��o inserir do modelo */
			if ($this->model->inserir($data)) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-success'> usuario salvo com sucesso</div>");
				redirect('usuarios');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao inserir usuario</div>");
				redirect('usuarios');
			}

		}
	}
	
	function editar($id)  {
			
		/* Aqui vamos definir o t�tulo da p�gina de edi��o */
		$this->template->set('title', 'Editar Usuarios');
	 
		/* Busca os dados da pessoa que ser� editada */
		$data['dados_usuario'] = $this->model->editar($id);
	 
	 	/* Carrega a p�gina de edi��o com os dados da pessoa */
		$this->template->load('layout', 'usuarios_edit.phtml', $data);

	}

	function atualizar() {
 
		/* Carrega a biblioteca do CodeIgniter respons�vel pela valida��o dos formul�rios */
		$this->load->library('form_validation');
	 
		/* Define as tags onde a mensagem de erro ser� exibida na p�gina */
		$this->form_validation->set_error_delimiters('<span>', '</span>');
	 
		/* Aqui estou definindo as regras de valida��o do formul�rio, assim como 
		   na fun��o inserir do controlador, por�m estou mudando a forma de escrita */
			 $this->form_validation->set_rules('nome_usuario', 'nome_usuario', 'required|max_length[40]');
			 $this->form_validation->set_rules('email_usuario', 'email_usuario', 'trim|required|max_length[20]');
			 $this->form_validation->set_rules('password', 'password', 'trim|required|max_length[20]');
			 $this->form_validation->set_rules('tipo_usuario', 'tipo_usuario', 'trim|required|max_length[20]');
	 
	
		/* Executa a valida��o e caso houver erro chama a fun��o editar do controlador novamente */
		if ($this->form_validation->run() === FALSE) {
	            	$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> preencha todos os campos antes de salvar </div>");
				redirect('usuarios');
		} else 
			/* Sen�o obt�m os dados do formul�rio */
			$data['id_usuario'] = $this->input->post('id_usuario');
			$data['email_usuario'] = $this->input->post('email_usuario');
			$data['nome_usuario'] = $this->input->post('nome_usuario');
			$data['tipo_usuario'] = $this->input->post('tipo_usuario');
			$data['password'] = $this->input->post('password');		
			
	 
			/* Executa a fun��o atualizar do modelo passando como par�metro os dados obtidos do formul�rio */
			if ($this->model->atualizar($data)) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-success'> usuario editado com sucesso</div>");
				redirect('usuarios');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao editar usuario</div>");
			}
		}
	
	function deletar($id) {
	 					
		/* Executa a fun��o deletar do modelo passando como par�metro o id da pessoa */
		$confirmacao = $this->model->deletar($id);
		if ($confirmacao == 1) {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-warning'> usuario deletado com sucesso</div>");
			redirect('usuarios');
			} else {
				$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> Erro ao deletar usuario</div>");
					redirect('usuarios');
			}
	}

	public function pesquisar1() {

		$this->template->set('title', 'Resultado');

		$data['pagination'] = "";

		$data['usuario'] = $this->model->search1();
		
		$this->template->load('layout', 'usuarios_lista.phtml', $data);
	}

}


?>
