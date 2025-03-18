<?php

require "../model/palpite.php";

$db = new Database();

if($_POST["respostaC"] != ""){
    if($_POST["respostaF"] != ""){
        $palpite = new Palpite($_POST["respostaC"], $_POST["respostaF"]);
        $palpiteList = $palpite->getPalpitesJogoX(1);

        if($palpiteList[0]->time_da_casa == "Grêmio" || $palpiteList[0]->time_da_casa == "Inter" && $palpiteList[0]->time_de_fora == "Grêmio" || $palpiteList[0]->time_de_fora == "Inter"){
            //Grenal
            foreach($palpiteList as $p){
                if($p->situacao_da_casa == $palpite->getResultadoDaCasa()){
                    if($p->placar == $palpite->getPlacar()){
                        //acerto na cabeça
                        if($p->time_da_casa)
                        $db->update(
                            "UPDATE jogadores SET pontos = pontos + 6 WHERE id_jogadores = {$p->id_jogador}"
                        );
                    } else{
                        //acertou quem ganha
                        $db->update(
                            "UPDATE jogadores SET pontos = pontos + 2, divida = divida + 1 WHERE id_jogadores = {$p->id_jogador}"
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

            foreach($palpiteList as $p){
                if($p->situacao_da_casa == $palpite->getResultadoDaCasa()){
                    if($p->placar == $palpite->getPlacar()){
                        //acerto na cabeça
                        if($p->time_da_casa)
                        $db->update(
                            "UPDATE jogadores SET pontos = pontos + 3 WHERE id_jogadores = {$p->id_jogador}"
                        );
                    } else{
                        //acertou quem ganha
                        $db->update(
                            "UPDATE jogadores SET pontos = pontos + 1, divida = divida + 0.5 WHERE id_jogadores = {$p->id_jogador}"
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
                    $db->update(
                        "UPDATE jogadores SET pontos = pontos + 3 WHERE id_jogadores = {$p->id_jogador}"
                    );
                } else{
                    //acertou quem ganha
                    $db->update(
                        "UPDATE jogadores SET pontos = pontos + 1, divida = divida + 0.5 WHERE id_jogadores = {$p->id_jogador}"
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

$db->update(
    "UPDATE jogos_da_rodada SET status = 'Encerrada'"
);

header("Refresh: 0; URL = ../view/adm.php");

?>