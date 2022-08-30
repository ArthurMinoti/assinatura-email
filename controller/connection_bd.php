<?php

class connection_bd {
    public function openConnection(): \PgSql\Connection|bool{
	    $syntax = "host=localhost port=5432 dbname=assinatura_email user=postgres password=root";
        $conn = pg_connect($syntax);
        //https://stackoverflow.com/questions/7438059/fatal-error-call-to-undefined-function-pg-connect

        //Verificar se houve erro de conexão
        if ($conn == null){
            echo 'Erro' . $conn;
        }
        return $conn;
    }

    public function closeConnection($conn): void{
        $conn -> close();
    }

    public function closeStatement($conn, $stmt): void{
        $conn -> close();
        $stmt -> close();
    }
}
