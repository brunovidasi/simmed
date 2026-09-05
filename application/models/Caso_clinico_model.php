<?php  

class Caso_clinico_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function post($method = 'insert'){
		if($this->input->server('REQUEST_METHOD') == 'POST'){

			$data['caso_clinico'] = new stdClass();

			if($method == 'insert'){
				
				$data['caso_clinico']->nome			= strsql($this->input->post('nome', TRUE));
				$data['caso_clinico']->numero		= strsql($this->input->post('numero', TRUE));
				$data['caso_clinico']->cid			= strsql($this->input->post('cid', TRUE));
				$data['caso_clinico']->diagnostico	= strsql($this->input->post('diagnostico'));
				$data['caso_clinico']->prescricao	= strsql($this->input->post('prescricao'));
				$data['caso_clinico']->alta			= $this->input->post('alta', TRUE);
				$data['caso_clinico']->internacao	= $this->input->post('internacao', TRUE);
				$data['caso_clinico']->area_principal_id = (int) $this->input->post('especialidade_principal', TRUE);
				$data['caso_clinico']->data_cadastro = date('Y-m-d H:i:s');

				if(empty($data['caso_clinico']->alta))
					$data['caso_clinico']->alta = FALSE;
				else
					$data['caso_clinico']->alta = TRUE;

				if(empty($data['caso_clinico']->internacao))
					$data['caso_clinico']->internacao = FALSE;
				else
					$data['caso_clinico']->internacao = TRUE;

				$usuarios = $this->input->post('usuarios');

				foreach($usuarios as $key => $usuario_id){

					$data['usuario_caso_clinico'][$key] = new stdClass();

					$data['usuario_caso_clinico'][$key]->usuario_id = $usuario_id;
					$data['usuario_caso_clinico'][$key]->ordem = 1;
					$data['usuario_caso_clinico'][$key]->iniciado = 0;
					$data['usuario_caso_clinico'][$key]->concluido = 0;
					$data['usuario_caso_clinico'][$key]->ativo = 1;
					$data['usuario_caso_clinico'][$key]->data_cadastro = date('Y-m-d H:i:s');

				}

				$especialidades = $this->input->post('especialidade_secundaria');

				foreach($especialidades as $key => $especialidade_medica_id){

					$data['area_secundaria'][$key] = new stdClass();

					$data['area_secundaria'][$key]->especialidade_medica_id = $especialidade_medica_id;

				}

				$variavel_clinicas = $this->input->post('variavel_clinica');
				$texto = $this->input->post('texto');
				$foto = $this->input->post('foto');
				$obrigatorio = $this->input->post('obrigatorio');

				foreach($variavel_clinicas as $key => $variavel_clinica_id){

					$data['variavel_clinica_caso_clinico'][$key] = new stdClass();

					$obg = $obrigatorio[$key];

					if(empty($obg))
						$obg = FALSE;
					else
						$obg = TRUE;

					$data['variavel_clinica_caso_clinico'][$key]->variavel_clinica_id = $variavel_clinica_id;
					$data['variavel_clinica_caso_clinico'][$key]->texto = $texto[$key];
					$data['variavel_clinica_caso_clinico'][$key]->foto = $foto[$key];
					$data['variavel_clinica_caso_clinico'][$key]->obrigatorio = $obg;

				}


			}
			

			return $data;
		}

		return FALSE;
	}

	function insert($data){

		$this->db->trans_start();

			$caso_clinico_id = ($this->db->insert("caso_clinico", $data['caso_clinico'])) ? $this->db->insert_id() : 0;

			foreach($data['usuario_caso_clinico'] as $key => $usuario_caso_clinico){

				$usuario_caso_clinico->caso_clinico_id = $caso_clinico_id;
				$this->db->insert("usuario_caso_clinico", $usuario_caso_clinico);

			}

			foreach($data['area_secundaria'] as $key => $area_secundaria){

				$area_secundaria->caso_clinico_id = $caso_clinico_id;
				$this->db->insert("area_secundaria", $area_secundaria);

			}

			foreach($data['variavel_clinica_caso_clinico'] as $key => $variavel_clinica_caso_clinico){

				$variavel_clinica_caso_clinico->caso_clinico_id = $caso_clinico_id;
				$this->db->insert("variavel_clinica_caso_clinico", $variavel_clinica_caso_clinico);

			}

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
				$this->db->update("caso_clinico", $data['caso_clinico']);

				foreach($data['usuario_caso_clinico'] as $key => $usuario_caso_clinico){
					
					$usuario_caso_clinico->caso_clinico_id = $caso_clinico_id;
					$this->db->insert("usuario_caso_clinico", $usuario_caso_clinico);

				}

				foreach($data['area_secundaria'] as $key => $area_secundaria){

					$area_secundaria->caso_clinico_id = $caso_clinico_id;
					$this->db->insert("area_secundaria", $area_secundaria);

				}

				foreach($data['variavel_clinica_caso_clinico'] as $key => $variavel_clinica_caso_clinico){

					$variavel_clinica_caso_clinico->caso_clinico_id = $caso_clinico_id;
					$this->db->insert("variavel_clinica_caso_clinico", $variavel_clinica_caso_clinico);

				}

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
	
	function get_caso_clinicos(){
		
		$sql = "SELECT 
					CC.*,
					EM.nome as area_principal,
					GROUP_CONCAT(DISTINCT EM2.nome) as area_secundaria,
					GROUP_CONCAT(DISTINCT U.concluido) as concluido,
					COUNT(DISTINCT U.caso_clinico_id) as num_usuarios
				FROM 
					caso_clinico as CC

				INNER JOIN
					especialidade_medica as EM ON EM.especialidade_medica_id = CC.area_principal_id
				LEFT JOIN
					area_secundaria as SA ON SA.caso_clinico_id = CC.caso_clinico_id
				LEFT JOIN
					especialidade_medica as EM2 ON SA.especialidade_medica_id = EM2.especialidade_medica_id

				LEFT JOIN
					usuario_caso_clinico as U ON U.caso_clinico_id = CC.caso_clinico_id


				GROUP BY 
					CC.caso_clinico_id

				ORDER BY 
					CC.data_cadastro DESC";

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

	function get_caso_clinicos_usuario($usuario_id = 0, $concluido = 0){

		$usuario_id = (int) $usuario_id;
		$concluido 	= (int) $concluido;

		$sql = "SELECT
					CC.*
				FROM
					usuario_caso_clinico as UCC

				INNER JOIN
					caso_clinico as CC ON CC.caso_clinico_id = UCC.caso_clinico_id

				WHERE
					UCC.usuario_id = ? AND UCC.concluido = ?

				ORDER BY
					CC.data_cadastro ASC";

		return $this->db->query($sql, array($usuario_id, $concluido));
	}

	function get_usuario_caso_clinicos($caso_clinico_id = 0, $concluido = 0){

		$caso_clinico_id = (int) $caso_clinico_id;
		$concluido 	= (int) $concluido;

		$sql = "SELECT
					UCC.*,
					U.login as usuario
				FROM
					usuario_caso_clinico as UCC

				INNER JOIN
					caso_clinico as CC ON CC.caso_clinico_id = UCC.caso_clinico_id
				LEFT JOIN
					usuario as U ON U.usuario_id = UCC.usuario_id

				WHERE
					UCC.caso_clinico_id = ?

				ORDER BY
					CC.data_cadastro ASC";

		$casos = $this->db->query($sql, array($caso_clinico_id))->result();

		foreach($casos as $caso){

			$sql = "SELECT
						UCCVC.*,
						VC.nome as variavel_clinica,
						VC.custo as custo,
						VC.comando as comando,
						VCCC.texto,
						VCCC.foto,
						VCCC.obrigatorio
					FROM
						usuario_caso_clinico_variavel_clinica as UCCVC

					LEFT JOIN
						variavel_clinica as VC ON VC.variavel_clinica_id = UCCVC.variavel_clinica_id

					LEFT JOIN
						variavel_clinica_caso_clinico as VCCC ON VCCC.variavel_clinica_id = UCCVC.variavel_clinica_id AND VCCC.caso_clinico_id = UCCVC.caso_clinico_id

					WHERE
						UCCVC.caso_clinico_id = ? AND UCCVC.usuario_id = ?

					ORDER BY
						UCCVC.data_cadastro ASC";

			$v_clinicas = $this->db->query($sql, array($caso_clinico_id, (int) $caso->usuario_id));
			$caso->v_clinicas = $v_clinicas->result();
			$caso->v_clinicas_num = $v_clinicas->num_rows();

			$valor = 0;

			foreach($v_clinicas->result() as $v)
				$valor = $valor + $v->custo;

			$caso->valor = $valor;

		}

		return $casos;

	}

	function get_caso_clinico_usuario($usuario_id = 0, $caso_clinico_id = 0){

		$usuario_id 		= (int) $usuario_id;
		$caso_clinico_id 	= (int) $caso_clinico_id;

		$sql = "SELECT
					UCC.*,
					CC.nome as nome
				FROM
					usuario_caso_clinico as UCC

				INNER JOIN
					caso_clinico as CC ON CC.caso_clinico_id = UCC.caso_clinico_id

				WHERE
					UCC.usuario_id = ? AND UCC.caso_clinico_id = ?

				ORDER BY
					CC.data_cadastro ASC";

		return $this->db->query($sql, array($usuario_id, $caso_clinico_id));
	}

	function get_area_secundarias($caso_clinico_id = 0){

		$caso_clinico_id = (int) $caso_clinico_id;

		$sql = "SELECT
					S.*,
					EM.nome as nome
				FROM
					area_secundaria as S

				LEFT JOIN
					especialidade_medica as EM ON EM.especialidade_medica_id = S.especialidade_medica_id

				WHERE
					S.caso_clinico_id = ?

				ORDER BY
					S.especialidade_medica_id ASC";

		return $this->db->query($sql, array($caso_clinico_id));
	}

	function get_usuarios($caso_clinico_id = 0){

		$caso_clinico_id = (int) $caso_clinico_id;

		$sql = "SELECT
					UCC.usuario_id
				FROM
					usuario_caso_clinico as UCC

				WHERE
					UCC.caso_clinico_id = ?

				ORDER BY
					UCC.usuario_id ASC";

		return $this->db->query($sql, array($caso_clinico_id));
	}

}