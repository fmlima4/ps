<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudante extends CI_Controller {

	function __construct() {
		parent::__construct();
		/* Carrega o modelo */
		$this->load->model('estudanteModel', 'model', TRUE);
		$ci = & get_instance();
	}

	function index()  {

        $data['dados_estudante'] = $this->model->busca_estudante($_SESSION['usuario_logado']['id_usuario']);

		/* Aqui vamos definir o t�tulo da p�gina de edi��o */
		$this->template->set('title', 'Bem vindo');
        
	 	/* Carrega a p�gina */
		$this->template->load('layout', 'estudante.phtml', $data);

    }

}


?>
