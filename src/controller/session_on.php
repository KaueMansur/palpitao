<?php

session_start();

if(isset($_SESSION["jogador"])){
    header("Refresh: 0; URL = src/view/main.php");
} else if(isset($_SESSION["adm"])){
    header("Refresh: 0; URL = src/view/adm.php");
}

?>