<?php
	//https://hotexamples.com/examples/-/-/pg_result_error/php-pg_result_error-function-examples.html

class user_ass_dao{

	//insere no banco colaboradores
    public function insertNewNotCoord($nome, $email, $telefone, $coord, $cargo, $setor, $ramal, $empresa): void{
        include_once("connection_bd.php");
        $c = new connection_bd();
        $conn = $c -> openConnection();
		$query = 'INSERT INTO public.tbl_user_ass(nome_user_ass, email_user_ass, telefone_user_ass, last_update_user_ass, "isCoordenador", id_coordenador, id_cargo_user_ass, id_setor_user_ass, id_ramal_user_ass, id_empresa_user_ass) VALUES ($1, $2, $3, NOW(), $4, $5, $6, $7, $8, $9)';

		pg_prepare($conn, 'isNotCoord', $query) or die("Erro na execução da query {$query}, contate a TI");

		pg_execute($conn, "isNotCoord", array($nome, $email, $telefone, 0, $coord, $cargo, $setor, $ramal, $empresa));
    }

	//insere no banco coordenadores
	public function insertNewCoord($nome, $email, $telefone, $cargo, $setor, $ramal, $empresa): void{
		include_once("connection_bd.php");
		$c = new connection_bd();
		$conn = $c -> openConnection();
		$query = 'INSERT INTO public.tbl_user_ass(nome_user_ass, email_user_ass, telefone_user_ass, last_update_user_ass, "isCoordenador", id_cargo_user_ass, id_setor_user_ass, id_ramal_user_ass, id_empresa_user_ass) VALUES ($1, $2, $3, NOW(), $4, $5, $6, $7, $8)';

		pg_prepare($conn, 'isCoord', $query) or die("Erro na execução da query {$query}, contate a TI");

		pg_execute($conn, "isCoord", array($nome, $email, $telefone, 1, $cargo, $setor, $ramal, $empresa));
	}

	//select de todos os emails cadastrados
	public function selectUser(): bool|PgSql\Result{
		include_once('connection_bd.php');
		$c = new connection_bd();

		$conn = $c -> openConnection();

		$sql = 'select u.id_user_ass, u.nome_user_ass, u.email_user_ass, u.telefone_user_ass, u.last_update_user_ass, u."isCoordenador", u.id_coordenador, c.cargo, s.setor, r.ramal, e.empresa 
				from tbl_user_ass as u 
				INNER JOIN tbl_cargo AS c ON u.id_cargo_user_ass = c.id_cargo 
				INNER JOIN tbl_setor AS s ON u.id_setor_user_ass = s.id_setor 
				INNER JOIN tbl_ramal AS r ON u.id_ramal_user_ass = r.id_ramal 
				INNER JOIN tbl_empresa AS e ON u.id_empresa_user_ass = e.id_empresa ';
		return pg_query($conn, $sql);
	}

	//transforma o id do coordenador no nome
	public function getNomeCoord($coord){
		include_once('connection_bd.php');
		$c = new connection_bd();

		$conn = $c -> openConnection();

		$sql = 'SELECT nome_user_ass FROM tbl_user_ass where id_user_ass = $1';
		$arr = array($coord);

		$query = pg_query_params($conn, $sql, $arr);
		$row = pg_fetch_assoc($query);

		return $row['nome_user_ass'];
	}

	//faz a verificação do email na hora de gerar a assinatura
	public function verificaEmail($email): int{
		include_once("connection_bd.php");
		$c = new connection_bd();
		$conn = $c -> openConnection();
		$id = 0;

		$sql = 'select id_user_ass from tbl_user_ass where email_user_ass = $1';
		$array = array($email);

		$query = pg_query_params($conn, $sql, $array);
		$row = pg_fetch_assoc($query);

		if($row){
			$rowcoord = pg_fetch_array($query, 0, PGSQL_NUM);
			$id = $rowcoord[0];
		}
		return $id;
	}
}