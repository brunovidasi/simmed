<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('telefone')) {

	function telefone($telefone = null){
		
		# (99) 9999-9999

		if(empty($telefone)) return;
		
		$telefone_traco = explode("-", $telefone);
		$telefone_ddd = explode(" ", $telefone_traco[0]);
		
		$numero = $telefone_ddd[1] . $telefone_traco[1];
		$ddd = substr($telefone_ddd[0], -3, -1);
		
		return $ddd . $numero;
		
	}

}

if (!function_exists('celular')) {

	function celular($telefone = null){
		
		# (99) 9 9999-9999

		if(empty($telefone)) return;
		
		$telefone_traco = explode("-", $telefone);
		$telefone_ddd = explode(" ", $telefone_traco[0]);
		
		$numero = $telefone_ddd[1] . $telefone_traco[1];
		$ddd = substr($telefone_ddd[0], -3, -1);
		
		return $ddd . $numero;
		
	}
	
}

?>