<?php 

require "../model/database.php";

if($_POST["timeDaCasa"] != ""){
    if($_POST["timeDeFora"] != ""){
        
        $db = new Database();
        
        $db->insert(
            "INSERT INTO jogos_da_rodada(time_da_casa, time_de_fora, numero_do_jogo) VALUES ('{$_POST['timeDaCasa']}', '{$_POST['timeDeFora']}', 1)"
        );

        if($_POST["timeDaCasa2"] != ""){
            if($_POST["timeDeFora2"] != ""){
                $db->insert(
                    "INSERT INTO jogos_da_rodada(time_da_casa, time_de_fora, numero_do_jogo) VALUES ('{$_POST['timeDaCasa2']}', '{$_POST['timeDeFora2']}', 2)"
                );
            }
        }
    }
}

header("Refresh: 0; url= ../view/adm.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Aguarde...
</body>
</html>