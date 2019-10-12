<?php if (! defined('BASEPATH')) exit('No direct script access allowed'); // linha de proteção ao controller
 
class Login extends CI_Controller{ // criação da classe Login
  
 public function index()
    {
        $this->load->view('welcome_message');
        $usuario = array('username'=>'not_autorized');
        $this->session->set_userdata('usuario_logado', $usuario);
    }

    public function autenticar(){
 
        $this->load->model("usuarios_model");// chama o modelo usuarios_model
        $email = $this->input->post("email");// pega via post o email que venho do formulario
        $password = $this->input->post("password"); // pega via post a senha que venho do formulario
        $usuario = $this->usuarios_model->buscaPorEmailSenha($email,$password); // acessa a função buscaPorEmailSenha do modelo
         
        if($usuario){
            $this->session->set_userdata('usuario_logado', $usuario);
            Redirect('http://localhost/ps/usuarios');
        }else{
             $this->session->set_flashdata('alert', 'Usuario ou senha incorretos');
                }
                
        Redirect('http://localhost/ps/');
    }

    public function logout(){
    session_destroy(); //pei!!! destruimos a sessão 
    session_unset();
    echo "<script>alert('Você realizou logout!');top.location.href='http://localhost/ps/';</script>"; 
    }

    public function cadastro() {

        $this->load->model("usuarios_model");// chama o modelo usuarios_model

		/* Carrega a biblioteca do CodeIgniter respons�vel pela valida��o dos formul�rios */
		$this->load->library('form_validation');
	
		/* Define as tags onde a mensagem de erro ser� exibida na p�gina */
		$this->form_validation->set_error_delimiters('<span>', '</span>');
	
		/* Define as regras para valida��o */
		$this->form_validation->set_rules('nome_usuario', 'nome_usuario', 'required|max_length[40]');
		$this->form_validation->set_rules('email_usuario', 'email_usuario', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|max_length[20]');


		/* Executa a valida��o e caso houver erro chama a fun��o index do controlador */
		if ($this->form_validation->run() === FALSE) {
			
			$this->session->set_flashdata('mensagem', "<div class='alert alert-danger'> preencha todos os campos antes de salvar </div>");
				redirect('usuarios');
			/* Sen�o, caso sucesso: */
		} else {

			/* Recebe os dados do formul�rio (vis�o) */
			$data['email_usuario'] = ucwords($this->input->post('email_usuario'));
            $data['nome_usuario'] = ucwords($this->input->post('nome_usuario'));
            $data['password'] = $this->input->post('password');		
            $data['tipo_usuario'] = $this->input->post('tipo_usuario');
            $data['sexo'] = $this->input->post('sexo_select');		
			$data['idade'] = ucwords($this->input->post('idade'));		

			
			/* Chama a fun��o inserir do modelo */
			if ($this->usuarios_model->inserir($data)) {
                echo "<script>alert('Você se cadastrou com sucesso');top.location.href='http://localhost/ps/';</script>";
			} else {
                echo "<script>alert('Usuario nao cadastrado');top.location.href='http://localhost/ps/';</script>";
			}

		}
	}


}
