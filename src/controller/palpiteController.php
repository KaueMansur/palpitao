<?php
require "../model/jogador.php";

$db = new Database();

$jogador = new Jogador();

$list = $jogador->getAllUsers();


$testeStatusJogo1 = $db->select("SELECT time_da_casa, time_de_fora FROM jogos_da_rodada WHERE status = 'em andamento' and numero_do_jogo = 1");
$testeStatusJogo2 = $db->select("SELECT time_da_casa, time_de_fora FROM jogos_da_rodada WHERE status = 'em andamento' and numero_do_jogo = 2");
$id_jogo1 = $db->select("SELECT id_rodadas FROM jogos_da_rodada WHERE status = 'em andamento' and numero_do_jogo = 1");
$id_jogo2 = $db->select("SELECT id_rodadas FROM jogos_da_rodada WHERE status = 'em andamento' and numero_do_jogo = 2");




$jogos_da_rodada = [];

// var_dump($id_jogo1[0]->id_rodadas);
// var_dump($id_jogo2->id_rodadas);

array_push($jogos_da_rodada, $id_jogo1[0]->id_rodadas, $id_jogo2[0]->id_rodadas);

$times = [];

if(count($testeStatusJogo1) > 0){
    foreach($testeStatusJogo1 as $t){
        $timeCasa1 = $t->time_da_casa;
        $timeFora1 = $t->time_de_fora;

        array_push($times, $timeCasa1, $timeFora1);
        // var_dump($timeCasa1, $timeFora1);
    }
}

// $palpite = new Palpite();


    
// $teste2 = [];

// foreach($placares as $p){

//     $teste = $palpite->converterPlacar($p->placar);

// }



if(count($testeStatusJogo2) > 0){
    foreach($testeStatusJogo2 as $t){
        $timeCasa2 = $t->time_da_casa;
        $timeFora2 = $t->time_de_fora;

        array_push($times ,$timeCasa2, $timeFora2);
        // var_dump($timeCasa2, $timeFora2);
    }
}

foreach($list as $u){
    if(isset($_POST["placarC{$u->id_jogadores}"])){
        if(isset($_POST["placarF{$u->id_jogadores}"])){

            $db = new Database();

            $palpite = new Palpite($_POST["placarC{$u->id_jogadores}"], $_POST["placarF{$u->id_jogadores}"]);
            
            $db->insert(
                "INSERT INTO palpites(placar, situacao_da_casa, id_jogador, time_da_casa, time_de_fora, id_jogo_da_rodada) VALUES ('{$palpite->getPlacar()}', '{$palpite->getResultadoDaCasa()}', '{$u->id_jogadores}', '{$times[0]}', '{$times[1]}', '$jogos_da_rodada[0]')"
            );
        }
    }

    if(isset($_POST["placarC{$u->id_jogadores}2"])){
        if(isset($_POST["placarF{$u->id_jogadores}2"])){

            $db = new Database();

            $palpite = new Palpite($_POST["placarC{$u->id_jogadores}2"], $_POST["placarF{$u->id_jogadores}2"]);
            
            $db->insert(
                "INSERT INTO palpites(placar, situacao_da_casa, id_jogador, time_da_casa, time_de_fora, id_jogo_da_rodada) VALUES ('{$palpite->getPlacar()}', '{$palpite->getResultadoDaCasa()}', '{$u->id_jogadores}', '{$times[2]}', '{$times[3]}', '$jogos_da_rodada[1]')"
            );
        }
    }
}

header("Refresh: 0; URL = ../view/adm.php");

?>