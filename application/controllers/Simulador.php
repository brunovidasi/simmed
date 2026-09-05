<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Simulador extends CI_Controller {

	public function index(){

		$usuario_id 	= $this->session->userdata('usuario')->usuario_id;
		$caso_clinicos 	= $this->caso_clinico_model->get_caso_clinicos_usuario($usuario_id)->result();

		foreach($caso_clinicos as $caso)
			redirect('/simulador/caso/'.$caso->caso_clinico_id);
		
	}

	public function enc(){

		$this->load->view('simulador/encerrar');
		
	}

	function iniciar($caso_clinico_id){

		$usuario_id = $this->session->userdata('usuario')->usuario_id;

		$caso = $this->caso_clinico_model->get_caso_clinico_usuario($usuario_id, $caso_clinico_id)->row();

		// print_r($caso); die();

		if($caso->iniciado){
			redirect('/simulador/caso/'.$caso->caso_clinico_id);
		}else{
			$dados['caso'] = $caso;
			$this->load->view('simulador/iniciar', $dados);
		}

	}

	function iniciar_caso($caso_clinico_id){

		$usuario_id = $this->session->userdata('usuario')->usuario_id;
		$caso = $this->caso_clinico_model->get_caso_clinico_usuario($usuario_id, $caso_clinico_id)->row();

		if($caso->iniciado == FALSE){

			$iniciar_caso = $this->simulador_model->iniciar_caso($usuario_id, $caso_clinico_id);

			if($iniciar_caso)
				redirect('/simulador/caso/'.$caso->caso_clinico_id);

		}

		$this->session->set_flashdata('mensagem', 'Esse caso já foi iniciado previamente.');
		redirect('/simulador/caso/'.$caso->caso_clinico_id);
	}

	function caso($caso_clinico_id){

		$dados['menu'] = "simulador";

		$caso_clinico_id 	= (int) $caso_clinico_id;
		$usuario_id 		= (int) $this->session->userdata('usuario')->usuario_id;

		$dados['qtd_casos_clinicos'] 	= count($this->session->userdata('caso_clinicos'));
		$dados['usuario_id'] 			= $usuario_id;
		$dados['caso_clinico_id'] 		= $caso_clinico_id;
		$dados['usuario'] 				= $this->usuario_model->get_usuario($usuario_id);
		$dados['caso_clinico'] 			= $this->simulador_model->get_caso_clinico($caso_clinico_id);
		$dados['caso_clinico_usuario'] 	= $this->simulador_model->get_caso_clinico_usuario($usuario_id, $caso_clinico_id);

		$dados['variavel_clinicas'] 	= $this->variavel_clinica_model->get_variavel_clinicas()->result();

		$dados['variavel_clinica_pedidas'] = $this->simulador_model->get_variavel_clinica_pedidas($caso_clinico_id, $usuario_id)->result();

		if($dados['caso_clinico_usuario']->iniciado == FALSE)
			redirect('/simulador/iniciar/'.$caso_clinico_id);

		if($dados['caso_clinico_usuario']->concluido == TRUE)
			redirect('/simulador/relatorio/'.$caso_clinico_id);

		$dados['view'] = $this->load->view('simulador/caso', $dados, TRUE);

		$this->load->view('includes/interna', $dados);

	}

	function encerrar_caso($caso_clinico_id){

		$usuario_id = $this->session->userdata('usuario')->usuario_id;
		$caso = $this->caso_clinico_model->get_caso_clinico_usuario($usuario_id, $caso_clinico_id)->row();

		$data = new stdClass();
		$data->internacao 	= $this->input->post('internacao', TRUE);
		$data->alta 		= $this->input->post('alta', TRUE);
		$data->diagnostico 	= $this->input->post('diagnostico', TRUE);
		$data->prescricao 	= $this->input->post('prescricao', TRUE);
		$data->cid 			= $this->input->post('cid', TRUE);
		$data->concluido 	= TRUE;
		$data->data_fim 	= date('Y-m-d H:i:s');

		if(empty($data->internacao))
			$data->internacao = FALSE;
		else
			$data->internacao = TRUE;

		if(empty($data->alta))
			$data->alta = FALSE;
		else
			$data->alta = TRUE;

		if($caso->concluido == FALSE){

			$encerrar_caso = $this->simulador_model->encerrar_caso($usuario_id, $caso_clinico_id, $data);

			if($encerrar_caso)
				$this->load->view('simulador/encerrar');

		}else{
			redirect('/acesso/sair/4');
		}

	}

	function variavel_clinica($caso_clinico_id = 0){

		$caso_clinico_id 		= (int) $caso_clinico_id;
		$variavel_clinica_id 	= (int) $this->input->post('variavel_clinica_id', TRUE);
		$usuario_id 			= (int) $this->session->userdata('usuario')->usuario_id; 

		$variavel_clinica = $this->simulador_model->get_variavel_clinica($variavel_clinica_id);

		$variavel_clinica_caso_clinico = $this->simulador_model->get_variavel_clinica_caso_clinico($variavel_clinica_id, $caso_clinico_id);
		$var = $variavel_clinica_caso_clinico->row();

		$retorno = $this->simulador_model->variavel_clinica_pedida($usuario_id, $caso_clinico_id, $variavel_clinica_id);

		if($variavel_clinica_caso_clinico->num_rows() > 0){

			$retorno = '

				<li>
				<div class="block">
					<div class="block_content">
						<h2 class="title">
							<a>'.$variavel_clinica->nome.'</a>
						</h2>
						<p class="excerpt">'.$var->texto.'</a>
						</p>
					</div>
				</div>
				</li>

			';

		}else{

			$retorno = '

				<li>
				<div class="block">
					<div class="block_content">
						<h2 class="title">
							<a>'.$variavel_clinica->nome.'</a>
						</h2>
						<p class="excerpt">Dado não disponível.</a>
						</p>
					</div>
				</div>
				</li>

			';
		}

		echo $retorno;

	}

}
