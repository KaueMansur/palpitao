<?php

require "jogador.php";

class Pagamento{

    private $idPagamento;
    private $valor;
    private $data;
    private $hora;
    private $idJogador;

    public function calculaValorTotal(){
        $db = new Database();

        return $db->select(
            "SELECT SUM(valor) FROM pagamentos"
        );
    }

    public function calculaValorPosicao($porcentagem){

        return $this->calculaValorTotal()[0]->{"SUM(valor)"} * $porcentagem / 100;
    }
}