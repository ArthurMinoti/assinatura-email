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
<!--TODO criar função para gerar a tabela-->
		<div class="table">
            <?php
            require_once ($_SERVER['DOCUMENT_ROOT'] . "/controller/view_functions.php");

            $v = new view_functions();

            echo $v -> getTable();
            ?>
		</div>
        <a class="btn btn-outline-primary" href="login.php" role="button">Sair</a><br>
	</div>
</div>
</body>
</html>


