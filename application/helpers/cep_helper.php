<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('cep')) {
	function cep($cep){

		if(empty($cep)) return;
        $cep_array = explode("-", $cep);

        return $cep_array[0] . $cep_array[1];

	}
}

?>