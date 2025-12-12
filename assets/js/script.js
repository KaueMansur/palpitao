// import { createElement } from "react";

const thPremio = document.getElementById("th_premio");
const tdPremio = document.querySelectorAll(".td_premio");

const thDivida = document.getElementById("th_divida");

const tabela = document.getElementById("cabeca_tabela");

const itemBanir = document.querySelectorAll(".item_banir");
const tituloBanir = document.getElementById("titulo_banir");

const listaNegra = document.getElementById("lista_negra_container");

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