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
                    <a class="nav-link" href="excluir.php">Excluir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="inserirCER.php">Inserir Cargo, Empresa ou Ramal</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
<div class="shadow-lg p-3 mb-5 bg-body rounded">
    <span class="title">Inserir Ramal</span><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Ramal</span>
            <input type="text" name="ramal" class="form-control" aria-label="Nome" aria-describedby="basic-addon2" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Sala</span>
            <input type="text" name="sala" class="form-control" aria-label="Telefone" aria-describedby="basic-addon2">
        </div>
        <div class="buttons-insert">
            <button type="submit" class="btn btn-outline-primary" name="submit" value="Choose option">Cadastrar Novo Ramal</button>

        </div>
    </form><br><br>

    <span class="title">Inserir Empresa</span><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Empresa</span>
            <input type="text" name="empresa" class="form-control" aria-label="Empresa" aria-describedby="basic-addon2" required>
        </div>
        <div class="buttons-insert">
            <button type="submit" class="btn btn-outline-primary" name="submit" value="Choose option">Cadastrar Nova Empresa</button>
        </div>
    </form><br><br>

    <span class="title">Inserir Cargo</span><br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon2">Cargo</span>
            <input type="text" name="cargo" class="form-control" aria-label="Empresa" aria-describedby="basic-addon2" required>
        </div>
        <div class="buttons-insert">
            <button type="submit" class="btn btn-outline-primary" name="submit" value="Choose option">Cadastrar Novo Cargo</button>
        </div>
    </form><br><br>

    <a class="btn btn-outline-primary" href="login.php" role="button">Sair</a><br>
    </div>
</div>
</body>
</html>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		require_once("../Controller/connection_bd.php");

		$c = new connection_bd();
		$conn = $c -> openConnection();

		include_once("../controller/user_ass_dao.php");
		$uad = new user_ass_dao();

        if(isset($_POST['ramal']) && isset($_POST['sala'])){
            $uad -> insertRamal($_POST['ramal'], $_POST['sala']);
        }
        else if(isset($_POST['empresa'])){
            $uad -> insertEmpresa($_POST['empresa']);
        }
        else if(isset($_POST['cargo'])){
            $uad -> insertCargo($_POST['cargo']);
        }
	}
?>














