<?php

session_start();

if(!isset($_SESSION["jogador"])){
    header("Refresh: 0; URL = ../../index.php");
}

?>