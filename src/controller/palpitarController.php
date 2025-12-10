<?php
require "../model/jogador.php";

$db = new Database();

$jogador = new Jogador();

$list = $jogador->getAllUsers();


$testeStatusJogo1 = $db->select("SELECT time_casa, time_fora FROM jogos_da_rodada WHERE status = 'em andamento' and numero_do_jogo = 1");
$testeStatusJogo2 = $db->select("SELECT time_casa, time_fora FROM jogos_da_rodada WHERE status = 'em andamento' and numero_do_jogo = 2");
$idJogoUm = $db->select("SELECT id_jogo FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 1");
$idJogoDois = $db->select("SELECT id_jogo FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 2");


$jogosDaRodada = [];

// var_dump($id_jogo1[0]->id_rodadas);
// var_dump($id_jogo2->id_rodadas);

// if(count($testeStatusJogo1) > 0){
//     array_push($jogosDaRodada, $idJogoUm[0]->id_jogo, $idJogoDois[0]->id_jogo);
// } else{
//     array_push($jogosDaRodada, $idJogoUm[0]->id_jogo, $idJogoDois[0]->id_jogo);
// }



// var_dump($jogosDaRodada);

$times = [];

if (count($testeStatusJogo1) > 0) {
    foreach ($testeStatusJogo1 as $t) {
        $timeCasa1 = $t->time_casa;
        $timeFora1 = $t->time_fora;

        array_push($times, $timeCasa1, $timeFora1);    
        // var_dump($timeCasa1, $timeFora1);
    }
}

// $palpite = new Palpite();



// $teste2 = [];

// foreach($placares as $p){

//     $teste = $palpite->converterPlacar($p->placar);

// }



if (count($testeStatusJogo2) > 0) {
    foreach ($testeStatusJogo2 as $t) {
        $timeCasa2 = $t->time_casa;
        $timeFora2 = $t->time_fora;

        array_push($times, $timeCasa2, $timeFora2);
        // var_dump($timeCasa2, $timeFora2);
    }
    array_push($jogosDaRodada, $idJogoUm[0]->id_jogo, $idJogoDois[0]->id_jogo);
}else{
    array_push($jogosDaRodada, $idJogoUm[0]->id_jogo);
}

foreach ($list as $u) {

    if (isset($_POST["placarC{$u->id_jogadores}"])) {
        if ($_POST["placarC{$u->id_jogadores}"] != "") {
            if ($_POST["placarF{$u->id_jogadores}"] != "") {

                // var_dump($_POST["placarC{$u->id_jogadores}"]);

                // $golsCasa = $_POST["placarC{$u->id_jogadores}"];
                // $golsFora = $_POST["placarF{$u->id_jogadores}"];

                // var_dump($golsCasa);
                // var_dump($golsFora);

                $golsCasa = $_POST["placarC{$u->id_jogadores}"];
                $golsFora = $_POST["placarF{$u->id_jogadores}"];


                $db = new Database();

                $palpite = new Palpite($golsCasa, $golsFora);

                $db->insert(
                    "INSERT INTO palpites(resultado_casa, id_jogadores, time_casa, time_fora, id_jogos, quantidade_gols_casa, quantidade_gols_fora) VALUES ('{$palpite->getResultadoDaCasa()}', '{$u->id_jogadores}', '{$times[0]}', '{$times[1]}', '$jogosDaRodada[0]', '$golsCasa', '$golsFora')"
                );
            }
        }
    }

    if (isset($_POST["placar2C{$u->id_jogadores}"])) {

        if ($_POST["placar2C{$u->id_jogadores}"] != "") {
            if ($_POST["placar2F{$u->id_jogadores}"] != "") {

                $golsCasaDois = $_POST["placar2C{$u->id_jogadores}"];
                $golsForaDois = $_POST["placar2F{$u->id_jogadores}"];

                $db = new Database();

                $palpite = new Palpite($golsCasaDois, $golsForaDois);

                $db->insert(
                    "INSERT INTO palpites(resultado_casa, id_jogadores, time_casa, time_fora, id_jogos, quantidade_gols_casa, quantidade_gols_fora) VALUES ('{$palpite->getResultadoDaCasa()}', '{$u->id_jogadores}', '{$times[2]}', '{$times[3]}', '$jogosDaRodada[1]', '$golsCasaDois', '$golsForaDois')"
                );
            }
        }
    }
}

header("Refresh: 0; URL = ../view/adm.php");
