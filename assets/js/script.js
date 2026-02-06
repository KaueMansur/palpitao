// import { createElement } from "react";

const thPremio = document.getElementById("th_premio");
const tdPremio = document.querySelectorAll(".td_premio");

const thDivida = document.getElementById("th_divida");

const tabela = document.getElementById("cabeca_tabela");

const itemBanir = document.querySelectorAll(".item_banir");
const tituloBanir = document.getElementById("titulo_banir");

const listaNegra = document.getElementById("lista_negra_container");
const listaNaoPostaram = document.getElementById("lista_nao_postaram_container");

const regulamento = document.getElementById("regulamento_container");

const valorTotal = document.getElementById("valor_total");

function copiarTexto() {
    const texto = document.getElementById('textoParaCopiar').innerText; // Pega o texto do elemento
    navigator.clipboard.writeText(texto).then(() => {
        alert('Texto copiado para a área de transferência!'); // Confirmação para o usuário
    }).catch(err => {
        console.error('Erro ao copiar: ', err); // Tratamento de erro
    });
}

function mostrarPremios() {
    // console.log(tabela)
    // console.log(thPremio)
    if (thPremio.style.display == "none") {

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
}

function mostrarOpcaoBanir() {
    if (tituloBanir.style.display == "none") {
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
    }
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