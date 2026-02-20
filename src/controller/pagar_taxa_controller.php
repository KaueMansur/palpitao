<?php

require "../model/database.php";

$db = new Database();

if (isset($_POST["id_jogador"])) {
    $db->update(
        "UPDATE jogadores SET taxa = 1 WHERE id_jogadores = {$_POST['id_jogador']}"
    );
    $numeroRodada = $db->select("SELECT MAX(id_rodada) FROM jogos_da_rodada");

    // unlink("../../mysql/backup_db_".$numeroRodada[0]->{"MAX(id_rodada)"}.".sql");
    unlink("../../mysql/backup_db_7.sql");

    $command = 'C:\Users\User\Desktop\xamp\htdocs\sistemaPalpitao\xampp\mysql\bin\mysqldump.exe -h localhost -u root palpitao_db > ..\..\mysql\backup_db_' . $numeroRodada[0]->{"MAX(id_rodada)"}.'.sql';

    system($command, $output);
}

header("Refresh: 0; URL = ../view/adm.php");
