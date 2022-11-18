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
    <script type="text/javascript">
        function gerar_ass(email){
            let array = 'email=' + email;
            const xml = new XMLHttpRequest();

            xml.open("POST", "http://127.0.0.1/controller/gerar_ass_dao.php", true); //TODO alterar link em produção
            xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xml.onreadystatechange  = function (){
                if( xml.readyState === 4 && xml.status === 200 ) {
                    document.getElementById("ass").innerHTML = xml.responseText;
                }
            }
            xml.send(array);
        }

    </script>
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
                    <a class="nav-link" href="inserirCER.php">Inserir Cargo, Empresa ou Ramal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="gerar.php">Gerar Assinatura</a>
                </li>
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<div class="shadow-lg p-3 mb-5 bg-body rounded">

		<span class="title">Exibição de Todos</span>

        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupSelect01">Nome</label>
            <select class="form-select" name="nome" id="nome" required>
                <option selected></option>

				<?php
					include_once('../Controller/connection_bd.php');

					$connectionClass = new connection_bd();
					$con = $connectionClass -> openConnection();
					$sql = 'SELECT email_user_ass, nome_user_ass FROM tbl_user_ass ORDER BY nome_user_ass';

					$result = pg_query($con, $sql);

					if($result){
						while ($row = pg_fetch_assoc($result)){
							echo "<option value='" . $row['email_user_ass'] . "'>" . $row['nome_user_ass'] . "</option>";
						}
					}
				?>
            </select>
        </div><br>
        <div id="ass"></div>


        <button id="action" class="btn btn-outline-primary">Gerar</button>
        <a class="btn btn-outline-primary" href="login.php" role="button">Sair</a><br>
	</div>
</div>

<script type="text/javascript">
    document.getElementById("action").addEventListener("click", function (){
        let email = document.getElementById("nome").value; //TODO terminar configuração

        console.log(email);

        gerar_ass(email);
    });
</script>

</body>
</html>

