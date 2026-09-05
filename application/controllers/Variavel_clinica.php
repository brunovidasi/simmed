<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Variavel_clinica extends CI_Controller {

	public function index(){
		
		$this->lista();
	}

	function lista(){

		$dados['menu'] = "variavel_clinica";
		$dados['variavel_clinicas'] = $this->variavel_clinica_model->get_variavel_clinicas()->result();

		$dados['view'] = $this->load->view('variavel_clinica/lista', $dados, TRUE);

		$this->load->view('includes/interna', $dados);

	}

	function cadastrar(){

		$dados['menu'] = "variavel_clinica";

		$dados['view'] = $this->load->view('variavel_clinica/cadastrar', $dados, TRUE);

		$this->load->view('includes/interna', $dados);
	}

	function editar($variavel_clinica_id = null){

		if($variavel_clinica_id == null) redirect('/variavel_clinica/');

		$dados['menu'] = "variavel_clinica";
		$dados['variavel_clinica'] = $this->variavel_clinica_model->get_variavel_clinica($variavel_clinica_id);

		$custo_a = explode('.', $dados['variavel_clinica']->custo);

		if(!isset($custo_a[1]))
			$dados['variavel_clinica']->custo = $custo_a[0] . '.00';

		if(!isset($dados['variavel_clinica']->variavel_clinica_id)) redirect('/variavel_clinica/');

		$dados['view'] = $this->load->view('variavel_clinica/editar', $dados, TRUE);

		$this->load->view('includes/interna', $dados);
	}

	function insert(){

		if($this->valida_form('insert')){
	
			$data = $this->variavel_clinica_model->post('insert');
			$variavel_clinica_id = $this->variavel_clinica_model->insert($data);
		
			if($variavel_clinica_id > 0){
				$this->session->set_flashdata('mensagem_sucesso', 'Cadastro efetuado com sucesso.');
				redirect('/variavel_clinica/');
			}

			$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> efetuado. Tente novamente.');
			redirect('/variavel_clinica/cadastrar/');
		}
		$this->cadastrar();
	}

	function update($variavel_clinica_id){

		if(!empty($variavel_clinica_id)){
			if($this->valida_form('update', $variavel_clinica_id)){
				
				$data = $this->variavel_clinica_model->post('update');	
				$atualizado = $this->variavel_clinica_model->update($variavel_clinica_id, $data);
				
				if($atualizado){
					$this->session->set_flashdata('mensagem_sucesso', 'Cadastro atualizado com sucesso.');
					redirect('/variavel_clinica/');
				}

				$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> atualizado. Tente novamente.');
				redirect('/variavel_clinica/editar/'.$variavel_clinica_id);
			}
			$this->editar($variavel_clinica_id);
			
		}
	}
	
	function excluir($variavel_clinica_id, $ativar = 0){

		$excluido = $this->variavel_clinica_model->delete($variavel_clinica_id);
		
		if($excluido){
			$this->session->set_flashdata('mensagem_sucesso', 'Cadastro excluido com sucesso.');
			redirect('/variavel_clinica/');
		}

		$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> excluido, tente novamente.');
		redirect('/variavel_clinica/');
	}
	
	private function valida_form($method = "insert", $variavel_clinica_id = 0){


		if($method == "insert"){

			$this->form_validation->set_rules('nome', 			'Nome', 					'trim|required');
			// $this->form_validation->set_rules('comando', 		'Comando', 					'trim|required|is_unique[variavel_clinica.comando]');
			$this->form_validation->set_rules('comando');
			$this->form_validation->set_rules('custo');

		}else{

			$this->form_validation->set_rules('nome', 			'Nome', 					'trim|required');
			$this->form_validation->set_rules('custo');

			$comando = $this->input->post('comando', TRUE);

			$variavel_clinica = $this->variavel_clinica_model->get_variavel_clinica($variavel_clinica_id);

			if($variavel_clinica->comando == $comando)
				$this->form_validation->set_rules('comando', 		'Comando', 					'trim|required');
			else{
				$this->form_validation->set_rules('comando');
				// $this->form_validation->set_rules('comando', 		'Comando', 					'trim|required|is_unique[variavel_clinica.comando]');
			}

		}

		return $this->form_validation->run();
	}

}
