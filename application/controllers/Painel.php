<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');     
    } 

	public function index(){

		$this->painel();
		
	}

	public function painel(){

		$dados['menu'] = 'painel';

		// $dados['view'] = $this->load->view('painel/painel', $dados, TRUE);
		$dados['view'] = "";

		$this->load->view('includes/interna', $dados);

	}

	public function info(){

		echo '<pre>';
		print_r($this->session->userdata('usuario'));
		echo '</pre>';
		die();
	}

}
