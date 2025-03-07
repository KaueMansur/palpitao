<?php
class Time{
    private $id;
    private $escudo;
    private $nome;

    function __construct($escudo, $nome)
    {
        $this->escudo = $escudo;
        $this->nome = $nome;
    }
}
?>