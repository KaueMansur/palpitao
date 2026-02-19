<?php
require "../model/database.php";

$db = new Database();

date_default_timezone_set('America/Sao_Paulo');

$data_atual = date('Y/m/d');
$hora_atual = date("H:i:s");

if ($_POST["pagou"] != null && $_POST["id"] != null) {
    $ids = $_POST["id"];
    $valores = $_POST["pagou"];
    $valoresFormatados = [];
    $todosOsIndices = [];
    $divida = [];
    $valoresFinais = [];

    foreach ($valores as $valor) {
        $valorFormatado = str_replace(",", ".", substr($valor, 4));
        array_push($valoresFormatados, $valorFormatado);
    }

    foreach ($valoresFormatados as $index => $valor) {
        if ($valor > 0) {
            $todosOsIndices[] = $index;
        }
    }

    foreach ($todosOsIndices as $i) {

        $db->insert(
            "INSERT INTO pagamentos (valor, data_pagamento, hora, id_jogador) VALUES ('$valoresFormatados[$i]', '$data_atual', '$hora_atual', $ids[$i])"
        );

        $db->update(
            "UPDATE jogadores SET divida = divida - $valoresFormatados[$i] WHERE id_jogadores = $ids[$i]"
        );
    }
}


header("Refresh: 0; URL = ../view/adm.php");
