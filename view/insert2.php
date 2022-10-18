<?php
	require_once("../controller/session_handler.php");
    require_once('../controller/user_login_dao.php');

    $session = new session_handler();
    $uldao = new user_login_dao();

    $session -> start_session();
    //$loginState = $uldao -> verifyLoginState();

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
                    <a class="nav-link active" aria-current="page" href="insert.php">Inserir Colaborador</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="exibir.php">Exibir Todos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="excluir.php">Excluir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="inserir2.php">Inserir Setor, Cargo, Empresa ou Ramal</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Busca" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar Colaborador</button>
            </form>
        </div>
    </div>
</nav>
<div class="container">
<div class="shadow-lg p-3 mb-5 bg-body rounded">
      <span class="title">Cadastro de Emails</span>
      <br><br>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <!--Inserção do email do usuário-->
            <div class="input-group mb-3">
                <input type="text" name="email" class="form-control" placeholder="Email da agência" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                <span class="input-group-text" id="basic-addon2">@agencia.baciaspcj.org.br</span>
            </div><br>

            <!--Inserção do nome do usuário-->
            <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon2">Nome</span>
                  <input type="text" name="nome" class="form-control" placeholder="Nome" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
            </div><br>

            <!--Inserção do telefone-->
            <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon2">Telefone</span>
                  <input type="text" name="telefone" class="form-control" placeholder="Telefone" aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div><br>

            <!--selecão do coordenador-->
            <span class="input-group-text" id="basic-addon2">É coordenador?</span>
            <div class="form-check form-check-inline">
                  <input id="sim" class="form-check-input" type="radio" name="radio" value="1" required>
                  <label class="form-check-label" for="inlineRadio1">Sim </label>
            </div>
            <div class="form-check form-check-inline">
                  <input id="nao" class="form-check-input" type="radio" name="radio" value="2" required>
                  <label class="form-check-label" for="inlineRadio2">Não</label>
            </div><br><br>

            <!--Select do coordenador-->
            <div id="coord" class="input-group mb-3" style="display: none">
                  <label class="input-group-text" for="inputGroupSelect01">Coordenador</label>
                  <select class="form-select" name ="coord" required>
                        <option selected>Selecionar... (Caso seja coordenador, desconsidere)</option>

<?php
      include_once('../Controller/connection_bd.php');

      $connectionClass = new connection_bd();
      $con = $connectionClass -> openConnection();
      $sql = 'SELECT id_user_ass, nome_user_ass FROM tbl_user_ass WHERE "isCoordenador" = true';

      $result = pg_query($con, $sql);

      if($result){
            while ($row = pg_fetch_assoc($result)){
                echo "<option value='" . $row['id_user_ass'] . "'>" . $row['nome_user_ass'] . "</option>";
            }
      }
?>
                </select>
            </div><br>

    <!--Select dos setores-->
            <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Setor</label>
                  <select class="form-select" name ="setor" required>
                        <option selected>Selecionar...</option>

<?php
      require_once('../Controller/connection_bd.php');

      $connectionClass = new connection_bd();
      $con = $connectionClass -> openConnection();
      $sql = "SELECT * from tbl_setor ORDER BY setor";

      $result = pg_query($con, $sql);

      if($result){
            while($setor = pg_fetch_assoc($result)){
                echo "<option value='" . $setor['id_setor'] . "'>" . $setor['setor'] . "</option>";
            }
      }
?>
                </select>
            </div><br>

    <!--Select dos cargos-->
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Cargo</label>
                <select class="form-select" id="cargo" name=cargo required>
                <option selected>Selecionar...</option>

<?php
    require_once('../Controller/connection_bd.php');

    $connectionClass = new connection_bd();
    $con = $connectionClass -> openConnection();
    $sql = "SELECT * from tbl_cargo ORDER BY cargo";

    $result = pg_query($con, $sql);

    if($result){
          while($cargo = pg_fetch_assoc($result)){
                echo "<option value='" . $cargo['id_cargo'] . "'>" . $cargo['cargo'] . "</option>";
          }
    }
?>
                </select>
            </div><br>

    <!--Select dos ramais-->
            <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Ramal</label>
                  <select class="form-select" id="ramal" name="ramal" required>
                  <option selected>Selecionar...</option>

<?php
      require_once('../Controller/connection_bd.php');

      $connectionClass = new connection_bd();
      $con = $connectionClass -> openConnection();
      $sql = "SELECT * from tbl_ramal ORDER BY sala";

      $result = pg_query($con, $sql);

      if($result){
            while($ramal = pg_fetch_assoc($result)){
                echo "<option value='" . $ramal['id_ramal'] . "'> Ramal:" . $ramal['ramal'] . "  -  Sala:" . $ramal['sala'] . "</option>";
            }
      }
?>
                </select>
            </div><br>

    <!--Select dos empresas-->
            <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupSelect01">Empresa</label>
                  <select class="form-select" id="empresa" name="empresa" required>
                  <option selected>Selecionar...</option>

<?php
    require_once('../Controller/connection_bd.php');

    $connectionClass = new connection_bd();
    $con = $connectionClass -> openConnection();
    $sql = "SELECT * from tbl_empresa ORDER BY empresa";

    $result = pg_query($con, $sql);

    if($result){
        while($empresa = pg_fetch_assoc($result)){
            echo "<option value='" . $empresa['id_empresa'] . "'>" . $empresa['empresa'] . "</option>";
        }
    }
?>
                </select>
            </div><br>
                <div class="buttons-insert">
                    <button type="submit" class="btn btn-outline-primary" name="submit" value="Choose option">Cadastrar</button>
                    <a class="btn btn-outline-primary" href="login.php" role="button">Sair</a><br>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php
    $nome = "";
    $email = "";
    $telefone = "";
    $isCoordenador = false;
    $isCoordInt = 0;
    $coord = "";
    $cargo = "";
    $ramal = "";
    $empresa = "";


    if(isset($_POST['nome'])){
        $nome = $_POST['nome'];
    }

    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $email .= "@agencia.baciaspcj.org.br";
    }

    if(isset($_POST['telefone'])){
        $telefone = $_POST['telefone'];
    }

    if(isset($_POST['submit'])){
        $radio = $_POST['myRadio'];
        if($radio == "1"){
            $isCoordenador = true;
        }
        if(!empty($_POST['coord'])){
            $coord = $_POST['coord'];
        //echo "Setor: " . $setor;
        }
        else{
            echo "Você não selecionou nada!";
        }
        if(!empty($_POST['setor'])){
            $setor = $_POST['setor'];
        //echo "Setor: " . $setor;
        }
        else{
            echo "Você não selecionou nada!";
        }
        if(!empty($_POST['cargo'])){
            $cargo = $_POST['cargo'];
        //echo "Cargo: " . $cargo;
        }
        else{
            echo "Você não selecionou nada!";
        }
        if(!empty($_POST['ramal'])){
            $ramal = $_POST['ramal'];
        //echo "Ramal: " . $ramal;
        }
        else{
            echo "Você não selecionou nada!";
        }
        if(!empty($_POST['empresa'])){
            $empresa = $_POST['empresa'];
        //echo "Empresa: " . $empresa;
        }
        else{
            echo "Você não selecionou nada!";
        }
    }

  //insert no banco de dados
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require_once("../Controller/connection_bd.php");

        $c = new connection_bd();
        $conn = $c -> openConnection();

	    include_once("../controller/user_ass_dao.php");
	    $uad = new user_ass_dao();

	    if(!$isCoordenador){
		    $uad -> insertNewNotCoord($nome, $email, $telefone, $coord, $cargo, $setor, $ramal, $empresa);
        }
        else{
	        $uad -> insertNewCoord($nome, $email, $telefone, $cargo, $setor, $ramal, $empresa);
        }
    }

?>
