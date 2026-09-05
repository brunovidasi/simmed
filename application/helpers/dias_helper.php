<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('date2Br')) {

	function date2Br($data){
		return date('d/m/Y', strtotime($data));
	}

}

if (!function_exists('get_feriados')) {

	function get_feriados($ano, $estado_id = 0) {

		$CI = &get_instance();

		$estado_id = (int) $estado_id;

		$sql = "SELECT 
					data 
				FROM 
					feriado 
				WHERE 
					data LIKE '{$ano}%'
				AND
					(estado_id = 0 OR estado_id = {$estado_id})
		";

		$feriados = $CI->db->query($sql)->result();

		$datas = array();
		foreach($feriados as $feriado)
			$datas[] = date2Br($feriado->data);
		
		return $datas;
	}

}

if (!function_exists('calcula_dias')) {

	function calcula_dias($data_inicio, $data_fim) {
		
		$time1 	= dataToTimestamp($data_inicio);
		$time2 	= dataToTimestamp($data_fim);
		$tMaior = $time1 > $time2 ? $time1 : $time2;
		$tMenor = $time1 < $time2 ? $time1 : $time2;
		$diff 	= $tMaior - $tMenor;

		return $diff / 86400;
	}
}

if (!function_exists('dataToTimestamp')) {

	function dataToTimestamp($data) {
		
		$ano = substr($data, 6,4);
		$mes = substr($data, 3,2);
		$dia = substr($data, 0,2);

		return mktime(0, 0, 0, $mes, $dia, $ano);
	}

}

if (!function_exists('somar_dia')) {

	function somar_dia($data){  
		 
		$ano = substr($data, 6,4);
		$mes = substr($data, 3,2);
		$dia = substr($data, 0,2);

		return date("d/m/Y", mktime(0, 0, 0, $mes, $dia+1, $ano));
	}

}

if (!function_exists('calcular_dias_uteis')) {

	function calcular_dias_uteis($data_inicio, $data_fim, $estado_id = 0){

		$dias_total 	= calcula_dias($data_inicio, $data_fim);
		$dias_nao_uteis = 0;
		
		while($data_inicio != $data_fim){

			$diaSemana = date("w", dataToTimestamp($data_inicio));

			if($diaSemana == 0 || $diaSemana == 6){
				$dias_nao_uteis++; 
			}else{
				if(in_array($data_inicio, get_feriados(date('Y'), $estado_id)))
					$dias_nao_uteis++;   
			}

			$data_inicio = somar_dia($data_inicio);
		}
			
		return intval($dias_total - $dias_nao_uteis);
	}

}

if (!function_exists('calcular_feriados')) {

	function calcular_feriados($data_inicio, $data_fim, $estado_id = 0){

		$dias_nao_uteis = 0;
		
		while($data_inicio != $data_fim){

			$diaSemana = date("w", dataToTimestamp($data_inicio));

			if($diaSemana == 0 || $diaSemana == 6){
				$dias_nao_uteis++; 
			}else{
				if(in_array($data_inicio, get_feriados(date('Y'), $estado_id)))
					$dias_nao_uteis++;   
			}

			$data_inicio = somar_dia($data_inicio);
		}
			
		return intval($dias_nao_uteis);
	}

}

?>