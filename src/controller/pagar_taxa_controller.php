<?php

require "../model/database.php";

$db = new Database();

if(isset($_POST["id_jogador"])){
    $db->update(
        "UPDATE jogadores SET taxa = 1 WHERE id_jogadores = {$_POST['id_jogador']}"
    );
}

header("Refresh: 0; URL = ../view/adm.php");