<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Caso_clinico extends CI_Controller {

	public function index(){
		
		$this->lista();
	}

	function lista(){

		$dados['menu'] = "caso_clinico";
		$dados['caso_clinicos'] = $this->caso_clinico_model->get_caso_clinicos()->result();

		$dados['view'] = $this->load->view('caso_clinico/lista', $dados, TRUE);

		$this->load->view('includes/interna', $dados);

	}

	function cadastrar(){

		$dados['menu'] = "caso_clinico";

		$dados['especialidades'] = $this->especialidade_model->get_especialidades()->result();
		$dados['usuarios'] = $this->usuario_model->get_usuarios()->result();
		$dados['variavel_clinicas'] = $this->variavel_clinica_model->get_variavel_clinicas()->result();

		$dados['view'] = $this->load->view('caso_clinico/cadastrar', $dados, TRUE);

		$this->load->view('includes/interna', $dados);
	}

	function editar($caso_clinico_id = null){

		if($caso_clinico_id == null) redirect('/caso_clinico/');

		$dados['menu'] = "caso_clinico";
		$dados['caso_clinico'] = $this->caso_clinico_model->get_caso_clinico($caso_clinico_id);

		$dados['casos'] = $this->caso_clinico_model->get_usuario_caso_clinicos($caso_clinico_id);
		$dados['variaveis'] = $this->variavel_clinica_model->get_variavel_clinica_caso_clinico($caso_clinico_id);

		$dados['area_secundarias'] = $this->caso_clinico_model->get_area_secundarias($caso_clinico_id)->result();
		$dados['grupos'] = $this->caso_clinico_model->get_usuarios($caso_clinico_id)->result();

		$dados['especialidades'] = $this->especialidade_model->get_especialidades()->result();
		$dados['usuarios'] = $this->usuario_model->get_usuarios()->result();
		$dados['variavel_clinicas'] = $this->variavel_clinica_model->get_variavel_clinicas()->result();

		// print_r($dados['casos']); die();

		if(!isset($dados['caso_clinico']->caso_clinico_id)) redirect('/caso_clinico/');

		$dados['view'] = $this->load->view('caso_clinico/editar', $dados, TRUE);

		$this->load->view('includes/interna', $dados);
	}

	function insert(){

		if($this->valida_form('insert')){
	
			$data = $this->caso_clinico_model->post('insert');
			$caso_clinico_id = $this->caso_clinico_model->insert($data);
		
			if($caso_clinico_id > 0){
				$this->session->set_flashdata('mensagem_sucesso', 'Cadastro efetuado com sucesso.');
				redirect('/caso_clinico/');
			}

			$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> efetuado. Tente novamente.');
			redirect('/caso_clinico/cadastrar/');
		}
		$this->cadastrar();
	}

	function update($caso_clinico_id){

		if(!empty($caso_clinico_id)){
			if($this->valida_form('update', $caso_clinico_id)){
				
				$data = $this->caso_clinico_model->post('update');	
				$atualizado = $this->caso_clinico_model->update($caso_clinico_id, $data);
				
				if($atualizado){
					$this->session->set_flashdata('mensagem_sucesso', 'Cadastro atualizado com sucesso.');
					redirect('/caso_clinico/');
				}

				$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> atualizado. Tente novamente.');
				redirect('/caso_clinico/editar/'.$caso_clinico_id);
			}
			$this->editar($caso_clinico_id);
			
		}
	}
	
	function excluir($caso_clinico_id, $ativar = 0){

		$excluido = $this->caso_clinico_model->delete($caso_clinico_id);
		
		if($excluido){
			$this->session->set_flashdata('mensagem_sucesso', 'Cadastro excluido com sucesso.');
			redirect('/caso_clinico/');
		}

		$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> excluido, tente novamente.');
		redirect('/caso_clinico/');
	}
	
	private function valida_form($method = "insert", $caso_clinico_id = 0){


		if($method == "insert"){

			$this->form_validation->set_rules('nome', 			'Nome', 			'trim|required|is_unique[caso_clinico.nome]');
			$this->form_validation->set_rules('numero', 		'Número', 			'trim|required|is_unique[caso_clinico.numero]');
			$this->form_validation->set_rules('cid', 			'CID', 				'trim|required');
			$this->form_validation->set_rules('diagnostico', 	'Diagnóstico', 		'trim|required');
			$this->form_validation->set_rules('prescricao', 	'Prescrição', 		'trim|required');
			$this->form_validation->set_rules('alta');
			$this->form_validation->set_rules('internacao');

			$this->form_validation->set_rules('usuarios[]', 	'Usuários', 		'trim|required');

			$this->form_validation->set_rules('variavel_clinica[]', 		'Variável Clínica', 		'trim|required');
			$this->form_validation->set_rules('texto[]', 					'Texto', 					'trim|required');
			$this->form_validation->set_rules('foto[]');
			$this->form_validation->set_rules('obrigatorio[]');

			$this->form_validation->set_rules('especialidade_principal', 	'Especialidade Principal', 	'trim|required');
			$this->form_validation->set_rules('especialidade_secundaria[]', 'Especialidade Secundária', 'trim|required');



		}else{

			$nome = $this->input->post('nome', TRUE);

			$caso_clinico = $this->caso_clinico_model->get_caso_clinico($caso_clinico_id);

			if($caso_clinico->nome == $nome)
				$this->form_validation->set_rules('nome', 		'Nome', 					'trim|required');
			else
				$this->form_validation->set_rules('nome', 		'Nome', 					'trim|required|is_unique[caso_clinico.nome]');

		}

		return $this->form_validation->run();
	}

}
