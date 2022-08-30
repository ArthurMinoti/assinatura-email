<?php
	include_once("../Controller/connection_bd.php");

	$c = new connection_bd();
	$conn = $c -> openConnection();

	$email = $_POST['email'];
//	$email = "arthur.minoti@agencia.baciaspcj.org.br";
	$Id = 0;

	$sql_email = 'SELECT id_user_ass FROM tbl_user_ass WHERE email_user_ass = $1';
	$arr = array($email);
	$query = pg_query_params($conn, $sql_email, $arr);
	$row = pg_fetch_assoc($query);

	if($row){
		$rowcoord = pg_fetch_array($query, 0, PGSQL_NUM);
		$Id = $rowcoord[0];
	}


	$sql= 'SELECT "isCoordenador" FROM tbl_user_ass WHERE id_user_ass = $1';
	$arr = array($Id);
	$query = pg_query_params($conn, $sql, $arr);
	$row = pg_fetch_assoc($query);

	$assinatura = "";
	$isCoordenador = "";

	if($row){
		$rowcoord = pg_fetch_array($query, 0, PGSQL_NUM);
		$isCoordenador = $rowcoord[0];
	}

	if($isCoordenador == "t"){
		$sql = "SELECT u.nome_user_ass, u.email_user_ass, u.telefone_user_ass, c.cargo, s.setor, r.ramal, e.empresa 
                  FROM tbl_user_ass AS u 
                  INNER JOIN tbl_cargo AS c ON u.id_cargo_user_ass = c.id_cargo 
                  INNER JOIN tbl_setor AS s ON u.id_setor_user_ass = s.id_setor 
                  INNER JOIN tbl_ramal AS r ON u.id_ramal_user_ass = r.id_ramal 
                  INNER JOIN tbl_empresa AS e ON u.id_empresa_user_ass = e.id_empresa 
                  WHERE u.id_user_ass = " . $Id;

		$result = pg_query($conn, $sql);

		if(pg_num_rows($result) > 0){
			$row = pg_fetch_assoc($result);
			$nome = $row['nome_user_ass'];
			$email = $row['email_user_ass'];
			$telefone = $row['telefone_user_ass'];
			$cargo = $row['cargo'];
			$setor = $row['setor'];
			$ramal = $row['ramal'];
			$empresa = $row['empresa'];

		/*	$assinatura = "<font color='#002060'><b>" . $nome . "</b></font><br>";
			$assinatura .= $cargo . "<br>";
			$assinatura .= $empresa . "<br>";
			$assinatura .= $email . "<br>";
			$assinatura .= $telefone . "<br>";
			$assinatura .= "www.agencia.baciaspcj.org.br <br>";
			$assinatura .= "<img src='Logo_pcj.png' alt='Agência das Bacias PCJ' width='246' height='123'>";*/

			echo "<font color='#002060'><b>" . $nome . "</b></font><br>";
			echo $cargo . "<br>";
			echo $empresa . "<br>";
			echo $email . "<br>";
			echo $telefone . "<br>";
			echo "www.agencia.baciaspcj.org.br <br>";
			echo "<img src='Logo_pcj.png' alt='Agência das Bacias PCJ' width='246' height='123'>";
		}
	}
	else if($isCoordenador == "f"){
		$query = "SELECT u.nome_user_ass, u.email_user_ass, u.telefone_user_ass, u.id_coordenador, c.cargo, s.setor, r.ramal, e.empresa 
                  FROM tbl_user_ass AS u 
                  INNER JOIN tbl_cargo AS c ON u.id_cargo_user_ass = c.id_cargo 
                  INNER JOIN tbl_setor AS s ON u.id_setor_user_ass = s.id_setor 
                  INNER JOIN tbl_ramal AS r ON u.id_ramal_user_ass = r.id_ramal 
                  INNER JOIN tbl_empresa AS e ON u.id_empresa_user_ass = e.id_empresa 
                  WHERE u.id_user_ass = " . $Id;

		$result = pg_query($conn, $query);

		if(pg_num_rows($result) > 0){
			$row = pg_fetch_assoc($result);
			$nome = $row['nome_user_ass'];
			$email = $row['email_user_ass'];
			$telefone = $row['telefone_user_ass'];
			$id_coordenador = $row['id_coordenador'];
			$cargo = $row['cargo'];
			$setor = $row['setor'];
			$ramal = $row['ramal'];
			$empresa = $row['empresa'];

			/*$assinatura = "<font color='#002060'><b>" . $nome . "</b></font><br>";
			$assinatura .= $cargo . "<br>";*/

			echo "<font color='#002060'><b>" . $nome . "</b></font><br>";
			echo $cargo . "<br>";

			if($empresa == "Agência Bacias PCJ"){
				//$assinatura .= $empresa . "<br>";
				echo $empresa . "<br>";
			}
			else{
				//$assinatura .= $empresa . " a serviço da Agência das Bacias PCJ<br>";
				echo $empresa . " a serviço da Agência das Bacias PCJ<br>";
			}

			/*$assinatura .= $email . "<br>";
			$assinatura .= $telefone . " - Ramal: " . $ramal . "<br>";
			$assinatura .= "www.agencia.baciaspcj.org.br <br><br>";*/

			echo $email . "<br>";
			echo $telefone . " - Ramal: " . $ramal . "<br>";
			echo "www.agencia.baciaspcj.org.br <br><br>";

			$query2 = "SELECT u.nome_user_ass, u.email_user_ass, u.telefone_user_ass, c.cargo, s.setor, r.ramal, e.empresa 
                FROM tbl_user_ass AS u 
                INNER JOIN tbl_cargo AS c ON u.id_cargo_user_ass = c.id_cargo 
                INNER JOIN tbl_setor AS s ON u.id_setor_user_ass = s.id_setor 
                INNER JOIN tbl_ramal AS r ON u.id_ramal_user_ass = r.id_ramal 
                INNER JOIN tbl_empresa AS e ON u.id_empresa_user_ass = e.id_empresa 
                WHERE u.id_user_ass = '" . $id_coordenador . "'";

			$result2 = @pg_query($conn, $query2);

			if(@pg_num_rows($result2) > 0){
				while($row = @pg_fetch_assoc($result2)){
					$nome = $row['nome_user_ass'];
					$email = $row['email_user_ass'];
					$telefone = $row['telefone_user_ass'];
					$cargo = $row['cargo'];
					$setor = $row['setor'];
					$ramal = $row['ramal'];

				/*	$assinatura .= "<font color='#002060'><b>" . $nome . "</b></font><br>";
					$assinatura .= $cargo . "<br>";
					$assinatura .= $empresa . "<br>";
					$assinatura .= $email . "<br>";
					$assinatura .= $telefone . "<br>";
					$assinatura .= "www.agencia.baciaspcj.org.br <br>";
					$assinatura .= "<img src='Logo_pcj.png' alt='Agência das Bacias PCJ' width='246' height='123'>";*/

					echo "<font color='#002060'><b>" . $nome . "</b></font><br>";
					echo $cargo . "<br>";
					echo $empresa . "<br>";
					echo $email . "<br>";
					echo $telefone . "<br>";
					echo "www.agencia.baciaspcj.org.br <br>";
					echo "<img src='../view/Logo_pcj.png' alt='Agência das Bacias PCJ' width='246' height='123'>";
				}
			}

		}
		else{
			echo "Erro";
		}
	}
