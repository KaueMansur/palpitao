<?php

require "../model/jogador.php";

if(isset($_POST["id_jogador"])){

    $jogador = new Jogador();
    
    $jogador->banirJogador($_POST["id_jogador"]);
}

header("Refresh:0; URL= ../view/adm.php");