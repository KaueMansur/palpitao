<?php

// require "palpite.php";

require "database.php";

// require "jogador.php";

class Rodada{
    private $id;
    private $timeQueJogaEmCasa;
    private $timeQueJogaFora;
    private $resultadoDoJogo;

    public function __construct($timeQueJogaEmCasa = 0, $timeQueJogaFora = 0)
    {
        $this->timeQueJogaEmCasa = $timeQueJogaEmCasa;
        $this->timeQueJogaFora = $timeQueJogaFora;

    }

    public function getRodadasAtivas(){
        $db = new Database();

        return $db->select("SELECT * FROM rodadas");
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTimeQueJogaEmCasa(){
        return $this->timeQueJogaEmCasa;
    }

    public function setTimeQueJogaEmCasa($time){
        $this->timeQueJogaEmCasa = $time;
    }

    public function getTimeQueJogaFora(){
        return $this->timeQueJogaFora;
    }

    public function setTimeQueJogaFora($time){
        $this->timeQueJogaFora = $time;
    }

    public function getResultadoDoJogo(){
        return $this->resultadoDoJogo;
    }

    public function setResultadoDoJogo($resultado){
        $this->resultadoDoJogo = $resultado;
    }
}
?>