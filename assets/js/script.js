// import { createElement } from "react";

const thPremio = document.getElementById("th_premio");
const tdPremio = document.querySelectorAll(".td_premio");

const thDivida = document.getElementById("th_divida");
const thPagou = document.getElementById("th_pagou");

const tabela = document.getElementById("cabeca_tabela");

const itemBanir = document.querySelectorAll(".item_banir");
const tituloBanir = document.getElementById("titulo_banir");

const listaNegra = document.getElementById("lista_negra_container");
const listaNaoPostaram = document.getElementById("lista_nao_postaram_container");

const regulamento = document.getElementById("regulamento_container");

const valorTotal = document.getElementById("valor_total");

const btnMusica = document.getElementById("btn_musica");
const hinoGremio = document.getElementById("hino_gremio");
const imgMusica = document.getElementById("img_musica");

const btnHistoricoPagamentos = document.getElementById("btn_historico_pagamentos");
const historicoPagamentosContainer = document.getElementById("historico_pagamentos_container");

const btnMostrarTaxa = document.getElementById("btn_mostrar_taxa");
const tituloTaxa = document.getElementById("titulo_taxa");
const itemTaxa = document.querySelectorAll(".item_taxa");

function copiarTexto() {
    const texto = document.getElementById('textoParaCopiar').innerText; // Pega o texto do elemento
    navigator.clipboard.writeText(texto).then(() => {
        alert('Texto copiado para a área de transferência!'); // Confirmação para o usuário
    }).catch(err => {
        console.error('Erro ao copiar: ', err); // Tratamento de erro
    });
}
let keyPremios = 0;
function mostrarPremios() {
    // console.log(tabela)
    // console.log(thPremio)
    if (keyPremios % 2 == 0) {

        thPremio.style.display = "block";

        tdPremio.forEach(td => {
            td.style.display = "block";
        });

        const newTh = document.createElement("th");
        const otherTh = document.createElement("th");
        const othertTh = document.createElement("th");

        newTh.setAttribute("id", "new_th")
        otherTh.setAttribute("id", "other_th")
        othertTh.setAttribute("id", "othert_th")

        newTh.classList.add("titulo_tabela");
        otherTh.classList.add("titulo_tabela");
        othertTh.classList.add("titulo_tabela");

        newTh.style.display = "none";
        otherTh.style.display = "none";
        othertTh.style.display = "none";

        thDivida.insertAdjacentElement("afterend", newTh)
        newTh.insertAdjacentElement("afterend", otherTh)
        otherTh.insertAdjacentElement("afterend", othertTh)
    } else {
        thPremio.style.display = "none";

        tdPremio.forEach(td => {
            td.style.display = "none";
        });

        document.getElementById("new_th").remove();
        document.getElementById("other_th").remove();
        document.getElementById("othert_th").remove();
    }
    keyPremios++;
}

let keyBanir = 0;
function mostrarOpcaoBanir() {
    if (keyBanir % 2 == 0) {
        //habilitar
        tituloBanir.style.display = "table-cell";
        itemBanir.forEach(item => {
            item.style.display = "flex";
        });
    } else {
        tituloBanir.style.display = "none";
        itemBanir.forEach(item => {
            item.style.display = "none";
        });

        // document.getElementById("othert_ths").remove();
    }

    keyBanir++;
}

let keyTaxa = 0;
function mostrarTaxa() {
    if (keyTaxa % 2 == 0) {
        tituloTaxa.style.display = "table-cell";
        itemTaxa.forEach(item => {
            item.style.display = "flex";
        });

        const newThs = document.createElement("th");
        const otherThs = document.createElement("th");
        const othertThs = document.createElement("th");

        newThs.setAttribute("id", "new_ths")
        otherThs.setAttribute("id", "other_ths")
        othertThs.setAttribute("id", "othert_ths")

        newThs.classList.add("titulo_tabela");
        otherThs.classList.add("titulo_tabela");
        othertThs.classList.add("titulo_tabela");

        newThs.style.display = "none";
        otherThs.style.display = "none";
        othertThs.style.display = "none";

        if(keyBanir % 2 == 0){
            thPagou.insertAdjacentElement("afterend", newThs);
        } else{
            tituloBanir.insertAdjacentElement("afterend", newThs);
        }
        newThs.insertAdjacentElement("afterend", otherThs);
        otherThs.insertAdjacentElement("afterend", othertThs);
    } else {
        tituloTaxa.style.display = "none";
        itemTaxa.forEach(item => {
            item.style.display = "none";
        });
        document.getElementById("new_ths").remove();
        document.getElementById("other_ths").remove();
    }
    keyTaxa++;
}

function fecharListaNegra() {
    listaNegra.style.display = "none";
}

function abrirListaNegra() {
    listaNegra.style.display = "flex";
}

function abrirRegulamento() {
    if (regulamento.style.display == "flex") {
        regulamento.style.display = "none";
    } else {
        regulamento.style.display = "flex";
    }
}

function abrirListaDosQueNaoPostaram() {
    listaNaoPostaram.style.display = "flex";
}

function fecharLista(idLista) {
    document.getElementById(idLista).style.display = "none"
}

let valorTotalTxt = valorTotal.textContent;
let keyBtnValorTotal = 0;
valorTotal.addEventListener("click", () => {
    if (keyBtnValorTotal % 2 == 0) {
        valorTotal.textContent = "";
        valorTotal.style.width = "30px";
    } else {
        valorTotal.style.width = "250px";
        valorTotal.textContent = valorTotalTxt;
    }
    keyBtnValorTotal++;
})

let keyMusica = 0;
btnMusica.addEventListener("click", () => {
    if (keyMusica % 2 == 0) {
        hinoGremio.play();
        imgMusica.setAttribute("src", "../../assets/img/icones/tocador-de-musica.png");
    } else {
        hinoGremio.pause();
        hinoGremio.currentTime = 0;
        imgMusica.setAttribute("src", "../../assets/img/icones/tocador-de-musica-desligado.png");
    }
    keyMusica++;
})

let keyHistoricoPagamento = 0;
btnHistoricoPagamentos.addEventListener("click", () => {
    if (keyHistoricoPagamento % 2 == 0) {
        historicoPagamentosContainer.style.display = "flex";
    } else {
        historicoPagamentosContainer.style.display = "none";
    }
    keyHistoricoPagamento++;
})