<?php

// require "database.php";
require "palpite.php";

class Jogador
{
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

    public function fazerLogin()
    {
        $db = new Database();

        $listaDeJogadores = $db->select(
            "SELECT * FROM jogadores"
        );

        $key = false;

        foreach ($listaDeJogadores as $jogador) {
            if ($jogador->nome == $this->nome) {
                if ($jogador->senha == $this->senha) {

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

    function getAllUsers()
    {
        $db = new Database();

        return $db->select(
            "SELECT * FROM jogadores ORDER BY pontos DESC, nome ASC"
        );
    }

    function getAllPlayers()
    {
        $db = new Database();

        return $db->select(
            "SELECT * FROM jogadores ORDER BY nome ASC"
        );
    }

    function definirPosicao()
    {
        $db = new Database();

        $jogador = $this->getAllUsers();

        foreach ($jogador as $u) {
            $db->update(
                "UPDATE jogadores SET colocacao_anterior = {$u->colocacao_atual} WHERE id_jogadores = {$u->id_jogadores}"
            );
        }

        $contagemPontosDistintos = $db->select(
            "SELECT COUNT(DISTINCT pontos) FROM jogadores"
        );

        $db->update(
            "UPDATE jogadores SET colocacao_atual = 1 WHERE pontos = (SELECT MAX(pontos) FROM jogadores)"
        );

        $pontos = $db->select(
            "SELECT DISTINCT(pontos) FROM jogadores ORDER BY pontos DESC"
        );

        for ($i = 1; $i < $contagemPontosDistintos[0]->{"COUNT(DISTINCT pontos)"}; $i++) {

            $db->update(
                "UPDATE jogadores SET colocacao_atual = ($i + 1) WHERE pontos = {$pontos[$i]->{'pontos'}}"
            );
        }
    }

    function definirAlteracaoNaPosicao()
    {
        $db = new Database();

        $jogador = $this->getAllUsers();

        foreach ($jogador as $u) {
            if ($u->colocacao_atual < $u->colocacao_anterior) {
                //Subiu de posição
                $db->update(
                    "UPDATE jogadores SET reposicionamento = 's' WHERE id_jogadores = {$u->id_jogadores}"
                );
            } else if ($u->colocacao_atual > $u->colocacao_anterior) {
                //Desceu de posição
                $db->update(
                    "UPDATE jogadores SET reposicionamento = 'd' WHERE id_jogadores = {$u->id_jogadores}"
                );
            } else {
                //Manteve na mesma posição
                $db->update(
                    "UPDATE jogadores SET reposicionamento = 'm' WHERE id_jogadores = {$u->id_jogadores}"
                );
            }
        }
    }

    function definirTitulosDePosicao()
    {
        $db = new Database();

        $db->update(
            "UPDATE jogadores SET titulo_de_posicao = null"
        );

        $db->update(
            "UPDATE jogadores SET titulo_de_posicao = 'Lanterna' 
            WHERE status = 1 AND pontos = (
            SELECT min_pontos 
            FROM (SELECT MIN(pontos) AS min_pontos FROM jogadores WHERE status = 1) AS temp);"
        );

        $db->update(
            "UPDATE jogadores SET titulo_de_posicao = 'Líder' 
            WHERE status = 1 AND pontos = (
            SELECT max_pontos 
            FROM (SELECT MAX(pontos) AS max_pontos FROM jogadores WHERE status = 1) AS temp);"
        );
    }

    public function getQuantidadeMesmaPosicao($posicao)
    {
        $db = new Database();

        return $db->select(
            "SELECT COUNT(colocacao_atual) FROM jogadores WHERE colocacao_atual = $posicao"
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

    public function getAllPlayersNotPosted()
    {
        $db = new Database();

        return $db->select(
            "SELECT jogadores.nome
FROM jogadores 
LEFT JOIN palpites ON jogadores.id_jogadores = palpites.id_jogadores 
  AND palpites.id_jogos = 13 
WHERE palpites.id_jogadores IS NULL 
  AND jogadores.status = 1 
ORDER BY jogadores.id_jogadores ASC;"
        );
    }

    public function banirjogador($idJogador)
    {
        $db = new Database();

        $db->update(
            "UPDATE jogadores SET status = 0 WHERE id_jogadores = $idJogador"
        );
    }

    public function getListaNegra()
    {
        $db = new Database();

        return $db->select(
            "SELECT * FROM jogadores WHERE status = 0 ORDER BY nome ASC"
        );
    }

    function alterarSenha() {}

    function alterarFotoDePerfil() {}

    public function getObject()
    {
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getFotoDePerfil()
    {
        return $this->fotoDePerfil;
    }

    public function setFotoDePerfil($fotoDePerfil)
    {
        $this->fotoDePerfil = $fotoDePerfil;
    }

    public function getColocacaoAtual()
    {
        return $this->colocacaoAtual;
    }

    public function setColocacaoAtual($colocacaoAtual)
    {
        $this->colocacaoAtual = $colocacaoAtual;
    }

    public function getReposicionamentoNaTabela()
    {
        return $this->reposicionamentoNaTabela;
    }

    public function setReposicionamentoNaTabela($reposicionamentoNaTabela)
    {
        $this->reposicionamentoNaTabela = $reposicionamentoNaTabela;
    }

    public function getPalpites()
    {
        return $this->palpites;
    }

    public function setPalpites($palpites)
    {
        $this->palpites = $palpites;
    }

    public function getPontos()
    {
        return $this->pontos;
    }

    public function setPontos($pontos)
    {
        $this->pontos = $pontos;
    }

    public function getPontuacaoRodadaAtual()
    {
        return $this->pontuacaoRodadaAtual;
    }

    public function setPontuacaoRodadaAtual($pontos)
    {
        $this->pontuacaoRodadaAtual = $pontos;
    }

    public function getAdm()
    {
        return $this->adm;
    }

    public function setAdm($adm)
    {
        $this->adm = $adm;
    }
}
