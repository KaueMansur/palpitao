<?php

require "palpite.php";
require "database.php";

class Jogador{
    private $id;
    private $nome;
    private $senha;
    private $fotoDePerfil;
    private $colocacaoAtual;
    private $reposicionamentoNaTabela;
    private $palpites = [];
    private $pontos;
    private $pontuacaoRodadaAtual;
    private $adm;

    public function __construct($nome = 0, $senha = 0)
    {
        $this->nome = $nome;
        $this->senha = $senha;
    }

    public function fazerLogin(){
        $db = new Database();

        $listaDeJogadores = $db->select(
            "SELECT * FROM jogadores"
        );

        $key = false;

        foreach($listaDeJogadores as $jogador){
            if($jogador->nome == $this->nome){
                if($jogador->senha == $this->senha){

                    $key = true;

                    $this->id = $jogador->id_jogadores;
                    $this->fotoDePerfil = $jogador->foto_de_perfil;
                    $this->colocacaoAtual = $jogador->colocacao_atual;
                    $this->reposicionamentoNaTabela = $jogador->reposicionamento;
                    $this->pontos = $jogador->pontos;
                    $this->pontuacaoRodadaAtual = $jogador->pontos_da_rodada_atual;
                    $this->palpites = $jogador->palpites_id_palpites;
                    $this->adm = $jogador->adm;
                }
            }
        }
        return $key;
    }

    function getAllUsers(){
        $db = new Database();

        return $list = $db->select(
            "SELECT * FROM jogadores"
        );
    }

    // function palpitar($golsDaCasaJogo1, $golsForaJogo1, $golsDaCasaJogo2, $golsForaJogo2){
    //     $palpiteJogo1 = new Palpite($golsDaCasaJogo1, $golsForaJogo1);
    //     $palpiteJogo2 = new Palpite($golsDaCasaJogo2, $golsForaJogo2);

    //     $this->palpites = [$palpiteJogo1, $palpiteJogo2];

    //     $db = new Database();

    //     $db-> insert(
    //         "INSERT INTO palpites(placar, situacao_da_casa)"
    //     );
    // }

    function alterarSenha(){}

    function alterarFotoDePerfil(){}

    public function getObject(){
        return $this;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function getFotoDePerfil(){
        return $this->fotoDePerfil;
    }

    public function setFotoDePerfil($fotoDePerfil){
        $this->fotoDePerfil = $fotoDePerfil;
    }

    public function getColocacaoAtual(){
        return $this->colocacaoAtual;
    }

    public function setColocacaoAtual($colocacaoAtual){
        $this->colocacaoAtual = $colocacaoAtual;
    }

    public function getReposicionamentoNaTabela(){
        return $this->reposicionamentoNaTabela;
    }

    public function setReposicionamentoNaTabela($reposicionamentoNaTabela){
        $this->reposicionamentoNaTabela = $reposicionamentoNaTabela;
    }

    public function getPalpites(){
        return $this->palpites;
    }

    public function setPalpites($palpites){
        $this->palpites = $palpites;
    }

    public function getPontos(){
        return $this->pontos;
    }

    public function setPontos($pontos){
        $this->pontos = $pontos;
    }

    public function getPontuacaoRodadaAtual(){
        return $this->pontuacaoRodadaAtual;
    }

    public function setPontuacaoRodadaAtual($pontos){
        $this->pontuacaoRodadaAtual = $pontos;
    }

    public function getAdm(){
        return $this->adm;
    }

    public function setAdm($adm){
        $this->adm = $adm;
    }
}
?>