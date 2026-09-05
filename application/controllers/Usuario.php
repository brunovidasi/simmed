<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function index(){
		
		$this->lista();
	}

	function lista(){

		$dados['menu'] = "usuario";
		$dados['usuarios'] = $this->usuario_model->get_usuarios()->result();

		$dados['view'] = $this->load->view('usuario/lista', $dados, TRUE);

		$this->load->view('includes/interna', $dados);

	}

	function cadastrar(){

		$dados['menu'] = "usuario";

		$dados['view'] = $this->load->view('usuario/cadastrar', $dados, TRUE);

		$this->load->view('includes/interna', $dados);
	}

	function editar($usuario_id = null){

		if($usuario_id == null) redirect('/usuario/');

		$dados['menu'] = "usuario";
		$dados['usuario'] = $this->usuario_model->get_usuario($usuario_id);

		if(!isset($dados['usuario']->usuario_id)) redirect('/usuario/');

		$dados['view'] = $this->load->view('usuario/editar', $dados, TRUE);

		$this->load->view('includes/interna', $dados);
	}

	function insert(){

		if($this->valida_form('insert')){
	
			$data = $this->usuario_model->post('insert');
			$usuario_id = $this->usuario_model->insert($data);
		
			if($usuario_id > 0){
				$this->session->set_flashdata('mensagem_sucesso', 'Cadastro efetuado com sucesso.');
				redirect('/usuario/');
			}

			$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> efetuado. Tente novamente.');
			redirect('/usuario/cadastrar/');
		}
		$this->cadastrar();
	}

	function update($usuario_id){

		if(!empty($usuario_id)){
			if($this->valida_form('update', $usuario_id)){
				
				$data = $this->usuario_model->post('update');	
				$atualizado = $this->usuario_model->update($usuario_id, $data);
				
				if($atualizado){
					$this->session->set_flashdata('mensagem_sucesso', 'Cadastro atualizado com sucesso.');
					redirect('/usuario/');
				}

				$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> atualizado. Tente novamente.');
				redirect('/usuario/editar/'.$usuario_id);
			}
			$this->editar($usuario_id);
			
		}
	}
	
	function excluir($usuario_id, $ativar = 0){

		$excluido = $this->usuario_model->change_status($usuario_id, $ativar);
		
		if($excluido){
			$this->session->set_flashdata('mensagem_sucesso', 'Cadastro excluido com sucesso.');
			redirect('/usuario/');
		}

		$this->session->set_flashdata('mensagem_erro', 'Cadastro <strong>não</strong> excluido, tente novamente.');
		redirect('/usuario/');
	}
	
	private function valida_form($method = "insert", $usuario_id = 0){


		if($method == "insert"){

			$this->form_validation->set_rules('login', 			'Login', 					'trim|required|is_unique[usuario.login]');

			$this->form_validation->set_rules('senha', 			'Senha', 					'trim|required');
			$this->form_validation->set_rules('conf_senha', 	'Confirmação de Senha', 	'trim|required|matches[senha]');

		}else{

			$login = $this->input->post('login', TRUE);
			$senha = $this->input->post('senha', TRUE);

			$usuario = $this->usuario_model->get_usuario($usuario_id);

			if($usuario->login == $login)
				$this->form_validation->set_rules('login', 		'Login', 					'trim|required');
			else
				$this->form_validation->set_rules('login', 		'Login', 					'trim|required|is_unique[usuario.login]');

			if(!empty($senha)){
				$this->form_validation->set_rules('senha', 		'Senha', 					'trim|required');
				$this->form_validation->set_rules('conf_senha', 'Confirmação de Senha', 	'trim|required|matches[senha]');
			}

		}

		$this->form_validation->set_rules('ativo');
		$this->form_validation->set_rules('administrador');

		return $this->form_validation->run();
	}

}
