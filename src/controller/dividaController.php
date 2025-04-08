<?php 
require "../model/database.php";

$db = new Database();

var_dump($_POST["pagou"]);

if($_POST["pagou"] != null){
    foreach($_POST["pagou"] as $u){
        $db->update(
            "UPDATE jogadores SET divida = 0 WHERE id_jogadores = {$u}"
        );
    }
}

header("Refresh: 0; URL = ../view/adm.php");   

?>