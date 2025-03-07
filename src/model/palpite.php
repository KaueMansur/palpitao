<?php

class Palpite{
    private $id;
    private $numeroDeGolsDaCasa;
    private $numeroDeGolsDeFora;
    private $resultadoDaCasa;
    private $placar;

    public function __construct($golsDaCasa = 0, $golsFora = 0)
    {
        $this->numeroDeGolsDaCasa = $golsDaCasa;
        $this->numeroDeGolsDeFora = $golsFora;

        if($this->numeroDeGolsDaCasa > $this->numeroDeGolsDeFora){
            $this->resultadoDaCasa = "Vitória";
        } else if($this->numeroDeGolsDaCasa < $this->numeroDeGolsDeFora){
            $this->resultadoDaCasa = "Derrota";
        } else{
            $this->resultadoDaCasa = "Empate";
        }

        $this->placar = "$this->numeroDeGolsDaCasa x $this->numeroDeGolsDeFora";
    }

    public function getAllPalpites(){
        $db = new Database();

        return $palpites = $db->select("SELECT * FROM palpites");
    }

    public function converterPlacar($placar){
        
        $casa = substr($placar, 0, 1);
        $fora = substr($placar, 4, 1);

        return $placares = [$casa, $fora];
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNumeroDeGolsDaCasa(){
        return $this->id;
    }

    public function setNumeroDeGolsDaCasa($gols){
        $this->numeroDeGolsDaCasa = $gols;
    }

    public function getNumeroDeGolsDeFora(){
        return $this->numeroDeGolsDeFora;
    }

    public function setNumeroDeGolsDeFora($gols){
        $this->numeroDeGolsDaCasa = $gols;
    }

    public function getResultadoDaCasa(){
        return $this->resultadoDaCasa;
    }

    public function setResultadoDaCasa($resultado){
        $this->resultadoDaCasa = $resultado;
    }

    public function getPlacar(){
        return $this->placar;
    }

    public function setPlacar($placar){
        $this->placar = $placar;
    }
}
?>