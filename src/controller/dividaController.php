<?php 
require "../model/database.php";

$db = new Database();

date_default_timezone_set('America/Sao_Paulo');

$data_atual = date('Y/m/d');
$hora_atual = date("H:i:s");


if($_POST["pagou"] != null){
    //Pagaram o que deviam
    foreach($_POST["pagou"] as $u){
        
        $divida = $db->select(
            "SELECT divida FROM jogadores WHERE id_jogadores = $u"
        );

        $db->insert(
            "INSERT INTO pagamentos (valor, data_pagamento, hora, id_jogador) VALUES ({$divida[0]->divida}, '$data_atual', '$hora_atual', $u)"
        );

        $db->update(
            "UPDATE jogadores SET divida = 0 WHERE id_jogadores = $u"
        );
    }
}

header("Refresh: 0; URL = ../view/adm.php");   

?>