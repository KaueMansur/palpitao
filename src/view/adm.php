<?php

session_start();

if (!isset($_SESSION["adm"])) {
    header("Refresh: 0; URL = ../../index.php");
}

require "../model/jogador.php";

$jogador = new Jogador();

$db = new Database();

$list = $jogador->getAllUsers();
$listPalpites = $jogador->getAllPlayers();

$numeroRodada = $db->select("SELECT MAX(id_rodada) FROM jogos_da_rodada");

$testeStatusJogo1 = $db->select("SELECT time_casa, time_fora FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 1");
$testeStatusJogo2 = $db->select("SELECT time_casa, time_fora FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 2");
$idJogoUm = $db->select("SELECT id_jogo FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 1");
$idJogoDois = $db->select("SELECT id_jogo FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 2");

$jogosDaRodada = [];

if ($idJogoUm != null) {
    array_push($jogosDaRodada, $idJogoUm[0]->id_jogo);
    if ($idJogoDois != null) {
        array_push($jogosDaRodada, $idJogoDois[0]->id_jogo);
    }
}


$times = [];

if (count($testeStatusJogo1) > 0) {
    foreach ($testeStatusJogo1 as $t) {
        $timeCasa1 = $t->time_casa;
        $timeFora1 = $t->time_fora;

        array_push($times, $timeCasa1, $timeFora1);
    }
}

if (count($testeStatusJogo2) > 0) {
    foreach ($testeStatusJogo2 as $t) {
        $timeCasa2 = $t->time_casa;
        $timeFora2 = $t->time_fora;

        array_push($times, $timeCasa2, $timeFora2);
        // var_dump($timeCasa2, $timeFora2);
    }
}

$palpite = new Palpite();

$pList = $palpite->getAllPalpites();

$palpitesC = [];
$palpitesF = [];

if (isset($testeStatusJogo1[0])) {

    foreach ($list as $u) {

        foreach ($pList as $p) {

            if ($p->id_jogadores == $u->id_jogadores && $p->id_jogos == $idJogoUm[0]->id_jogo) {

                // var_dump($p);
                // $palpite->getPalpiteFromIds($p->id_jogos)
                // $jogo1 = [$p->placar[0], $p->placar[4]];

                // array_push($palpites, $jogo1);

                $palpitesC[$p->id_jogadores] = [$p->quantidade_gols_casa, $p->quantidade_gols_fora];
            }
        }
        if (isset($testeStatusJogo2[0])) {

            foreach ($pList as $p) {

                if ($p->id_jogadores == $u->id_jogadores && $p->id_jogos == $idJogoDois[0]->id_jogo) {

                    // $jogo2 = [$p->placar[0], $p->placar[4]];
                    // array_push($palpites, $p->id_jogador = [$jogo2]);

                    $palpitesF[$p->id_jogadores] = [$p->quantidade_gols_casa, $p->quantidade_gols_fora];
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

<body class="page">
    <h1> <span style="color: blue;">Painel d</span><span style="color: red;">e controle</span></h1>






    <form action="../controller/dividaController.php" method="post" id="tabela_form" class="forms">
        <h1 class="titulo_forms">Tabela</h1>
        <table id="tabela" class="tabela">
            <?php if (isset($numeroRodada[0]->{"MAX(id_rodada)"})) { ?>

                <h2 class="subtitulo_rodada">Rodada <?= $numeroRodada[0]->{"MAX(id_rodada)"} ?></h2>

            <?php } ?>

            <thead id="cabecalho_tabela">
                <th class="titulo_tabela">Reposicionamento</th>
                <th class="titulo_tabela">Posição</th>
                <th class="titulo_tabela">Nome</th>
                <th class="titulo_tabela">Pontos</th>
                <th class="titulo_tabela">Pontos na Rodada</th>
                <th class="titulo_tabela">Dívida</th>
                <th class="titulo_tabela">Pagou?</th>
            </thead>
            <tbody id="corpo_tabela">
                <?php foreach ($list as $u) { ?>
                    <tr class="linha_tabela">
                        <td class="item_tabela">
                            <div class="<?= $u->reposicionamento ?>"></div>
                        </td>
                        <td class="item_tabela"><?= $u->colocacao_atual ?></td>
                        <td class="item_tabela"><?= $u->nome ?><?= $u->titulo_de_posicao == "Líder" ? "👑" : "", $u->titulo_de_posicao == "Lanterna" ? "🔦" : "" ?><?= $u->cem_porcento == "1" ? "💯" : "" ?></td>
                        <td class="item_tabela"><?= $u->pontos ?></td>
                        <td class="item_tabela"><?= $u->pontos_na_rodada ?></td>
                        <td class="item_tabela">R$ <?= number_format($u->divida, 2, ",") ?></td>
                        <td class="item_tabela"><label for=""><input type="checkbox" name="pagou[]" value="<?= $u->id_jogadores ?>" <?= $u->divida == 0 ? "checked disabled" : "" ?>></label></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <input type="submit" value="Atualizar dívidas" class="btn">
    </form>

    <?php if (count($times) > 0) { ?>
        <form action="../controller/palpitarController.php" method="post" id="palpites_form" class="forms">
            <h1 class="titulo_forms">Palpites</h1>
            <table class="tabela" id="tabela_palpites">
                <thead class="cabecalho_tabela">
                    <th class="titulo_tabela">Nome</th>
                    <th class="titulo_tabela">Jogo 1</th>
                    <?php if (count($times) > 2) { ?>
                        <th class="titulo_tabela">Jogo 2</th>
                    <?php } ?>
                </thead>
                <tbody class="corpo_tabela">
                    <?php foreach ($listPalpites as $u) { ?>
                        <tr class="linha_tabela">
                            <td class="item_tabela"><?= $u->nome ?></td>
                            <td class="item_tabela">
                                <input type="number" id="placarC<?= $u->id_jogadores ?>" class="campo_palpite" name="placarC<?= $u->id_jogadores ?>" placeholder="<?= count($times) > 0 ? $times[0] : "" ?>" <?= isset($palpitesC[$u->id_jogadores][0]) ? "disabled value='{$palpitesC[$u->id_jogadores][0]}'" : "" ?>>
                                <span class="x">x</span>
                                <input type="number" id="placarF<?= $u->id_jogadores ?>" class="campo_palpite" name="placarF<?= $u->id_jogadores ?>" placeholder="<?= count($times) > 1 ? $times[1] : "" ?>" <?= isset($palpitesC[$u->id_jogadores][1]) ? "disabled value='{$palpitesC[$u->id_jogadores][1]}'" : "" ?>>
                            </td>
                            <?php if (count($times) > 2) { ?>

                                <td class="item_tabela">
                                    <input type="number" id="placarC<?= $u->id_jogadores ?>" class="campo_palpite" name="placar2C<?= $u->id_jogadores ?>" placeholder="<?= count($times) > 2 ? $times[2] : "" ?>" <?= isset($palpitesF[$u->id_jogadores][0]) ? "disabled value='{$palpitesF[$u->id_jogadores][0]}'" : "" ?>>
                                    <span class="x">x</span>
                                    <input type="number" id="placarF<?= $u->id_jogadores ?>" class="campo_palpite" name="placar2F<?= $u->id_jogadores ?>" placeholder="<?= count($times) > 3 ? $times[3] : "" ?>" <?= isset($palpitesF[$u->id_jogadores][1]) ? "disabled value='{$palpitesF[$u->id_jogadores][1]}'" : "" ?>>
                                </td>

                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <input type="submit" value="Palpitar" class="btn">
        </form>





        <form action="../controller/finishRodadas.php" method="post" id="resultados_form" class="forms">
            <h1 class="titulo_forms">Finaizar rodada</h1>
            <div id="container_finalizar_rodadas">

                <div class="finalizar_rodadas_campos">
                    <input type="number" class="campo_palpite big_font" name="respostaC" id="respostaC" placeholder="<?= count($times) > 0 ? $times[0] : "" ?>" <?= count($times) > 0 ? "" : "disabled" ?>>
                    <span class="x">x</span>
                    <input type="number" class="campo_palpite big_font" name="respostaF" id="respostaF" placeholder="<?= count($times) > 1 ? $times[1] : "" ?>" <?= count($times) > 1 ? "" : "disabled" ?>>
                </div>
                <?php if (count($times) > 2) { ?>
                    <div class="finalizar_rodadas_campos">
                        <input type="number" class="campo_palpite big_font" name="respostaC2" id="respostaC2" placeholder="<?= count($times) > 2 ? $times[2] : "" ?>" <?= count($times) > 2 ? "" : "disabled" ?>>
                        <span class="x">x</span>
                        <input type="number" class="campo_palpite big_font" name="respostaF2" id="respostaF2" placeholder="<?= count($times) > 3 ? $times[3] : "" ?>" <?= count($times) > 3 ? "" : "disabled" ?>>
                    </div>
                <?php } ?>
            </div>
            <input type="submit" value="Finalizar rodada" class="btn">
        </form>

    <?php } else { ?>


        <form action="../controller/iniciar_rodada_controller.php" method="post" id="iniciar_rodada_form">
            <div class="iniciar_rodada_linha">
                <div class="iniciar_rodada_item">
                    <!-- <label for="timeDaCasa">Time da casa:</label> -->
                    <input type="text" class="iniciar_rodada_campo" id="timeDaCasa" name="timeDaCasa" value="<?= count($times) > 0 ? "$times[0]" : "" ?>" <?= count($times) > 1 ? "disabled" : "" ?> required>
                </div>
                <span class="x">X</span>
                <div class="iniciar_rodada_item">
                    <!-- <label for="timeDeFora">Time de fora:</label> -->
                    <input type="text" class="iniciar_rodada_campo" id="timeDeFora" name="timeDeFora" value="<?= count($times) > 1 ? "$times[1]" : "" ?>" <?= count($times) > 1 ? "disabled" : "" ?> required>
                </div>
            </div>
            <div class="iniciar_rodada_linha">
                <div class="iniciar_rodada_item">
                    <!-- <label for="timeDaCasa2">Time da casa:</label> -->
                    <input type="text" class="iniciar_rodada_campo" id="timeDaCasa2" name="timeDaCasa2" value="<?= count($times) > 0 ? isset($times[2]) ? $times[2] : "" : "" ?>" <?= count($times) > 0 ? "disabled" : "" ?>>
                </div>
                <span class="x">X</span>
                <div class="iniciar_rodada_item">
                    <!-- <label for="timeDeFora2">Time de fora:</label> -->
                    <input type="text" class="iniciar_rodada_campo" id="timeDeFora2" name="timeDeFora2" value="<?= count($times) > 0 ? isset($times[3]) ? $times[3] : "" : "" ?>" <?= count($times) > 0 ? "disabled" : "" ?>>
                </div>
            </div>
            <input type="submit" value="Iniciar rodada" <?= count($times) > 0 ? "disabled" : "" ?> class="btn">
        </form>

    <?php } ?>

    <a href="../controller/session_destroy.php" id="logout">Log out</a>
    <script src="../../assets/js/script.js"></script>
</body>

</html>