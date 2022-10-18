<?php
	require_once("../controller/session_handler.php");
	$session = new session_handler();
	$session -> start_session();

	if (isset($_SESSION['loginCount'])){
		$_SESSION['loginCount']++;
	} else {
		$_SESSION['loginCount'] = 0;
	}

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include_once('../controller/user_login_dao.php');
        $uldao = new user_login_dao();

        $login = cleanInput($_POST['login']);
        $senha = cleanInput($_POST['senha']);

        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;

	    $resp = $uldao -> validadeLogin();

        if(!$resp){
	        $uldao -> hashcah();
        }

    }
    else{
        $session -> end_session();
    }

    function cleanInput($value): string{
	    $value = htmlspecialchars($value); //transforma caracteres especias em comando htmlz
        $value = trim($value); //remove comandos de formatação como \n, \t, etc
        $value = stripslashes($value); //remove barras \
        return strval($value); //transforma para string
    }
?>

<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Assinaturas de Email - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style_login.css?<?=filemtime("style.css")?>" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-29EZ3X1WTK"></script>
</head>

<body>
<div class="container">
    <div class="shadow-lg p-3 mb-5 bg-body rounded">
        <span class="title">Cadastro de Emails - Login</span>
        <br><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="input-group mb-3">
                <span class="input-group-text">Login</span>
                <input type="text" name="login" placeholder="Login" class="form-control" aria-label="Login" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Senha</span>
                <input type="password" name="senha" placeholder="Senha" class="form-control" aria-label="Senha" aria-describedby="inputGroup-sizing-default" required>
            </div><br>
                <div class="row">
                    <div class="col">
                        <a class="btn btn-outline-primary voltar" href="index.php" role="button">voltar</a>
                    </div>
                    <div class="col">
                        <input type="submit" name="submit" class="btn btn-primary" value="Login">
                    </div>
                </div>
        </form>
        <br><br>
    </div>
</div>
</body>
</html>