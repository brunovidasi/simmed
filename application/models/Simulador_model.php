<?php  

class Simulador_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function post($method = 'insert'){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			
			$data = new stdClass();

			$data->nome				= strsql($this->input->post('nome', TRUE));

			return $data;
		}

		return FALSE;
	}

	function insert($data){

		$this->db->trans_start();

			$caso_clinico_id = ($this->db->insert("caso_clinico", $data)) ? $this->db->insert_id() : 0;

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
			return 0;
		
		return $caso_clinico_id;
	}

	function update($caso_clinico_id, $data){
		
		$caso_clinico_id = (int) $caso_clinico_id;

		if($caso_clinico_id > 0){

			$this->db->trans_start();

				$this->db->where('caso_clinico_id', $caso_clinico_id);
				$this->db->update('caso_clinico', $data);

			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE)
				return FALSE;
			
			return TRUE;

		}

		return FALSE;
	}

	
	function delete($caso_clinico_id){
		
		$caso_clinico_id = (int) $caso_clinico_id;

		if($caso_clinico_id > 0)
			return $this->db->delete('caso_clinico', array('caso_clinico_id' => $caso_clinico_id)) ? TRUE : FALSE ; 
		
		return FALSE;
	}	
	
	function iniciar_caso($usuario_id, $caso_clinico_id){
		
		$usuario_id 		= (int) $usuario_id;
		$caso_clinico_id 	= (int) $caso_clinico_id;

		$data = new stdClass();
		$data->iniciado = TRUE;
		$data->data_inicio = date('Y-m-d H:i:s');

		if($caso_clinico_id > 0){

			$this->db->trans_start();

				$this->db->where('caso_clinico_id', $caso_clinico_id);
				$this->db->where('usuario_id', $usuario_id);
				$this->db->update('usuario_caso_clinico', $data);

			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE)
				return FALSE;
			
			return TRUE;

		}

		return FALSE;
	}

	function encerrar_caso($usuario_id, $caso_clinico_id, $data){
		
		$usuario_id 		= (int) $usuario_id;
		$caso_clinico_id 	= (int) $caso_clinico_id;

		if($caso_clinico_id > 0){

			$this->db->trans_start();

				$this->db->where('caso_clinico_id', $caso_clinico_id);
				$this->db->where('usuario_id', $usuario_id);
				$this->db->update('usuario_caso_clinico', $data);

			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE)
				return FALSE;
			
			return TRUE;

		}

		return FALSE;
	}

	function get_caso_clinicos(){
		
		$sql = "SELECT 
					CC.*,
					EM.nome as area_principal
				FROM 
					caso_clinico as CC

				INNER JOIN
					especialidade_medica as EM ON EM.especialidade_medica_id = CC.area_principal_id

				ORDER BY 
					CC.nome DESC";

		return $this->db->query($sql);
	}

	function get_caso_clinico($caso_clinico_id){

		$caso_clinico_id = (int) $caso_clinico_id;

		$sql = "SELECT
					*
				FROM
					caso_clinico
				WHERE
					caso_clinico_id = ?
				LIMIT
					1
		";

		$caso_clinico = $this->db->query($sql, array($caso_clinico_id))->row();

		return $caso_clinico;
	}

	function get_caso_clinicos_usuario($usuario_id = 0){

		$usuario_id = (int) $usuario_id;

		$sql = "SELECT
					CC.*
				FROM
					usuario_caso_clinico as UCC

				INNER JOIN
					caso_clinico as CC ON CC.caso_clinico_id = UCC.caso_clinico_id

				WHERE
					UCC.usuario_id = ?

				ORDER BY
					CC.data_cadastro ASC";

		return $this->db->query($sql, array($usuario_id));
	}

	function get_caso_clinico_usuario($usuario_id = 0, $caso_clinico_id = 0){

		$usuario_id = (int) $usuario_id;
		$caso_clinico_id = (int) $caso_clinico_id;

		$sql = "SELECT
					UCC.*
				FROM
					usuario_caso_clinico as UCC

				WHERE
					UCC.usuario_id = ? AND UCC.caso_clinico_id = ?

				LIMIT
					1
		";

		return $this->db->query($sql, array($usuario_id, $caso_clinico_id))->row();
	}

	function get_variavel_clinica($variavel_clinica_id){

		$variavel_clinica_id = (int) $variavel_clinica_id;

		$sql = "SELECT
					*
				FROM
					variavel_clinica
				WHERE
					variavel_clinica_id = ?
				LIMIT
					1
		";

		$variavel_clinica = $this->db->query($sql, array($variavel_clinica_id))->row();

		return $variavel_clinica;
	}

	function get_variavel_clinica_caso_clinico($variavel_clinica_id, $caso_clinico_id){

		$variavel_clinica_id = (int) $variavel_clinica_id;
		$caso_clinico_id = (int) $caso_clinico_id;

		$sql = "SELECT
					*
				FROM
					variavel_clinica_caso_clinico
				WHERE
					variavel_clinica_id = ? AND caso_clinico_id = ?
				LIMIT
					1
		";

		$variavel_clinica = $this->db->query($sql, array($variavel_clinica_id, $caso_clinico_id));

		return $variavel_clinica;
	}

	function get_variavel_clinica_pedidas($caso_clinico_id = 0, $usuario_id = 0){

		$caso_clinico_id = (int) $caso_clinico_id;
		$usuario_id = (int) $usuario_id;

		$sql = "SELECT
					VP.*,
					V.nome as nome,
					C.texto as texto
				FROM
					usuario_caso_clinico_variavel_clinica as VP

				LEFT JOIN
					variavel_clinica as V ON VP.variavel_clinica_id = V.variavel_clinica_id

				LEFT JOIN
					variavel_clinica_caso_clinico as C ON C.variavel_clinica_id = VP.variavel_clinica_id

				WHERE
					VP.caso_clinico_id = ? AND VP.usuario_id = ?
				ORDER BY
					VP.data_cadastro ASC
		";

		$variavel_clinica = $this->db->query($sql, array($caso_clinico_id, $usuario_id));

		return $variavel_clinica;
	}

	function variavel_clinica_pedida($usuario_id = 0, $caso_clinico_id = 0, $variavel_clinica_id = 0){

		$data = new stdClass();
		$data->usuario_id = (int) $usuario_id;
		$data->caso_clinico_id = (int) $caso_clinico_id;
		$data->variavel_clinica_id = (int) $variavel_clinica_id;
		$data->data_cadastro = date('Y-m-d H:i:s');

		$this->db->trans_start();

			$retorno = ($this->db->insert("usuario_caso_clinico_variavel_clinica", $data)) ? $this->db->insert_id() : 0;

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
			return 0;
		
		return $retorno;

	}

}