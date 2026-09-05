<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acesso extends CI_Controller {

	public function index(){

		if($this->session->userdata('logado') == TRUE){
			
			if(isset($this->session->userdata('usuario')->usuario_id)){

				$usuario = $this->session->userdata('usuario');

				if($usuario->administrador == TRUE){

					redirect('/painel/');

				}else{

					$caso_clinicos = $this->caso_clinico_model->get_caso_clinicos_usuario($usuario->usuario_id);

					if($caso_clinicos->num_rows == 0){
						redirect('/acesso/sair/4');
					}

					foreach($caso_clinicos->result() as $caso)
						redirect('/simulador/iniciar/'.$caso->caso_clinico_id);

				}
			}
		}
		
		$this->load->view('acesso/login');
	}

	function logar(){

		$username = $this->input->post('username', TRUE);
		$senha = $this->input->post('senha');
		$redirect = $this->redirect_local_path($this->input->post('redirect', TRUE));


		$usuario = $this->acesso_model->get_usuario($username);

		if(!isset($usuario->usuario_id)) redirect('/acesso/?msg=3&pg='.$redirect);

		if($usuario->usuario_id > 0 && $usuario->ativo == 1){

			if(password_verify($senha, $usuario->senha)){

				$this->session->set_userdata('usuario', $usuario);
				$this->session->set_userdata('administrador', $usuario->administrador);
				$this->session->set_userdata('logado', TRUE);

				$caso_clinicos_result = $this->caso_clinico_model->get_caso_clinicos_usuario($usuario->usuario_id);
				$caso_clinicos_num_rows = $caso_clinicos_result->num_rows();
				$caso_clinicos = $caso_clinicos_result->result();

				$this->session->set_userdata('caso_clinicos', $caso_clinicos);

				if($usuario->administrador == TRUE){

					if($redirect)
						redirect($redirect);
					else
						redirect('/painel/');


				}else{


					if($caso_clinicos_num_rows == 0){
						redirect('/acesso/sair/4');
					}

					foreach($caso_clinicos as $caso)
						redirect('/simulador/iniciar/'.$caso->caso_clinico_id);



				}

			}else{
				redirect('/acesso/?msg=2&pg='.$redirect); // senha incorreta
			}

		}else{
			redirect('/acesso/?msg=3&pg='.$redirect); // usuário não encontrado
		}

	}

	private function redirect_local_path($path){

		if(empty($path)) return '';

		// only allow same-site relative paths, to avoid open-redirect via the pg/redirect param
		if(substr($path, 0, 1) !== '/' || substr($path, 0, 2) === '//') return '';

		return $path;
	}

	function sair($erro = ""){
		$this->session->set_userdata('logado', FALSE);
		$this->session->sess_destroy();

		if(empty($erro))
			redirect('/acesso/');
		else
			redirect('/acesso/?msg='.$erro);
	}

}
