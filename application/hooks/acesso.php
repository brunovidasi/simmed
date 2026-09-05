<?php

function acesso(){

	$CI = & get_instance();
	$config = & get_config();
	
	if(!isset($CI->session)){
		$CI->load->library('session');
	}

	$controle 	= strtolower(get_class($CI));
	$metodo		= $CI->router->method;

	// die($controle . ' - ' . $metodo);
	
	if(!isset($CI->session->userdata('usuario')->usuario_id)){

		if ($controle != 'acesso'){

			$CI->session->sess_destroy();
			$CI->session->set_flashdata('mensagem', 'É preciso estar logado para utilizar o sistema.');

			redirect('/acesso?pg='.$_SERVER['REQUEST_URI'].'/');

		}

	}

	if($controle != 'acesso'){

		if(!isset($CI->session->userdata('usuario')->usuario_id)){
			$CI->session->sess_destroy();
			$CI->session->set_flashdata('mensagem', 'É preciso estar logado para utilizar o sistema.');

			redirect('/acesso?pg='.$_SERVER['REQUEST_URI'].'/');
		}
	}

}

?>
