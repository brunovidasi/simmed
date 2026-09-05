<?php  

class Usuario_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function post($method = 'insert'){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			
			$data = new stdClass();

			$data->login				= strsql($this->input->post('login', TRUE));
			$data->ativo				= strsql($this->input->post('ativo', TRUE));
			$data->administrador		= strsql($this->input->post('administrador', TRUE));

			if(empty($data->ativo))
				$data->ativo = FALSE;
			else
				$data->ativo = TRUE;

			if(empty($data->administrador))
				$data->administrador = FALSE;
			else
				$data->administrador = TRUE;

			if($method == 'insert'){
				$data->data_cadastro	= date('Y-m-d H:i:s');
			}

			$senha = $this->input->post('senha', TRUE);

			if(!empty($senha))
				$data->senha			= password_hash($senha, PASSWORD_DEFAULT);

			return $data;
		}

		return FALSE;
	}

	function insert($data){

		$this->db->trans_start();

			$usuario_id = ($this->db->insert("usuario", $data)) ? $this->db->insert_id() : 0;

		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE)
			return 0;
		
		return $usuario_id;
	}

	function update($usuario_id, $data){
		
		$usuario_id = (int) $usuario_id;

		if($usuario_id > 0){

			if(empty($data->senha)) unset($data->senha);

			$this->db->trans_start();

				$this->db->where('usuario_id', $usuario_id);
				$this->db->update('usuario', $data);

			$this->db->trans_complete();

			if($this->db->trans_status() === FALSE)
				return FALSE;
			
			return TRUE;

		}

		return FALSE;
	}
	
	function delete($usuario_id){
		
		$usuario_id = (int) $usuario_id;

		if($usuario_id > 0)
			return $this->db->delete('usuario', array('usuario_id' => $usuario_id)) ? TRUE : FALSE ;
		
		return FALSE;
	}	

	function change_status($usuario_id, $activate = 0){

		$usuario_id = (int) $usuario_id;

		$data = new stdClass();
		$data->ativo = ($activate) ? 1 : 0;

		if($usuario_id > 0){

			$this->db->where('usuario_id', $usuario_id);
			if($this->db->update('usuario', $data)) 
				return TRUE;
			
			return FALSE;
		}

		return FALSE;
	}
	
	function get_usuarios(){

		$sql = "SELECT 
					*
				FROM 
					usuario
				ORDER BY 
					data_cadastro DESC";

		return $this->db->query($sql);
	}

	function get_usuario($usuario_id){

		$usuario_id = (int) $usuario_id;

		$sql = "SELECT
					*
				FROM
					usuario
				WHERE
					usuario_id = ?
				LIMIT
					1
		";

		$usuario = $this->db->query($sql, array($usuario_id))->row();

		return $usuario;
	}

}