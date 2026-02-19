<?php
require "../model/database.php";

$db = new Database();

date_default_timezone_set('America/Sao_Paulo');

$data_atual = date('Y/m/d');
$hora_atual = date("H:i:s");

$valorFinal;

// if ($_POST["pagou"] != null && $_POST["id"] != null) {
//     $ids = $_POST["id"];
//     $valores = $_POST["pagou"];
// foreach ($valores as $valor) {
//     $valorFinal = str_replace(",", ".", substr($valor, 4));
//         // echo $valorFinal . "\n\n";
//     }
// }


if ($_POST["pagou"] != null && $_POST["id"] != null) {
    $ids = $_POST["id"];
    $valores = $_POST["pagou"];
    $valoresFormatados = [];
    $todosOsIndices = [];
    $divida = [];
    $valoresFinais = [];

    //Pagaram o que deviam
    foreach ($valores as $valor) {
        $valorFormatado = str_replace(",", ".", substr($valor, 4));
        array_push($valoresFormatados, $valorFormatado);
    }

    foreach ($valoresFormatados as $index => $valor) {
        // 2. Verifica a condição (maior que zero)
        if ($valor > 0) {
            $todosOsIndices[] = $index; // 3. Adiciona o índice atual ao array global
        }
    }

    foreach ($todosOsIndices as $i) {

        // var_dump($divida[0]->divida);

        $db->insert(
            "INSERT INTO pagamentos (valor, data_pagamento, hora, id_jogador) VALUES ('$valoresFormatados[$i]', '$data_atual', '$hora_atual', $ids[$i])"
        );

        $db->update(
            "UPDATE jogadores SET divida = divida - $valoresFormatados[$i] WHERE id_jogadores = $ids[$i]"
        );
        // foreach($divida as $d){
        //     echo $d->divida."\n\n\n\n";
        // }
    }


    // }
    // var_dump($divida);
    // }
}




// echo "ID: " . $ids[0] . "\n\n\n";
// echo "ID: " . $ids[12] . "\n\n\n";
// echo "ID: " . $ids[19] . "\n\n\n";
// echo "ID: " . $ids[33] . "\n\n\n";

// echo "Valores: " . $valoresFormatados[0];
// echo "Valores: " . $valoresFormatados[12];
// echo "Valores: " . $valoresFormatados[19];
// echo "Valores: " . $valoresFormatados[33];


header("Refresh: 0; URL = ../view/adm.php");
