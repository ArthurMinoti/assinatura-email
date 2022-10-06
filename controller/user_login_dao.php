<?php
    class user_login_dao{
        //função para validar o login do usuário
        public function validadeLogin(): void{
            include_once("../controller/session_handler.php");
            $session = new session_handler();
            $session -> start_session();

            $login = $_SESSION['login'];
            $senha = $_SESSION['senha'];

            if ($login != null && $senha != null){
                require_once('../controller/connection_bd.php');
                $c = new connection_bd();
                $conn = $c -> openConnection();

	            $sql = "SELECT id_user_login FROM tbl_user_login WHERE usuario_user_login = $1 AND senha_user_login = $2 LIMIT 1";
				$array = array($login, $senha);

	            $query = pg_query_params($conn, $sql, $array);
				$row = pg_fetch_assoc($query);

                if($row){
                    $session -> regenerate_session_id();
                    $_SESSION['state'] = true;
                    $_SESSION['timeout'] = time();

					unset($_SESSION['login']);
					unset($_SESSION['senha']);

                    header("Location: ../view/insert.php");
                }
                else{
                    $session -> clear_variables();
	                header("Location: ../view/login.php");
                }
            }
            else{
                $session -> clear_variables();
                header("Location: ../view/login.php");
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


    }