<?php
	require_once("../controller/session_handler.php");
	$session = new session_handler();
	$session -> start_session();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include_once('../controller/user_login_dao.php');
        $uldao = new user_login_dao();

        $login = clenInput($_POST['login']);
        $senha = htmlspecialchars($_POST['senha']);

        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;

        echo $login;
        echo $senha;

        $uldao -> validadeLogin();
    }
    else{
        $session -> end_session();
    }

    function clenInput($value): string{
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $value = strval($value);
        return $value;
    }
?>

<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Assinaturas de Email - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style_login.css" rel="stylesheet">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-29EZ3X1WTK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-29EZ3X1WTK');
    </script>
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
            <input type="submit" name="submit" class="btn btn-primary" value="Login">
        </form>
    </div>
</div>
</body>
</html>

