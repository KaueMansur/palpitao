<?php

session_start();

if (!isset($_SESSION["adm"])) {
    header("Refresh: 0; URL = ../../index.php");
}

// require "../model/jogador.php";

require "../model/pagamento.php";

$pagamento = new Pagamento();

$jogador = new Jogador();

$db = new Database();

$list = $jogador->getAllUsers();
$listPalpites = $jogador->getAllPlayers();

$historicoPagamentos = $pagamento->getHistoricoPagamentos();

$numeroRodada = $db->select("SELECT MAX(id_rodada) FROM jogos_da_rodada");

$testeStatusJogo1 = $db->select("SELECT time_casa, time_fora FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 1");
$testeStatusJogo2 = $db->select("SELECT time_casa, time_fora FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 2");
$idJogoUm = $db->select("SELECT id_jogo FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 1");
$idJogoDois = $db->select("SELECT id_jogo FROM jogos_da_rodada WHERE status = 'Em andamento' and numero_do_jogo = 2");

$jogosDaRodada = [];

if ($idJogoUm != null) {
    array_push($jogosDaRodada, $idJogoUm[0]->id_jogo);
    if ($idJogoDois != null) {
        array_push($jogosDaRodada, $idJogoDois[0]->id_jogo);
    }
}


$times = [];

if (count($testeStatusJogo1) > 0) {
    foreach ($testeStatusJogo1 as $t) {
        $timeCasa1 = $t->time_casa;
        $timeFora1 = $t->time_fora;

        array_push($times, $timeCasa1, $timeFora1);
    }
}

if (count($testeStatusJogo2) > 0) {
    foreach ($testeStatusJogo2 as $t) {
        $timeCasa2 = $t->time_casa;
        $timeFora2 = $t->time_fora;

        array_push($times, $timeCasa2, $timeFora2);
        // var_dump($timeCasa2, $timeFora2);
    }
}

$palpite = new Palpite();

$pList = $palpite->getAllPalpites();

$listaNegra = $jogador->getListaNegra();

$palpitesC = [];
$palpitesF = [];

if (isset($testeStatusJogo1[0])) {

    foreach ($list as $u) {

        foreach ($pList as $p) {

            if ($p->id_jogadores == $u->id_jogadores && $p->id_jogos == $idJogoUm[0]->id_jogo) {

                // var_dump($p);
                // $palpite->getPalpiteFromIds($p->id_jogos)
                // $jogo1 = [$p->placar[0], $p->placar[4]];

                // array_push($palpites, $jogo1);

                $palpitesC[$p->id_jogadores] = [$p->quantidade_gols_casa, $p->quantidade_gols_fora];
            }
        }
        if (isset($testeStatusJogo2[0])) {

            foreach ($pList as $p) {

                if ($p->id_jogadores == $u->id_jogadores && $p->id_jogos == $idJogoDois[0]->id_jogo) {

                    // $jogo2 = [$p->placar[0], $p->placar[4]];
                    // array_push($palpites, $p->id_jogador = [$jogo2]);

                    $palpitesF[$p->id_jogadores] = [$p->quantidade_gols_casa, $p->quantidade_gols_fora];
                    // var_dump($p->placar[0]);
                    // var_dump($p->placar[4]);
                }
            }
        }
    }
}

$jogadoresQueNaoPostaram = $jogador->getAllPlayersNotPosted();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de controle</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body class="page">
    <!-- <a href="../../mysql/backup_datbase.php" style="font-size: 30pt;">Faser Backup Database</a> -->
    <button class="btn_inter_gremio" onclick="abrirRegulamento()">Regulamento</button>
    <button class="btn_musica" id="btn_musica"><img src="../../assets/img/icones/tocador-de-musica-desligado.png" id="img_musica" alt="Ligar música"></button>
    <audio src="../../assets/sounds/music/hino-gremio.mp3" id="hino_gremio" loop="true"></audio>
    <a href="../controller/session_destroy.php" id="logout">Log out</a>

    <article id="lista_nao_postaram_container">
        <button type="button" onclick="fecharLista('lista_nao_postaram_container')" class="btn_fechar">x</button>
        <h2><span style="color: blue;">Lista Nã</span><span style="color: red;">o Postaram</span></h2>
        <ul class="lista_nao_postaram">
            <?php foreach ($jogadoresQueNaoPostaram as $j) {
            ?>
                <li><?= $j->nome ?></li>
            <?php } ?>
        </ul>
    </article>

    <article id="regulamento_container">
        <h2>REGULAMENTO PALPITÃO DA DUPLA GRENAL 2026</h2>
        <ul class="ul_pontuacao">
            <li>Acerto de placar exato: 03 pontos (não paga nada);</li>
            <li>Acerto do vencedor/empate (placar incorreto): 01 ponto e paga R$ 0,50;</li>
            <li>Erro total do resultado: 00 ponto e paga R$ 1,00.</li>
        </ul>
        <h3 class="txt_destacado">GRENAL VALE O DOBRO (Pontos e valores de multa).</h3>
        <h3>Regras de Participação:</h3>
        <ul class="lista_regras">
            <li>
                <h4>Prazo</h4>
                <p>O participante deve postar seu(s) palpite(s) até 10 (dez) minutos antes do início do primeiro jogo da rodada da dupla Grenal. Caso o prazo não seja cumprido, o palpite será anulado: o participante não somará pontos e pagará R$ 1,00 por jogo (ou R$ 2,00 em caso de Grenal).</p>
            </li>
            <li>
                <h4>Alterações</h4>
                <p>É estritamente proibido alterar os placares após a postagem no grupo.</p>
            </li>
            <li>
                <h4>Clareza</h4>
                <p>Palpites incompletos ou confusos serão anulados. Serão considerados apenas os palpites que estiverem em total conformidade com este regulamento.</p>
            </li>
            <li>
                <h4>Copa do Mundo</h4>
                <p>EM 2026, OS JOGOS DA SELEÇÃO BRASILEIRA TAMBÉM FARÃO PARTE DESTE PALPITÃO</p>
            </li>
        </ul>
        <h3>PREMIAÇÕES</h3>
        <ul class="lista_premiacoes">
            <li>1⁰ Lugar: 25%</li>
            <li>2⁰ Lugar: 20%</li>
            <li>3⁰ Lugar: 15%</li>
            <li>4⁰ Lugar: 10%</li>
            <li>5⁰ Lugar: 05%</li>
            <li>Taxa Adm: 25%</li>
        </ul>
        <h3 style="text-align: center;">OBS.: CASO HAJA EMPATE EM QUALQUER UMA DAS FAIXAS DE DE PREMIAÇÃO (DO 1º AO 5º LUGAR), O VALOR CORRESPONDENTE SERÁ DIVIDIDO EM PARTES IGUAIS ENTRE OS EMPATADOS.</h3>
        <h3 class="txt_destacado">AVISOS IMPORTANTES</h3>
        <ul class="lista_regras">
            <li>
                <h4>Atualização da Tabela</h4>
                <p>A FINALIZAÇÃO DA RODADA E A ATUALIZAÇÃO DA TABELA DE CLASSIFICAÇÃO OCORRERÃO SEMPRE ANTES DO INÍCIO DA RODADA SEGUINTE.</p>
            </li>
            <li>
                <h4>TAXA DE ADESÃO</h4>
                <p>O valor da adesão é de R$ 30,00. Este valor será devolvido integralmente aos participantes que permanecerem no grupo até a última rodada.</p>
            </li>
            <li>
                <h4>Exclusão e Multas</h4>
                <p>O participante será automaticamente excluído e perderá o valor da adesão caso:</p>
                <br>
                <ul>
                    <li class="regras_exclusao">Desista ou peça para sair do grupo.</li>
                    <li class="regras_exclusao">Atrase o pagamento por dois meses (consecutivos ou não).</li>
                </ul>
            </li>
        </ul>
        <p>Nesses casos, o valor da adesão será revertido para o grupo para cobrir débitos pendentes.</p>
        <p class="assinatura">ATT, LUIZINHO</p>
    </article>

    <h1> <span style="color: blue;">Painel d</span><span style="color: red;">e controle</span></h1>

    <form action="../controller/dividaController.php" method="post" id="tabela_form" class="forms">
        <h1 class="titulo_forms">Tabela</h1>
        <table id="tabela" class="tabela">
            <?php if (isset($numeroRodada[0]->{"MAX(id_rodada)"})) { ?>

                <h2 class="subtitulo_rodada">Rodada <?= $numeroRodada[0]->{"MAX(id_rodada)"} ?></h2>
                <button type="button" class="btn_premios btn_actions" onclick="mostrarPremios()" title="Mostrar premiações">🏆</button>
                <button type="button" class="btn_banir btn_actions" id="btn_habilitar_banimentos" onclick="mostrarOpcaoBanir()" title="Remover Jogador"><img src="../../assets/img/icones/block.png" height="40px" alt=""></button>
                <a href="../../mysql/backup_db_<?= $numeroRodada[0]->{"MAX(id_rodada)"} ?>.sql" class="btn_actions btn btn_backup" title="Baixar banco de dados"><img src="../../assets/img/icones/download.png" height="40px" alt=""></a>

                <button type="button" onclick="abrirListaDosQueNaoPostaram()" class="btn_actions btn_nao_postaram"><img src="../../assets/img/icones/lista-nao-postaram.png" width="45px" title="Jogadores que não postaram"></button>
                <button type="button" onclick="copiarTexto()" class="btn_actions btn_copiar"><img src="../../assets/img/icones/copiar.png" width="45px" title="Copiar tabela para texto"></button>
                <button type="button" onclick="abrirListaNegra()" class="btn_actions btn_lista_negra"><img src="../../assets/img/icones/lista-negra.png" width="45px" title="Mostrar jogadores removidos"></button>

                <article class="lista_negra_container" id="lista_negra_container">
                    <button type="button" onclick="fecharListaNegra()" class="btn_fechar">x</button>
                    <h2><span style="color: blue;">Lista</span> <span style="color: red;">Negra</span></h2>
                    <ul class="lista_negra">
                        <?php foreach ($listaNegra as $u) { ?>
                            <li class="item_lista_negra">🚫<?= $u->nome ?></li>
                        <?php } ?>
                    </ul>
                </article>

            <?php } ?>
            <!-- Reposicionamento -->
            <thead>
                <tr id="cabeca_tabela">
                    <th class="titulo_tabela"></th>
                    <th class="titulo_tabela">Posição</th>
                    <th class="titulo_tabela">Nome</th>
                    <th class="titulo_tabela">Pontos</th>
                    <th class="titulo_tabela" id="th_pontos_na_rodada">Pontos na Rodada</th>
                    <th class="titulo_tabela" id="th_divida">Dívida</th>
                    <th style="display: none;" class="titulo_tabela"></th>
                    <!-- <th style="display: none;" class="titulo_tabela"></th> -->
                    <th class="titulo_tabela" id="th_premio">Prêmio</th>
                    <th class="titulo_tabela">Pagou?</th>
                    <th class="titulo_tabela" id="titulo_banir"></th>
                </tr>
            </thead>
            <tbody id="corpo_tabela">
                <?php foreach ($list as $u) {
                    if ($u->status == 1) { ?>
                        <tr class="linha_tabela">
                            <td class="item_tabela">
                                <div class="<?= $u->reposicionamento ?>"></div>
                            </td>
                            <td class="item_tabela"><?= $u->colocacao_atual ?></td>
                            <td class="item_tabela"><?= $u->nome ?><?= $u->titulo_de_posicao == "Líder" ? "👑" : "", $u->titulo_de_posicao == "Lanterna" ? "🔦" : "" ?><?= $u->cem_porcento == "1" ? "💯" : "" ?></td>
                            <td class="item_tabela"><?= $u->pontos ?></td>
                            <td class="item_tabela"><?= $u->pontos_na_rodada ?></td>
                            <td class="item_tabela">R$ <?= number_format($u->divida, 2, ",") ?></td>
                            <td class="item_tabela td_premio"><?php
                                                                $porcentagemColocacao = 0;

                                                                if ($u->colocacao_atual == 1) {
                                                                    $porcentagemColocacao = 30;
                                                                } else if ($u->colocacao_atual == 2) {
                                                                    $porcentagemColocacao = 20;
                                                                } else if ($u->colocacao_atual == 3) {
                                                                    $porcentagemColocacao = 15;
                                                                } else if ($u->colocacao_atual == 4) {
                                                                    $porcentagemColocacao = 10;
                                                                } else if ($u->colocacao_atual == 5) {
                                                                    $porcentagemColocacao = 5;
                                                                }

                                                                if ($u->adm == 0) {
                                                                    echo "R$ " . number_format(($pagamento->calculaValorPosicao($porcentagemColocacao) / $jogador->getQuantidadeMesmaPosicao($u->colocacao_atual)[0]->{"COUNT(colocacao_atual)"}), 2, ",");
                                                                } else {
                                                                    echo "R$ " . number_format((($pagamento->calculaValorPosicao($porcentagemColocacao) / $jogador->getQuantidadeMesmaPosicao($u->colocacao_atual)[0]->{"COUNT(colocacao_atual)"}) + $pagamento->calculaValorPosicao(20)), 2, ",");
                                                                }                        ?></td>
                            <!-- <td class="item_tabela"><label for=""><input type="checkbox" name="pagou[]" value=" < //$u->id_jogadores >" < //$u->divida == 0 ? "checked disabled" : "" >></label></td> -->
                            <td class="item_tabela">
                                <input type="text" name="pagou[]" class="campo_valor_pago" value="R$ 0,00" <?= $u->divida == 0 ? "disabled" : "" ?> oninput="formatarMoeda(this)">
                                <input type="hidden" name="id[]" value="<?= $u->id_jogadores ?>">
                            </td>
                            <td class="item_tabela item_banir">
                                <form action="../controller/banir_controller.php" method="post">
                                    <input type="hidden" name="id_jogador" value="<?= $u->id_jogadores ?>">
                                    <input type="submit" class="btn_banir" value="🚫">
                                </form>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
        <input type="submit" value="Atualizar dívidas" class="btn">
        <!-- style="display: none;" -->
        <p id="textoParaCopiar">*CLASSIFICAÇÃO DA <?= $numeroRodada[0]->{"MAX(id_rodada)"} ?>⁰ RODADA*</br></br>
            <?php foreach ($list as $u) {
                if ($u->status == 1) {


                    if ($u->reposicionamento == "s") {
                        echo "⬆️ ";
                    } else if ($u->reposicionamento == "d") {
                        echo "⬇️ ";
                    } else {
                        echo "⏹️ ";
                    }

                    $nome = mb_strtoupper($u->nome);

                    echo $u->colocacao_atual . "⁰ " . $u->pontos . " P. $nome";

                    if ($u->cem_porcento == 1) {
                        echo "💯";
                    }

                    if ($u->titulo_de_posicao == "Lanterna") {
                        echo "🔦";
                    } elseif ($u->titulo_de_posicao == "Líder") {
                        echo "👑";
                    }
                    echo "<br>";
                }
            }

            ?>
            </br>
            <?php
            foreach ($list as $u) {

                if ($u->status == 0) {
                    $nome = mb_strtoupper($u->nome);

                    echo "🚫 $nome";
                    echo "<br>";
                }
            }
            ?>

            </br>
            *LEGENDA:*
            </br></br>
            ⬆️ Subiu de posição na tabela</br>
            ⏹️ Manteve a sua posição na tabela</br>
            ⬇️ Desceu de posição na tabela</br>
            🚫 Não faz mais parte do PALPITÃO</br>
            💯 Acertou em cheio todos os jogos da rodada</br>
            👑 Segue o líder!</br>
            🔦 Não precisa nem dizer né❓❓❓ 🤔 🤣🤣🤣
        </p>
    </form>

    <?php if (count($times) > 0) { ?>
        <form action="../controller/palpitarController.php" method="post" id="palpites_form" class="forms">
            <h1 class="titulo_forms">Palpites</h1>
            <table class="tabela" id="tabela_palpites">
                <thead class="cabecalho_tabela">
                    <th class="titulo_tabela">Nome</th>
                    <th class="titulo_tabela">Jogo 1</th>
                    <?php if (count($times) > 2) { ?>
                        <th class="titulo_tabela">Jogo 2</th>
                    <?php } ?>
                </thead>
                <tbody class="corpo_tabela">
                    <?php foreach ($listPalpites as $u) {
                        if ($u->status == 1) { ?>
                            <tr class="linha_tabela">
                                <td class="item_tabela"><?= $u->nome ?></td>
                                <td class="item_tabela">
                                    <input type="number" id="placarC<?= $u->id_jogadores ?>" class="campo_palpite" name="placarC<?= $u->id_jogadores ?>" placeholder="<?= count($times) > 0 ? $times[0] : "" ?>" <?= isset($palpitesC[$u->id_jogadores][0]) ? "disabled value='{$palpitesC[$u->id_jogadores][0]}'" : "" ?>>
                                    <span class="x">x</span>
                                    <input type="number" id="placarF<?= $u->id_jogadores ?>" class="campo_palpite" name="placarF<?= $u->id_jogadores ?>" placeholder="<?= count($times) > 1 ? $times[1] : "" ?>" <?= isset($palpitesC[$u->id_jogadores][1]) ? "disabled value='{$palpitesC[$u->id_jogadores][1]}'" : "" ?>>
                                </td>
                                <?php if (count($times) > 2) { ?>

                                    <td class="item_tabela">
                                        <input type="number" id="placarC<?= $u->id_jogadores ?>" class="campo_palpite" name="placar2C<?= $u->id_jogadores ?>" placeholder="<?= count($times) > 2 ? $times[2] : "" ?>" <?= isset($palpitesF[$u->id_jogadores][0]) ? "disabled value='{$palpitesF[$u->id_jogadores][0]}'" : "" ?>>
                                        <span class="x">x</span>
                                        <input type="number" id="placarF<?= $u->id_jogadores ?>" class="campo_palpite" name="placar2F<?= $u->id_jogadores ?>" placeholder="<?= count($times) > 3 ? $times[3] : "" ?>" <?= isset($palpitesF[$u->id_jogadores][1]) ? "disabled value='{$palpitesF[$u->id_jogadores][1]}'" : "" ?>>
                                    </td>

                                <?php } ?>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
            <input type="submit" value="Palpitar" class="btn">
        </form>





        <form action="../controller/finishRodadas.php" method="post" id="resultados_form" class="forms" onsubmit="this.querySelector('input[type=submit]').disabled = true;">
            <h1 class=" titulo_forms">Resultados <br>dos jogos</h1>
            <div id="container_finalizar_rodadas">

                <div class="finalizar_rodadas_campos">
                    <input type="number" class="campo_palpite big_font" name="respostaC" id="respostaC" placeholder="<?= count($times) > 0 ? $times[0] : "" ?>" <?= count($times) > 0 ? "" : "disabled" ?>>
                    <span class="x">x</span>
                    <input type="number" class="campo_palpite big_font" name="respostaF" id="respostaF" placeholder="<?= count($times) > 1 ? $times[1] : "" ?>" <?= count($times) > 1 ? "" : "disabled" ?>>
                </div>
                <?php if (count($times) > 2) { ?>
                    <div class="finalizar_rodadas_campos">
                        <input type="number" class="campo_palpite big_font" name="respostaC2" id="respostaC2" placeholder="<?= count($times) > 2 ? $times[2] : "" ?>" <?= count($times) > 2 ? "" : "disabled" ?>>
                        <span class="x">x</span>
                        <input type="number" class="campo_palpite big_font" name="respostaF2" id="respostaF2" placeholder="<?= count($times) > 3 ? $times[3] : "" ?>" <?= count($times) > 3 ? "" : "disabled" ?>>
                    </div>
                <?php } ?>
            </div>
            <input type="submit" value="Finalizar rodada" class="btn">
        </form>

    <?php } else { ?>

        <form action="../controller/iniciar_rodada_controller.php" method="post" id="iniciar_rodada_form">
            <div class="iniciar_rodada_linha">
                <div class="iniciar_rodada_item">
                    <!-- <label for="timeDaCasa">Time da casa:</label> -->
                    <input type="text" class="iniciar_rodada_campo" id="timeDaCasa" name="timeDaCasa" value="<?= count($times) > 0 ? "$times[0]" : "" ?>" <?= count($times) > 1 ? "disabled" : "" ?> required>
                </div>
                <span class="x">X</span>
                <div class="iniciar_rodada_item">
                    <!-- <label for="timeDeFora">Time de fora:</label> -->
                    <input type="text" class="iniciar_rodada_campo" id="timeDeFora" name="timeDeFora" value="<?= count($times) > 1 ? "$times[1]" : "" ?>" <?= count($times) > 1 ? "disabled" : "" ?> required>
                </div>
            </div>
            <div class="iniciar_rodada_linha">
                <div class="iniciar_rodada_item">
                    <!-- <label for="timeDaCasa2">Time da casa:</label> -->
                    <input type="text" class="iniciar_rodada_campo" id="timeDaCasa2" name="timeDaCasa2" value="<?= count($times) > 0 ? isset($times[2]) ? $times[2] : "" : "" ?>" <?= count($times) > 0 ? "disabled" : "" ?>>
                </div>
                <span class="x">X</span>
                <div class="iniciar_rodada_item">
                    <!-- <label for="timeDeFora2">Time de fora:</label> -->
                    <input type="text" class="iniciar_rodada_campo" id="timeDeFora2" name="timeDeFora2" value="<?= count($times) > 0 ? isset($times[3]) ? $times[3] : "" : "" ?>" <?= count($times) > 0 ? "disabled" : "" ?>>
                </div>
            </div>
            <input type="submit" value="Iniciar rodada" <?= count($times) > 0 ? "disabled" : "" ?> class="btn">
        </form>

    <?php } ?>
    <article id="historico_pagamentos_container">
        <h2><span style="color: blue;">Histórico d</span><span style="color: red;">e pagamentos</span></h2>
        <ul class="lista_pagamentos">
            <?php 
            foreach ($historicoPagamentos as $pagamentos) {
            ?>
                <li class="item_pagamento">
                    <div class="item_pagamento_container">
                        <p class="info_pagamento"><?= $pagamentos->nome ?></p>
                        <p class="info_pagamento">R$ <?= str_replace(".", ",", number_format($pagamentos->valor, 2)) ?></p>
                    </div>
                    <div class="item_pagamento_container">
                        <p class="info_pagamento"><?= $pagamentos->hora ?></p>
                        <p class="info_pagamento"><?= date("d/m/Y", strtotime($pagamentos->data_pagamento)); ?></p>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </article>
    <button class="btn_historico_pagamentos" id="btn_historico_pagamentos"><img src="../../assets/img/icones/bolsa-de-dinheiro.png" alt="Ver histórico de pagamentos"></button>
    <div class="valor_total" id="valor_total">R$ <?= number_format($pagamento->calculaValorTotal()[0]->{"SUM(valor)"}, 2, ",") ?></div>

    <script src="../../assets/js/script.js"></script>
    <script src="../../assets/js/mascaras.js"></script>
</body>

</html>