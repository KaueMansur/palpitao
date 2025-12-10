<?php

// require "palpite.php";

// require "database.php";

require "jogador.php";

class Rodada
{
    private $id;
    private $timeQueJogaEmCasa;
    private $timeQueJogaFora;
    private $resultadoDoJogo;
    private $numeroDoJogo;
    private $timeQueJogaEmCasaDois;
    private $timeQueJogaForaDois;

    public function __construct($timeQueJogaEmCasa = null, $timeQueJogaFora = null, $timeQueJogaEmCasaDois = null, $timeQueJogaForaDois = null)
    {
        $this->timeQueJogaEmCasa = $timeQueJogaEmCasa;
        $this->timeQueJogaFora = $timeQueJogaFora;
        $this->timeQueJogaEmCasaDois = $timeQueJogaEmCasaDois;
        $this->timeQueJogaForaDois = $timeQueJogaForaDois;
        // $this->numeroDoJogo = $numeroDoJogo;
    }

    public function iniciarRodada()
    {
        $db = new Database();

        $ultimoIdRodada = $db->select(
            "SELECT MAX(id_rodada) FROM jogos_da_rodada"
        );

        $idRodada = $ultimoIdRodada[0]->{"MAX(id_rodada)"};

        // var_dump($idRodada);

        $db->insert(
            "INSERT INTO jogos_da_rodada(time_casa, time_fora, numero_do_jogo, id_rodada) VALUES ('{$this->timeQueJogaEmCasa}', '{$this->timeQueJogaFora}', 1, ($idRodada + 1))"
        );

        if (isset($this->timeQueJogaEmCasaDois)) {
            $db->insert(
                "INSERT INTO jogos_da_rodada(time_casa, time_fora, numero_do_jogo, id_rodada) VALUES ('{$this->timeQueJogaEmCasaDois}', '{$this->timeQueJogaForaDois}', 2, ($idRodada + 1))"
            );
        }
    }

    public function getRodadasAtivas()
    {
        $db = new Database();

        return $db->select("SELECT * FROM jogos_da_rodada WHERE status = 'Em andamento'");
    }

    public function contarNumeroDeRodadasAtivas()
    {
        $db = new Database();

        return $db->select(
            "SELECT COUNT(*) FROM jogos_da_rodada WHERE status = 'Em andamento'"
        );
    }

    public function getIdRodada()
    {
        $db = new Database();

        return $db->select(
            "SELECT max(id_rodada) FROM jogos_da_rodada"
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTimeQueJogaEmCasa()
    {
        return $this->timeQueJogaEmCasa;
    }

    public function setTimeQueJogaEmCasa($time)
    {
        $this->timeQueJogaEmCasa = $time;
    }

    public function getTimeQueJogaFora()
    {
        return $this->timeQueJogaFora;
    }

    public function setTimeQueJogaFora($time)
    {
        $this->timeQueJogaFora = $time;
    }

    public function getResultadoDoJogo()
    {
        return $this->resultadoDoJogo;
    }

    public function setResultadoDoJogo($resultado)
    {
        $this->resultadoDoJogo = $resultado;
    }
}
