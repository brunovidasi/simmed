<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('salvar_log')) {

    function salvar_log($controller, $method, $registro_id = 0, $sucesso = TRUE, $parametros = '', $nome = 'Log', $pai_id = '', $sistema_id = 1){

        $CI = &get_instance();

        $usuario_id = (isset($CI->session->userdata('usuario')->usuario_id)) ? $CI->session->userdata('usuario')->usuario_id : 0;

        if($sistema_id == 3)
            $usuario_id = $pai_id;
		
        if(!empty($usuario_id)){

			$log              = new stdClass();

            $log->sistema_id  = $sistema_id; // 1 - HUB // 2 - Cliente // 3 - Correspondente
			$log->data        = date("Y-m-d H:i:s");
			$log->usuario_id  = $usuario_id;
			$log->controller  = $controller;
			$log->method      = $method;
            $log->registro_id = $registro_id;
            $log->pai_id      = $pai_id;
			$log->parametros  = $parametros;
            $log->nome        = $nome;
			$log->sucesso     = $sucesso;

			$log->ip          = $_SERVER['REMOTE_ADDR'];
			$log->user_agent  = $_SERVER['HTTP_USER_AGENT'];

            $log_salvo        = $CI->db->insert("log", $log);

            if($log_salvo)
                return TRUE;
            else
                return FALSE;
			
        }else
            return FALSE;
			
    }

}