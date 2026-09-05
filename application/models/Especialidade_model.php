<?php  

class Especialidade_model extends CI_Model {

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

			$especialidade_medica_id = ($this->db->insert("especialidade_medica", $data)) ? $this->db->insert_id() : 0;

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
			return 0;
		
		return $especialidade_medica_id;
	}

	function update($especialidade_medica_id, $data){
		
		$especialidade_medica_id = (int) $especialidade_medica_id;

		if($especialidade_medica_id > 0){

			$this->db->trans_start();

				$this->db->where('especialidade_medica_id', $especialidade_medica_id);
				$this->db->update('especialidade_medica', $data);

			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE)
				return FALSE;
			
			return TRUE;

		}

		return FALSE;
	}
	
	function delete($especialidade_medica_id){
		
		$especialidade_medica_id = (int) $especialidade_medica_id;

		if($especialidade_medica_id > 0)
			return $this->db->delete('especialidade_medica', array('especialidade_medica_id' => $especialidade_medica_id)) ? TRUE : FALSE ; 
		
		return FALSE;
	}	
	
	function get_especialidades(){

		$sql = "SELECT 
					*
				FROM 
					especialidade_medica
				ORDER BY 
					nome DESC";

		return $this->db->query($sql);
	}

	function get_especialidade($especialidade_medica_id){

		$especialidade_medica_id = (int) $especialidade_medica_id;

		$sql = "SELECT
					*
				FROM
					especialidade_medica
				WHERE
					especialidade_medica_id = ?
				LIMIT
					1
		";

		$especialidade = $this->db->query($sql, array($especialidade_medica_id))->row();

		return $especialidade;
	}

}