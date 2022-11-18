<?php
	require_once("../controller/session_handler.php");
	require_once('../controller/user_login_dao.php');

	$session = new session_handler();
	$uldao = new user_login_dao();

	$session -> startSession();
	$loginState = $uldao -> verifyLoginState();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Assinaturas de Email</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="style2.css" rel="stylesheet">
</head>

<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="../view/index.php">Sistema de Assinatura de Emails</a>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="inserir.php">Inserir Colaborador</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="exibir.php">Exibir Todos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="excluir.php">Excluir</a>
				</li>
                <li class="nav-item">
                    <a class="nav-link" href="inserirCER.php">Inserir Cargo, Empresa ou Ramal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gerar.php">Gerar Assinatura</a>
                </li>
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<div class="shadow-lg p-3 mb-5 bg-body rounded">

		<span class="title">Digite o Id do usuário que será deletado: </span>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon2">Id</span>
                <input type="text" name="nome" class="form-control" placeholder="ID" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                <button type="submit" class="btn btn-outline-primary" name="submit" value="Choose option">Excluir</button>
            </div>
        </form>
		<br><br>


		<div class="table">
			<table class="table table-hover">
				<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nome</th>
					<th scope="col">Email</th>
					<th scope="col">Telefone</th>
					<th scope="col">Última Atualização</th>
					<th scope="col">É Coordenador?</th>
					<th scope="col">Coordenador</th>
					<th scope="col">Cargo</th>
					<th scope="col">Setor</th>
					<th scope="col">Ramal</th>
					<th scope="col">Empresa</th>
				</tr>
				</thead>

				<?php
					/** @noinspection DuplicatedCode */
					/** @noinspection DuplicatedCode */
					include_once ("../controller/user_ass_dao.php");
					$uadao = new user_ass_dao();
					$result = $uadao -> selectUser();

					if(pg_num_rows($result) > 0){
						while($row = pg_fetch_assoc($result)){
							$id = $row['id_user_ass'];
							$nome = $row['nome_user_ass'];
							$email = $row['email_user_ass'];
							$telefone = $row['telefone_user_ass'];
							$last_update = $row['last_update_user_ass'];
							$isCoord = $row['isCoordenador'];
							$coord = $row['id_coordenador'];
							$cargo = $row['cargo'];
							$setor = $row['setor'];
							$ramal = $row['ramal'];
							$empresa = $row['empresa'];

							if($isCoord == "t"){
								echo "<tbody>";
								echo    "<tr>";
								echo        "<th scope='row'>$id</th>";
								echo        "<td>$nome</td>";
								echo        "<td>$email</td>";
								echo        "<td>$telefone</td>";
								echo        "<td>$last_update</td>";
								echo        "<td colspan='2'>Sim</td>";
							}
							else{
								$nome_coor = $uadao -> getNomeCoord($coord);
								echo "<tbody>";
								echo    "<tr>";
								echo        "<th scope='row'>$id</th>";
								echo        "<td>$nome</td>";
								echo        "<td>$email</td>";
								echo        "<td>$telefone</td>";
								echo        "<td>$last_update</td>";
								echo        "<td>Não</td>";
								echo        "<td>$nome_coor</td>";
							}

							echo        "<td>$cargo</td>";
							echo        "<td>$setor</td>";
							echo        "<td>$ramal</td>";
							echo        "<td>$empresa</td>";
							echo    "</tr>";
							echo "</tbody>";
						}
					}
				?>
			</table>
		</div>
        <a class="btn btn-outline-primary" href="login.php" role="button">Sair</a><br>
	</div>
</div>
</body>
</html>


