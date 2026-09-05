<?php  

class Variavel_clinica_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function post($method = 'insert'){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			
			$data = new stdClass();

			$data->nome					= strsql($this->input->post('nome', TRUE));
			$data->comando				= strsql($this->input->post('comando', TRUE));
			$data->custo				= fmoeda($this->input->post('custo', TRUE));
			
			if($method == 'insert')
				$data->data_cadastro	= date('Y-m-d H:i:s');

			return $data;
		}

		return FALSE;
	}

	function insert($data){

		$this->db->trans_start();

			$variavel_clinica_id = ($this->db->insert("variavel_clinica", $data)) ? $this->db->insert_id() : 0;

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
			return 0;
		
		return $variavel_clinica_id;
	}

	function update($variavel_clinica_id, $data){
		
		$variavel_clinica_id = (int) $variavel_clinica_id;

		if($variavel_clinica_id > 0){

			$this->db->trans_start();

				$this->db->where('variavel_clinica_id', $variavel_clinica_id);
				$this->db->update('variavel_clinica', $data);

			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE)
				return FALSE;
			
			return TRUE;

		}

		return FALSE;
	}
	
	function delete($variavel_clinica_id){
		
		$variavel_clinica_id = (int) $variavel_clinica_id;

		if($variavel_clinica_id > 0)
			return $this->db->delete('variavel_clinica', array('variavel_clinica_id' => $variavel_clinica_id)) ? TRUE : FALSE ; 
		
		return FALSE;
	}	
	
	function get_variavel_clinicas(){

		$sql = "SELECT 
					*
				FROM 
					variavel_clinica
				ORDER BY 
					data_cadastro DESC";

		return $this->db->query($sql);
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

	function get_variavel_clinica_caso_clinico($caso_clinico_id){

		$caso_clinico_id = (int) $caso_clinico_id;

		$sql = "SELECT
					VCCC.*,
					VC.nome as variavel_clinica,
					VC.custo as custo,
					VC.comando as comando
				FROM
					variavel_clinica_caso_clinico  as VCCC

				LEFT JOIN
					variavel_clinica as VC ON VC.variavel_clinica_id = VCCC.variavel_clinica_id

				WHERE
					VCCC.caso_clinico_id = ?

				ORDER BY
					VCCC.data_cadastro ASC
		";

		return $this->db->query($sql, array($caso_clinico_id))->result();

	}

}