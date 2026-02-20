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

    public function getHistoricoPagamentos(){
        $db = new Database();

        return $db->select(
            // "SELECT * FROM pagamentos ORDER BY data_pagamento DESC, hora DESC"
            "SELECT 
    pagamentos.*, 
    jogadores.nome 
FROM pagamentos
INNER JOIN jogadores ON pagamentos.id_jogador = jogadores.id_jogadores
ORDER BY pagamentos.data_pagamento DESC, pagamentos.hora DESC"
        );
    }
}