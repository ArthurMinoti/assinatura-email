<?php
    class session_handler{
        //função para iniciar a sessão
        function start_session(): void{
            $this -> verifyOpenSession();

            //não deixa utilizar ID de sessão antigos
            if(!isset($_SESSION['deleted_time']) || $_SESSION['deleted_time'] < time() - 600){
				$this -> regenerate_session_id();
			}
        }

        //função para regenerar o id da sessão
        function regenerate_session_id(): void{
            $this -> verifyOpenSession();

            //utiliza um prefixo pré definido
            $newid = session_create_id('email-signature');

            //guarda as variáveis definidas na sessão anterior
            session_commit();

	        //desabilita o uso restrito
	        //ini_set('session.use_strict_mode', 0);

            //cria o id de sessão com o prefixo definido anteriormente
            session_id($newid);

            //reabilita o uso restrito (deixa as comunicações mais seguras) https://www.php.net/manual/en/session.configuration.php#ini.session.use-strict-mode
            ini_set('session.use_strict_mode', 1);
	        ini_set('session.use_only_cookies', 1);
			ini_set('session.use_trans_sid', 0);

            //inicia a sessão
	        session_start();

	        //define quando a sessão foi criada
	        $_SESSION['deleted_time'] = time();
        }

        //função para limpar todas as variáveis da sessão atual
        function clear_variables(): void{
            $this -> verifyOpenSession();

            session_unset();
            $this -> regenerate_session_id();
        }

        //função para limpar e parar a sessão
        function end_session(): void{
            $this -> verifyOpenSession();

            session_unset();
            session_destroy();
        }

        //função que verifica se há uma sessão aberta, se não abre uma
        function verifyOpenSession(): void{
            if (session_status() !== PHP_SESSION_ACTIVE){
                session_start();
            }
        }
    }