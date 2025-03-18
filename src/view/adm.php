<?php 

// require "../model/database.php";

require "../model/jogador.php";

// require "../model/palpite.php";

// require "../model/rodada.php";

$jogador = new Jogador();

$db = new Database();

// $db = new Database();

$list = $jogador->getAllUsers();

$testeStatusJogo1 = $db->select("SELECT time_da_casa, time_de_fora FROM jogos_da_rodada WHERE status = 'em andamento' and numero_do_jogo = 1");
$testeStatusJogo2 = $db->select("SELECT time_da_casa, time_de_fora FROM jogos_da_rodada WHERE status = 'em andamento' and numero_do_jogo = 2");
$idJogo1 = $db->select("SELECT id_rodadas FROM jogos_da_rodada WHERE status = 'em andamento' and numero_do_jogo = 1");
$idJogo2 = $db->select("SELECT id_rodadas FROM jogos_da_rodada WHERE status = 'em andamento' and numero_do_jogo = 2");

$jogosDaRodada = [];

if($idJogo1 != null){
    array_push($jogosDaRodada, $idJogo1[0]->id_rodadas);
    if($idJogo2 != null){
        array_push($jogosDaRodada, $idJogo2[0]->id_rodadas);
    }
}


$times = [];

if(count($testeStatusJogo1) > 0){
    foreach($testeStatusJogo1 as $t){
        $timeCasa1 = $t->time_da_casa;
        $timeFora1 = $t->time_de_fora;

        array_push($times, $timeCasa1, $timeFora1);
    }
}

if(count($testeStatusJogo2) > 0){
    foreach($testeStatusJogo2 as $t){
        $timeCasa2 = $t->time_da_casa;
        $timeFora2 = $t->time_de_fora;

        array_push($times ,$timeCasa2, $timeFora2);
        // var_dump($timeCasa2, $timeFora2);
    }
}

$palpite = new Palpite();

$pList = $palpite->getAllPalpites();

$palpitesC = [];
$palpitesF = [];

if(isset($testeStatusJogo1[0])){

foreach($list as $u){

    foreach($pList as $p){

        if($p->id_jogador == $u->id_jogadores && $p->id_jogo_da_rodada == $idJogo1[0]->id_rodadas){



            // $jogo1 = [$p->placar[0], $p->placar[4]];
            
            // array_push($palpites, $jogo1);

            $palpitesC[$p->id_jogador] = [$p->placar[0], $p->placar[4]];
        }
    }

    foreach($pList as $p){
        if($p->id_jogador == $u->id_jogadores && $p->id_jogo_da_rodada == $idJogo2[0]->id_rodadas){
            
            // $jogo2 = [$p->placar[0], $p->placar[4]];
            // array_push($palpites, $p->id_jogador = [$jogo2]);
            
            $palpitesF[$p->id_jogador] = [$p->placar[0], $p->placar[4]];
            // var_dump($p->placar[0]);
            // var_dump($p->placar[4]);
        }
    }
}
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adm</title>
</head>
<body>
    <h1>ADM</h1>

    <form action="../controller/palpitarController.php" method="post">
        <table>
            <thead>
                <th>Nome</th>
                <th>placar da Casa</th>
                <th>placar Fora</th>
                <th>placar da Casa 2</th>
                <th>placar Fora 2</th>
                <th>pontos</th>
                <th>dívida</th>
            </thead>
            <tbody>
                <?php foreach($list as $u){ ?>
                    <tr>
                        <td><?= $u->nome ?></td>
                    <td> <input type="number" name="placarC<?= $u->id_jogadores?>" <?= count($times) > 0 ? "placeholder={$times[0]}" : "disabled" ?> <?= isset($palpitesC[$u->id_jogadores][0]) ? "value='{$palpitesC[$u->id_jogadores][0]}'". "disabled" : "" ?>> </td>
                        <td> <input type="number" name="placarF<?= $u->id_jogadores?>" <?= count($times) > 1 ? "placeholder={$times[1]}" : "disabled" ?> <?= isset($palpitesC[$u->id_jogadores][1]) ? "value='{$palpitesC[$u->id_jogadores][1]}'". "disabled" : "" ?>> </td>
                        <td> <input type="number" name="placarC<?= $u->id_jogadores?>2" <?= count($times) > 2 ? "placeholder={$times[2]}" : "disabled" ?> <?= isset($palpitesF[$u->id_jogadores][0]) ? "value='{$palpitesF[$u->id_jogadores][0]}'". "disabled" : "" ?>> </td>
                        <td> <input type="number" name="placarF<?= $u->id_jogadores?>2" <?= count($times) > 3 ? "placeholder={$times[3]}" : "disabled" ?> <?= isset($palpitesF[$u->id_jogadores][1]) ? "value='{$palpitesF[$u->id_jogadores][1]}'". "disabled" : "" ?>> </td>
                        <td><?= $u->pontos ?></td>
                        <td><?= $u->divida ?></td>
                    </tr>            
                    
                                
                <?php } ?>
            </tbody>
        </table>
        <input type="submit" value="Palpitar">
    </form>
    <form action="../controller/finalizarRodada.php" method="post">
        <input type="number" name="respostaC" id="respostaC" <?= count($times) > 0 ? "placeholder={$times[0]}" : "disabled" ?>>
        <input type="number" name="respostaF" id="respostaF" <?= count($times) > 1 ? "placeholder={$times[1]}" : "disabled" ?>>
        <input type="number" name="respostaC2" id="respostaC2" <?= count($times) > 2 ? "placeholder={$times[2]}" : "disabled" ?>>
        <input type="number" name="respostaF2" id="respostaF2" <?= count($times) > 3 ? "placeholder={$times[3]}" : "disabled" ?>>
        <input type="submit" value="Finalizar rodada">
    </form>

    <form action="../controller/rodadaController.php" method="post">
        <div>
            <label for="timeDaCasa">Time da casa:</label>
            <input type="text" id="timeDaCasa" name="timeDaCasa" <?= count($times) > 0 ? "disabled value={$times[0]}" : "" ?>>
        </div>
        <div>
            <label for="timeDeFora">Time de fora:</label>
            <input type="text" id="timeDeFora" name="timeDeFora" <?= count($times) > 1 ? "disabled value={$times[1]}" : "" ?>>
        </div>
        <div>
            <label for="timeDaCasa2">Time da casa:</label>
            <input type="text" id="timeDaCasa2" name="timeDaCasa2" value="<?= count($times) > 0 ? isset($times[2]) ? $times[2] : "" : "" ?>" <?= count($times) > 0 ? "disabled" : "" ?> >
        </div>
        <div>
            <label for="timeDeFora2">Time de fora:</label>
            <input type="text" id="timeDeFora2" name="timeDeFora2" value="<?= count($times) > 0 ? isset($times[3]) ? $times[3] : "" : "" ?>" <?= count($times) > 0 ? "disabled" : "" ?> >
        </div>
        <input type="submit" value="Iniciar rodada" <?= count($times) > 0 ? "disabled" : "" ?>>
    </form>
    <script src="../../assets/js/script.js"></script>
</body>
</html>