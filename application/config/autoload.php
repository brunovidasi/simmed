<?php defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['model'] 		= array(
							'acesso_model',
							'especialidade_model',
							'variavel_clinica_model',
							'caso_clinico_model',
							'simulador_model',
							'usuario_model'
);

$autoload['libraries'] 	= array(
							'database', 
							'session', 
							'form_validation', 
							'pagination', 
							'upload',
							'email'
);

$autoload['helper'] 	= array(
							'log', 
							'form', 
							'fdata', 
							'url', 
							'sql', 
							'pr', 
							'cripto', 
							'gera_senha',
							'cep',
							'cpf',
							'moeda',
							'dias',
							'telefone',
							'horas'
);

$autoload['config'] 	= array();

$autoload['language'] 	= array();

$autoload['packages'] 	= array();

$autoload['drivers'] 	= array();