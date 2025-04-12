<?php 

session_start();

if(!isset($_SESSION["adm"])){
    header("Refresh: 0; URL = ../../index.php");
}

require "../model/jogador.php";

$jogador = new Jogador();

$db = new Database();

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
    if(isset($testeStatusJogo2[0])){

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
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de controle</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<h1> <span style="color: blue;">Painel de </span><span style="color: red;">controle</span></h1>

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
                    <td> <input type="number" name="placarC<?= $u->id_jogadores?>" placeholder="<?= count($times) > 0 ? $times[0] : "" ?>" <?= isset($palpitesC[$u->id_jogadores][0]) ? "disabled value='{$palpitesC[$u->id_jogadores][0]}'" : "" ?>> </td>
                        <td> <input type="number" name="placarF<?= $u->id_jogadores?>" placeholder="<?= count($times) > 1 ? $times[1] : "" ?>" <?= isset($palpitesC[$u->id_jogadores][1]) ? "disabled value='{$palpitesC[$u->id_jogadores][1]}'" : "" ?>> </td>
                        <td> <input type="number" name="placarC<?= $u->id_jogadores?>2" placeholder="<?= count($times) > 2 ? $times[2] : "" ?>" <?= isset($palpitesF[$u->id_jogadores][0]) ? "disabled value='{$palpitesF[$u->id_jogadores][0]}'" : "" ?>> </td>
                        <td> <input type="number" name="placarF<?= $u->id_jogadores?>2" placeholder="<?= count($times) > 3 ? $times[3] : "" ?>" <?= isset($palpitesF[$u->id_jogadores][1]) ? "disabled value='{$palpitesF[$u->id_jogadores][1]}'" : "" ?>> </td>
                        <td><?= $u->pontos ?></td>
                        <td><?= $u->divida ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <input type="submit" value="Palpitar">
    </form>
    <form action="../controller/finishRodadas.php" method="post">
        <input type="number" name="respostaC" id="respostaC" placeholder="<?= count($times) > 0 ? $times[0] : "" ?>" <?= count($times) > 0 ? "" : "disabled" ?>>
        <input type="number" name="respostaF" id="respostaF" placeholder="<?= count($times) > 1 ? $times[1] : "" ?>" <?= count($times) > 1 ? "" : "disabled" ?>>
        <input type="number" name="respostaC2" id="respostaC2" placeholder="<?= count($times) > 2 ? $times[2] : "" ?>" <?= count($times) > 2 ? "" : "disabled" ?>>
        <input type="number" name="respostaF2" id="respostaF2" placeholder="<?= count($times) > 3 ? $times[3] : "" ?>" <?= count($times) > 3 ? "" : "disabled" ?>>
        <input type="submit" value="Finalizar rodada">
    </form>

    <form action="../controller/rodadaController.php" method="post">
        <div>
            <label for="timeDaCasa">Time da casa:</label>
            <input type="text" id="timeDaCasa" name="timeDaCasa" value="<?= count($times) > 0 ? "$times[0]" : "" ?>" <?= count($times) > 1 ? "disabled" : "" ?>>
        </div>
        <div>
            <label for="timeDeFora">Time de fora:</label>
            <input type="text" id="timeDeFora" name="timeDeFora" value="<?= count($times) > 1 ? "$times[1]" : "" ?>" <?= count($times) > 1 ? "disabled" : "" ?>>
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
    <form action="../controller/dividaController.php" method="post">
    <table>
        <thead>
            <th>Reposicionamento</th>
            <th>Posição</th>
            <th>Pontos</th>
            <th>Nome</th>
            <th>Cem Por Cento</th>
            <th></th>
            <th>Pontos na Rodada</th>
            <th>Dívida</th>
            <th>Pagou?</th>
        </thead>
        <tbody>
            <?php foreach($list as $u){ ?>
                <tr>
                    <td><?= $u->reposicionamento ?></td>
                    <td><?= $u->colocacao_atual ?></td>
                    <td><?= $u->pontos ?></td>
                    <td><?= $u->nome ?></td>
                    <td><?= $u->cem_porcento == "1" ? "💯" : "" ?></td>
                    <td><?= $u->titulo_de_posicao == "Líder" ? "👑" : "", $u->titulo_de_posicao == "Lanterna" ? "🔦" : "" ?></td>
                    <td><?= $u->pontos_na_rodada ?></td>
                    <td><?= $u->divida ?></td>
                    <td><input type="checkbox" name="pagou[]" value="<?= $u->id_jogadores ?>" <?= $u->divida == 0 ? "checked disabled" : "" ?>></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <input type="submit" value="Atualizar dívidas">
</form>
<a href="../controller/session_destroy.php">Log out</a>
</body>
</html>