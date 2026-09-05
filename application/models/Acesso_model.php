<?php  

class Acesso_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
	
	function get_usuario($username){

		$sql = "SELECT
					*
				FROM
					usuario

				WHERE
					login = ?

				LIMIT
					1
		";

		$usuario = $this->db->query($sql, array($username))->row();

		if(isset($usuario->login)){
			return $usuario;
		}

		return 0;

	}

}