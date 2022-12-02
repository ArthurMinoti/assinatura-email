<?php

class view_functions{
    function getTable(): string{
        include_once ($_SERVER['DOCUMENT_ROOT'] . "/controller/user_ass_dao.php");
        $uadao = new user_ass_dao();
        $result = $uadao -> selectUser();
        
        $returnVar = "<table class='table table-hover'>";
        $returnVar .= "<thead>";
		$returnVar .= "<tr>";
		$returnVar .= "<th scope='col'>#</th>";
		$returnVar .= "<th scope='col'>Nome</th>";
		$returnVar .= "<th scope='col'>Email</th>";
		$returnVar .= "<th scope='col'>Telefone</th>";
		$returnVar .= "<th scope='col'>Última Atualização</th>";
		$returnVar .= "<th scope='col'>É Coordenador?</th>";
		$returnVar .= "<th scope='col'>Coordenador</th>";
		$returnVar .= "<th scope='col'>Cargo</th>";
		$returnVar .= "<th scope='col'>Setor</th>";
		$returnVar .= "<th scope='col'>Ramal</th>";
		$returnVar .= "<th scope='col'>Empresa</th>";
		$returnVar .= "</tr>";
		$returnVar .= "</thead>";
					

        if(pg_num_rows($result) > 0){
            while($row = pg_fetch_assoc($result)){
                $id = $row['id_user_ass'];
                $nome = $row['nome_user_ass'];
                $email = $row['email_user_ass'];
                $telefone = $row['telefone_user_ass'];
                $last_update = $row['last_update_user_ass'];
                $isCoord = $row['isCoordenador'];
                $coord = $row['id_coordenador'];
                $cargo = $row['cargo'];
                $setor = $row['setor'];
                $ramal = $row['ramal'];
                $empresa = $row['empresa'];

                if($isCoord == "t"){
                    $returnVar .= "<tbody>";
                    $returnVar .= "<tr>";
                    $returnVar .= "<th scope='row'>$id</th>";
                    $returnVar .= "<td>$nome</td>";
                    $returnVar .= "<td>$email</td>";
                    $returnVar .= "<td>$telefone</td>";
                    $returnVar .= "<td>$last_update</td>";
                    $returnVar .= "<td colspan='2'>Sim</td>";
                }
                else{
                    $nome_coor = $uadao -> getNomeCoord($coord);
                    $returnVar .= "<tbody>";
                    $returnVar .= "<tr>";
                    $returnVar .= "<th scope='row'>$id</th>";
                    $returnVar .= "<td>$nome</td>";
                    $returnVar .= "<td>$email</td>";
                    $returnVar .= "<td>$telefone</td>";
                    $returnVar .= "<td>$last_update</td>";
                    $returnVar .= "<td>Não</td>";
                    $returnVar .= "<td>$nome_coor</td>";
                }

                $returnVar .= "<td>$cargo</td>";
                $returnVar .= "<td>$setor</td>";
                $returnVar .= "<td>$ramal</td>";
                $returnVar .= "<td>$empresa</td>";
                $returnVar .= "</tr>";
                $returnVar .= "</tbody>";
            }
        }
        $returnVar .= "</table>";

        return $returnVar;
    }


}