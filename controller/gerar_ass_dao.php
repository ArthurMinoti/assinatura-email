<?php
	header("Content-type: text/plain");
	header("Cache-Control: no-cache, must-revalidate");

	include_once("connection_bd.php");
	include_once("user_ass_dao.php");

	$c = new connection_bd();
	$u = new user_ass_dao();

	$conn = $c -> openConnection();

	$email = $_POST['email'];

	//$email = "arthur.minoti@agencia.baciaspcj.org.br";
	$id = $u -> verificaEmail($email);
	if($id == 0){
		echo("Inexistente");
		exit;
	}

	$sql= 'SELECT "isCoordenador" FROM tbl_user_ass WHERE id_user_ass = $1';
	$arr = array($id);
	$query = pg_query_params($conn, $sql, $arr);
	$row = pg_fetch_assoc($query);

	$assinatura = "";
	$isCoordenador = "";

	if($row){
		$rowcoord = pg_fetch_array($query, 0, PGSQL_NUM);
		$isCoordenador = $rowcoord[0];
	}
	else{
		echo("Erro");
		exit;
	}

	if($isCoordenador == "t"){
		$sql = 'SELECT u.nome_user_ass, u.email_user_ass, u.telefone_user_ass, c.cargo, s.setor, r.ramal, e.empresa 
                  FROM tbl_user_ass AS u 
                  INNER JOIN tbl_cargo AS c ON u.id_cargo_user_ass = c.id_cargo 
                  INNER JOIN tbl_setor AS s ON u.id_setor_user_ass = s.id_setor 
                  INNER JOIN tbl_ramal AS r ON u.id_ramal_user_ass = r.id_ramal 
                  INNER JOIN tbl_empresa AS e ON u.id_empresa_user_ass = e.id_empresa 
                  WHERE u.id_user_ass = $1';
		$query = pg_query_params($conn, $sql, $arr);
		$result = pg_fetch_assoc($query);

		while($result){
			/** @noinspection DuplicatedCode */
			$row = pg_fetch_array($query, 0, PGSQL_NUM);
			$nome = $row[0];
			$email = $row[1];
			$telefone = $row[2];
			$cargo = $row[3];
			$setor = $row[4];
			$ramal = $row[5];
			$empresa = $row[6];

			echo "<font color='#002060'><b>" . $nome . "</b></font><br>";
			echo $cargo . "<br>";
			echo $empresa . "<br>";
			echo $email . "<br>";
			echo $telefone . "<br>";
			echo "www.agencia.baciaspcj.org.br <br>";
			echo "<img src='https://www.agencia.baciaspcj.org.br/wp-content/uploads/2020/11/AGÊNCIA-PCJ.png' alt='Agência das Bacias PCJ' width='246' height='123'>";
		}
	}
	else if($isCoordenador == "f"){
		$sql = 'SELECT u.nome_user_ass, u.email_user_ass, u.telefone_user_ass, u.id_coordenador, c.cargo, s.setor, r.ramal, e.empresa 
                  FROM tbl_user_ass AS u 
                  INNER JOIN tbl_cargo AS c ON u.id_cargo_user_ass = c.id_cargo 
                  INNER JOIN tbl_setor AS s ON u.id_setor_user_ass = s.id_setor 
                  INNER JOIN tbl_ramal AS r ON u.id_ramal_user_ass = r.id_ramal 
                  INNER JOIN tbl_empresa AS e ON u.id_empresa_user_ass = e.id_empresa 
                  WHERE u.id_user_ass = $1';
		$query = pg_query_params($conn, $sql, $arr);
		$result = pg_fetch_assoc($query);

		if($result){
			/** @noinspection DuplicatedCode */
			$row = pg_fetch_array($query, 0, PGSQL_NUM);
			$nome = $row[0];
			$email = $row[1];
			$telefone = $row[2];
			$id_coordenador = $row[3];
			$cargo = $row[4];
			$setor = $row[5];
			$ramal = $row[6];
			$empresa = $row[7];

			echo "<font color='#002060'><b>" . $nome . "</b></font><br>";
			echo $cargo . " " . $setor . "<br>";

			if($empresa == "Agência Bacias PCJ"){
				echo $empresa . "<br>";
			}
			else{
				echo $empresa . " a serviço da Agência das Bacias PCJ<br>";
			}

			echo $email . "<br>";
			echo $telefone . " - Ramal: " . $ramal . "<br>";
			echo "www.agencia.baciaspcj.org.br <br><br>";


			$sql2 = "SELECT u.nome_user_ass, u.email_user_ass, u.telefone_user_ass, c.cargo, s.setor, r.ramal
                FROM tbl_user_ass AS u 
                INNER JOIN tbl_cargo AS c ON u.id_cargo_user_ass = c.id_cargo 
                INNER JOIN tbl_setor AS s ON u.id_setor_user_ass = s.id_setor 
                INNER JOIN tbl_ramal AS r ON u.id_ramal_user_ass = r.id_ramal 
                WHERE u.id_user_ass = $1";
			$array2 = array($id_coordenador);

			$query2 = pg_query_params($conn, $sql2, $array2);
			$result2 = pg_fetch_assoc($query2);

			if($result2){
				/** @noinspection DuplicatedCode */
				$row = pg_fetch_array($query2, 0, PGSQL_NUM);
				$nome = $row[0];
				$email = $row[1];
				$telefone = $row[2];
				$cargo = $row[3];
				$setor = $row[4];
				$ramal = $row[5];

				echo "<font color='#002060'><b>" . $nome . "</b></font><br>";
				echo $cargo . "<br>";
				echo $empresa . "<br>";
				echo $email . "<br>";
				echo $telefone . "<br>";
				echo "www.agencia.baciaspcj.org.br <br>";
				echo "<img src='https://www.agencia.baciaspcj.org.br/wp-content/uploads/2020/11/AGÊNCIA-PCJ.png' alt='Agência das Bacias PCJ' width='246' height='123'>";

			}
		}
	}
	else{
		echo "Erro";
	}
