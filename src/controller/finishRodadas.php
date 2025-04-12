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

foreach($jogadorList as $j){
    foreach($rodadasAtivas as $r){

        $numeroDePalpites = $db->select("SELECT COUNT(*) FROM palpites WHERE id_jogador = {$j->id_jogadores} AND id_jogo_da_rodada = {$r->id_rodadas}");
        var_dump($numeroDePalpites[0]);

        if($numeroDePalpites[0]->{"COUNT(*)"} == "0"){
            //Não postou em determinado jogo
                $db->insert(
                    "INSERT INTO palpites(placar, situacao_da_casa, id_jogador, time_da_casa, time_de_fora, id_jogo_da_rodada) VALUES ('{$palpites->getPlacar()}', '{$palpites->getResultadoDaCasa()}', '{$j->id_jogadores}', '{$r->time_da_casa}', '{$r->time_de_fora}', {$r->id_rodadas})"
                );
        } else{
            //Postou em determinado jogo
        }
    }

}

if($_POST["respostaC"] != ""){
    if($_POST["respostaF"] != ""){
        $palpite = new Palpite($_POST["respostaC"], $_POST["respostaF"]);
        $palpiteList = $palpite->getPalpitesJogoX(1);

        if(($rodadasAtivas[0]->time_da_casa == "Grêmio" || $rodadasAtivas[0]->time_da_casa == "Inter") && ($rodadasAtivas[0]->time_de_fora == "Grêmio" || $rodadasAtivas[0]->time_de_fora == "Inter")){
            //Grenal
            foreach($palpiteList as $p){
                if($p->situacao_da_casa == $palpite->getResultadoDaCasa()){
                    if($p->placar == $palpite->getPlacar()){
                        //acerto na cabeça
                        // if($p->time_da_casa)
                        // $db->update(
                        //     "UPDATE jogadores SET pontos = pontos + 6 WHERE id_jogadores = {$p->id_jogador}"
                        // );

                        $db->update(
                            "UPDATE jogadores SET pontos_na_rodada = 6, cem_porcento = 1 WHERE id_jogadores = {$p->id_jogador}"
                        );

                    } else{
                        //acertou quem ganha
                        // $db->update(
                        //     "UPDATE jogadores SET pontos = pontos + 2, divida = divida + 1 WHERE id_jogadores = {$p->id_jogador}"
                        // );

                        $db->update(
                            "UPDATE jogadores SET pontos_na_rodada = 2, divida = divida + 1 WHERE id_jogadores = {$p->id_jogador}"
                        );
                    }
                } else{
                    //Errou quem ganha
                    $db->update(
                        "UPDATE jogadores SET divida = divida + 2 WHERE id_jogadores = {$p->id_jogador}"
                    );
                }
            }
        } else{
            //Não é Grenal
            foreach($palpiteList as $p){
                if($p->situacao_da_casa == $palpite->getResultadoDaCasa()){
                    if($p->placar == $palpite->getPlacar()){
                        //acerto na cabeça
                        // if($p->time_da_casa)
                        // $db->update(
                        //     "UPDATE jogadores SET pontos = pontos + 3 WHERE id_jogadores = {$p->id_jogador}"
                        // );

                        if($rodada->contarNumeroDeRodadasAtivas()[0]->{"COUNT(*)"} == "1"){
                            $db->update(
                                "UPDATE jogadores SET pontos_na_rodada = pontos_na_rodada + 3, cem_porcento = 1 WHERE id_jogadores = {$p->id_jogador}"
                            );
                        } else{
                            $db->update(
                                "UPDATE jogadores SET pontos_na_rodada = pontos_na_rodada + 3, cem_porcento = 0.5 WHERE id_jogadores = {$p->id_jogador}"
                            );
                        }

                    } else{
                        //acertou quem ganha
                        // $db->update(
                        //     "UPDATE jogadores SET pontos = pontos + 1, divida = divida + 0.5 WHERE id_jogadores = {$p->id_jogador}"
                        // );

                        $db->update(
                            "UPDATE jogadores SET pontos_na_rodada = pontos_na_rodada + 1, divida = divida + 0.5 WHERE id_jogadores = {$p->id_jogador}"
                        );
                    }
                } else{
                    //Errou quem ganha
                    $db->update(
                        "UPDATE jogadores SET divida = divida + 1 WHERE id_jogadores = {$p->id_jogador}"
                    );
                }
            }
        }

    }
}
if($_POST["respostaC2"] != ""){
    if($_POST["respostaF2"] != ""){
        $palpite = new Palpite($_POST["respostaC2"], $_POST["respostaF2"]);
        $palpiteList = $palpite->getPalpitesJogoX(2);

        foreach($palpiteList as $p){
            if($p->situacao_da_casa == $palpite->getResultadoDaCasa()){
                if($p->placar == $palpite->getPlacar()){
                    //acertou na cabeça
                    // $db->update(
                    //     "UPDATE jogadores SET pontos = pontos + 3 WHERE id_jogadores = {$p->id_jogador}"
                    // );
                    $db->update(
                        "UPDATE jogadores SET pontos_na_rodada = pontos_na_rodada + 3, cem_porcento = cem_porcento + 0.5 WHERE id_jogadores = {$p->id_jogador}"
                    );

                } else{
                    //acertou quem ganha
                    // $db->update(
                    //     "UPDATE jogadores SET pontos = pontos + 1, divida = divida + 0.5 WHERE id_jogadores = {$p->id_jogador}"
                    // );

                    $db->update(
                        "UPDATE jogadores SET pontos_na_rodada = pontos_na_rodada + 1, divida = divida + 0.5 WHERE id_jogadores = {$p->id_jogador}"
                    );
                }
            } else{
                //Errou quem ganha
                $db->update(
                    "UPDATE jogadores SET divida = divida + 1 WHERE id_jogadores = {$p->id_jogador}"
                );
            }
        }
    }
    
}

foreach($palpiteList as $p){
    $db->update(
        "UPDATE jogadores SET pontos = pontos + pontos_na_rodada WHERE id_jogadores = {$p->id_jogador};"
    );
}

$db->update(
    "UPDATE jogos_da_rodada SET status = 'Encerrada'"
);

$jogador->definirPosicao();

$jogador->definirAlteracaoNaPosicao();

$jogador->definirTitulosDePosicao();

header("Refresh: 0; URL = ../view/adm.php");        

?>