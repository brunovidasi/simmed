<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidade extends CI_Controller {

	public function index(){
		
		$this->lista();
	}

	function lista(){

		$dados['menu'] = "especialidade";
		$dados['especialidades'] = $this->especialidade_model->get_especialidades()->result();

		$dados['view'] = $this->load->view('especialidade/lista', $dados, TRUE);

		$this->load->view('includes/interna', $dados);

	}

	function cadastrar(){

		$dados['menu'] = "especialidade";

		$dados['view'] = $this->load->view('especialidade/cadastrar', $dados, TRUE);

		$this->load->view('includes/interna', $dados);
	}

	function editar($especialidade_medica_id = null){

		if($especialidade_medica_id == null) redirect('/especialidade/');

		$dados['menu'] = "especialidade";
		$dados['especialidade'] = $this->especialidade_model->get_especialidade($especialidade_medica_id);

		if(!isset($dados['especialidade']->especialidade_medica_id)) redirect('/especialidade/');

		$dados['view'] = $this->load->view('especialidade/editar', $dados, TRUE);

		$this->load->view('includes/interna', $dados);
	}

	function insert(){

		if($this->valida_form('insert')){
	
			$data = $this->especialidade_model->post('insert');
			$especialidade_medica_id = $this->especialidade_model->insert($data);
		
			if($especialidade_medica_id > 0){
				$this->session->set_flashdata('mensagem_sucesso', 'Cadastro efetuado com sucesso.');
				redirect('/especialidade/');
			}

			$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> efetuado. Tente novamente.');
			redirect('/especialidade/cadastrar/');
		}
		$this->cadastrar();
	}

	function update($especialidade_medica_id){

		if(!empty($especialidade_medica_id)){
			if($this->valida_form('update', $especialidade_medica_id)){
				
				$data = $this->especialidade_model->post('update');	
				$atualizado = $this->especialidade_model->update($especialidade_medica_id, $data);
				
				if($atualizado){
					$this->session->set_flashdata('mensagem_sucesso', 'Cadastro atualizado com sucesso.');
					redirect('/especialidade/');
				}

				$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> atualizado. Tente novamente.');
				redirect('/especialidade/editar/'.$especialidade_medica_id);
			}
			$this->editar($especialidade_medica_id);
			
		}
	}
	
	function excluir($especialidade_medica_id, $ativar = 0){

		$excluido = $this->especialidade_model->delete($especialidade_medica_id);
		
		if($excluido){
			$this->session->set_flashdata('mensagem_sucesso', 'Cadastro excluido com sucesso.');
			redirect('/especialidade/');
		}

		$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> excluido, tente novamente.');
		redirect('/especialidade/');
	}
	
	private function valida_form($method = "insert", $especialidade_medica_id = 0){


		if($method == "insert"){

			$this->form_validation->set_rules('nome', 			'Nome', 					'trim|required|is_unique[especialidade_medica.nome]');

		}else{

			$nome = $this->input->post('nome', TRUE);

			$especialidade = $this->especialidade_model->get_especialidade($especialidade_medica_id);

			if($especialidade->nome == $nome)
				$this->form_validation->set_rules('nome', 		'Nome', 					'trim|required');
			else
				$this->form_validation->set_rules('nome', 		'Nome', 					'trim|required|is_unique[especialidade_medica.nome]');

		}

		return $this->form_validation->run();
	}

}
