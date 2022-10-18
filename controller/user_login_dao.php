<?php
    class user_login_dao{
        //função para validar o login do usuário
        public function validadeLogin(): bool{
            include_once("../controller/session_handler.php");
            $session = new session_handler();
            $session -> start_session();

            $login = $_SESSION['login'];
            $senha = $_SESSION['senha'];

            if ($login != null && $senha != null){
                require_once('../controller/connection_bd.php');
                $c = new connection_bd();
                $conn = $c -> openConnection();

	            $sql = "SELECT senha_user_login FROM tbl_user_login WHERE usuario_user_login = $1 LIMIT 1";

	            $query = pg_query_params($conn, $sql, array($login));
				$row = pg_fetch_assoc($query);

				if($row && password_verify($senha, $row['senha_user_login'])){
					$session -> regenerate_session_id();
					$_SESSION['state'] = true;
					$_SESSION['timeout'] = time();

					unset($_SESSION['login']);
					unset($_SESSION['senha']);

					$_SESSION['loginCount'] = 0;

					header("Location: ../view/exibir.php");

					return true;
				}
				else{
					unset($_SESSION['login']);
					unset($_SESSION['senha']);
					return false;
				}
            }
            else{
                $session -> clear_variables();
				return false;
            }

        }

		/* Essa função vai verificar se há um usuário logado
		 * Se houver um usuário logado e sua sessão for mais velha do que 10 minutos ele pede para fazer login novamente
		 */
        public function verifyLoginState(): bool{
	        include_once("../controller/session_handler.php");
	        $session = new session_handler();
	        $session -> start_session();
	        $loginState = false;

	        $state = $_SESSION['state'];
			$lasttime = $_SESSION['timeout'];
	        $time = time() - 600;

	        if($state && $lasttime > $time){
		        $_SESSION['timeout'] = time();
		        $loginState = true;
	        }
	        else{
		        $session -> clear_variables();
		        header("Location: ../view/login.php");
	        }
	        return $loginState;
        }

		public function hashcah(){
			if($_SESSION['loginCount'] < 10){
				$options = [
					'cost' => 10 // ~0,005 segundos de carregamento
				];
			}
			else if($_SESSION['loginCount'] < 20){
				$options = [
					'cost' => 12 // ~1 segundo de carregamento
				];
			}
			else if($_SESSION['loginCount'] < 25){
				$options = [
					'cost' => 14 // ~14 segundos de carregamento
				];
			}
			else{
				$options = [
					'cost' => 20 //
				];
			}

			$passwd = 'Esse é o preço por logar no sistema. Ele aumenta exponencialmente caso o usuario erre a senha.';

			password_hash($passwd, PASSWORD_DEFAULT, $options);
		}
    }

