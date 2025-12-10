<?php

require "database.php";

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
            //Vitória
            $this->resultadoDaCasa = "V";
        } else if($this->numeroDeGolsDaCasa < $this->numeroDeGolsDeFora){
            //Derrota
            $this->resultadoDaCasa = "D";
        } else{
            //Empate
            $this->resultadoDaCasa = "E";
        }

        $this->placar = "$this->numeroDeGolsDaCasa x $this->numeroDeGolsDeFora";
    }

    public function getAllPalpites(){
        $db = new Database();

        return $db->select("SELECT * FROM palpites");
    }

    public function getPalpitesJogoX($x){
        $db = new Database();

        $list = $this->getAllPalpites();

        $jogoDaRodada = [];

        $idJogoUm = $db->select("SELECT id_jogo FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 1");
        $idJogoDois = $db->select("SELECT id_jogo FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 2");

        var_dump($idJogoUm);

        if($x == 1){
            foreach($list as $p){
                if($p->id_jogos == $idJogoUm[0]->id_jogo){
                    array_push($jogoDaRodada, $p);
                }
            }
        } else{
            foreach($list as $p){
                if($p->id_jogos == $idJogoDois[0]->id_jogo){
                    array_push($jogoDaRodada, $p);
                }
            }
        }

        return $jogoDaRodada;
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
        return $this->numeroDeGolsDaCasa;
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