<?php

require "../model/rodada.php";

$db = new Database();

$jogador = new Jogador();

$jogadorList = $jogador->getAllUsers();

$palpites = new Palpite();

$rodada = new Rodada();

$rodadasAtivas = $rodada->getRodadasAtivas();

$db->update(
    "UPDATE jogadores SET pontos_na_rodada = 0, cem_porcento = 0"
);

foreach ($jogadorList as $j) {
    foreach ($rodadasAtivas as $r) {

        $numeroDePalpites = $db->select("SELECT COUNT(*) FROM palpites WHERE id_jogadores = {$j->id_jogadores} AND id_jogos = {$r->id_jogo}");
        // var_dump($numeroDePalpites[0]);

        if ($numeroDePalpites[0]->{"COUNT(*)"} == "0") {
            //Não postou em determinado jogo
            if (($rodadasAtivas[0]->time_casa == "Grêmio" || $rodadasAtivas[0]->time_casa == "Inter") && ($rodadasAtivas[0]->time_fora == "Grêmio" || $rodadasAtivas[0]->time_fora == "Inter")) {
                //Grenal
                $db->insert(
                    "UPDATE jogadores SET divida = divida + 2 WHERE id_jogadores = $j->id_jogadores"
                );
            } else {
                //Não é Grenal
                $db->insert(
                    // "INSERT INTO palpites(resultado_casa, id_jogadores, time_casa, time_fora, id_jogos, quantidade_gols_casa, quantidade_gols_fora) VALUES ('{$palpites->getResultadoDaCasa()}', '{$j->id_jogadores}', '{$r->time_casa}', '{$r->time_fora}', {$r->id_jogo}, {$palpites->getNumeroDeGolsDaCasa()}, {$palpites->getNumeroDeGolsDeFora()})"
                    "UPDATE jogadores SET divida = divida + 1 WHERE id_jogadores = $j->id_jogadores"
                );
            }
        } else {
            //Postou em determinado jogo
        }
    }
}

if ($_POST["respostaC"] != "") {
    if ($_POST["respostaF"] != "") {
        $palpite = new Palpite($_POST["respostaC"], $_POST["respostaF"]);
        $palpiteList = $palpite->getPalpitesJogoX(1);

        if (($rodadasAtivas[0]->time_casa == "Grêmio" || $rodadasAtivas[0]->time_casa == "Inter") && ($rodadasAtivas[0]->time_fora == "Grêmio" || $rodadasAtivas[0]->time_fora == "Inter")) {
            //Grenal
            foreach ($palpiteList as $p) {
                if ($p->resultado_casa == $palpite->getResultadoDaCasa()) {
                    if ($p->quantidade_gols_casa == $palpite->getNumeroDeGolsDaCasa() && $p->quantidade_gols_fora == $palpite->getNumeroDeGolsDeFora()) {
                        //acerto na cabeça
                        // if($p->time_da_casa)
                        // $db->update(
                        //     "UPDATE jogadores SET pontos = pontos + 6 WHERE id_jogadores = {$p->id_jogador}"
                        // );

                        $db->update(
                            "UPDATE jogadores SET pontos_na_rodada = 6, cem_porcento = 1 WHERE id_jogadores = {$p->id_jogadores}"
                        );
                    } else {
                        //acertou quem ganha
                        // $db->update(
                        //     "UPDATE jogadores SET pontos = pontos + 2, divida = divida + 1 WHERE id_jogadores = {$p->id_jogador}"
                        // );

                        $db->update(
                            "UPDATE jogadores SET pontos_na_rodada = 2, divida = divida + 1 WHERE id_jogadores = {$p->id_jogadores}"
                        );
                    }
                } else {
                    //Errou quem ganha
                    $db->update(
                        "UPDATE jogadores SET divida = divida + 2 WHERE id_jogadores = {$p->id_jogadores}"
                    );
                }
            }
        } else {
            //Não é Grenal
            foreach ($palpiteList as $p) {
                if ($p->resultado_casa == $palpite->getResultadoDaCasa()) {
                    if ($p->quantidade_gols_casa == $palpite->getNumeroDeGolsDaCasa() && $p->quantidade_gols_fora == $palpite->getNumeroDeGolsDeFora()) {
                        //acerto na cabeça
                        // if($p->time_da_casa)
                        // $db->update(
                        //     "UPDATE jogadores SET pontos = pontos + 3 WHERE id_jogadores = {$p->id_jogador}"
                        // );

                        if ($rodada->contarNumeroDeRodadasAtivas()[0]->{"COUNT(*)"} == 1) {
                            $db->update(
                                "UPDATE jogadores SET pontos_na_rodada = 3, cem_porcento = 1 WHERE id_jogadores = {$p->id_jogadores}"
                            );
                        } else {
                            $db->update(
                                "UPDATE jogadores SET pontos_na_rodada = pontos_na_rodada + 3, cem_porcento = 0.5 WHERE id_jogadores = {$p->id_jogadores}"
                            );
                        }
                    } else {
                        //acertou quem ganha
                        // $db->update(
                        //     "UPDATE jogadores SET pontos = pontos + 1, divida = divida + 0.5 WHERE id_jogadores = {$p->id_jogador}"
                        // );

                        $db->update(
                            "UPDATE jogadores SET pontos_na_rodada = pontos_na_rodada + 1, divida = divida + 0.5 WHERE id_jogadores = {$p->id_jogadores}"
                        );
                    }
                } else {
                    //Errou quem ganha
                    $db->update(
                        "UPDATE jogadores SET divida = divida + 1 WHERE id_jogadores = {$p->id_jogadores}"
                    );
                }
            }
        }
    }
}
if (isset($_POST["respostaC2"])) {
    if ($_POST["respostaF2"] != "") {
        $palpite = new Palpite($_POST["respostaC2"], $_POST["respostaF2"]);
        $palpiteList = $palpite->getPalpitesJogoX(2);

        foreach ($palpiteList as $p) {
            if ($p->resultado_casa == $palpite->getResultadoDaCasa()) {
                if ($p->quantidade_gols_casa == $palpite->getNumeroDeGolsDaCasa() && $p->quantidade_gols_fora == $palpite->getNumeroDeGolsDeFora()) {
                    //acertou na cabeça
                    // $db->update(
                    //     "UPDATE jogadores SET pontos = pontos + 3 WHERE id_jogadores = {$p->id_jogador}"
                    // );
                    $db->update(
                        "UPDATE jogadores SET pontos_na_rodada = pontos_na_rodada + 3, cem_porcento = cem_porcento + 0.5 WHERE id_jogadores = {$p->id_jogadores}"
                    );
                } else {
                    //acertou quem ganha
                    // $db->update(
                    //     "UPDATE jogadores SET pontos = pontos + 1, divida = divida + 0.5 WHERE id_jogadores = {$p->id_jogador}"
                    // );

                    $db->update(
                        "UPDATE jogadores SET pontos_na_rodada = pontos_na_rodada + 1, divida = divida + 0.5 WHERE id_jogadores = {$p->id_jogadores}"
                    );
                }
            } else {
                //Errou quem ganha
                $db->update(
                    "UPDATE jogadores SET divida = divida + 1 WHERE id_jogadores = {$p->id_jogadores}"
                );
            }
        }
    }
}

foreach ($palpiteList as $p) {
    $db->update(
        "UPDATE jogadores SET pontos = pontos + pontos_na_rodada WHERE id_jogadores = {$p->id_jogadores}"
    );
}

$db->update(
    "UPDATE jogos_da_rodada SET status = 'Encerrada'"
);

$jogador->definirPosicao();

$jogador->definirAlteracaoNaPosicao();

$jogador->definirTitulosDePosicao();

header("Refresh: 0; URL = ../view/adm.php");
