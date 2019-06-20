<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<? echo base_url('includes/bootstrap/css/bootstrap.min.css') ?>">
 
<!-- Latest compiled and minified JavaScript -->
<script src="<? echo base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
}
