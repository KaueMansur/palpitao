// import { createElement } from "react";

const thPremio = document.getElementById("th_premio");
const tdPremio = document.querySelectorAll(".td_premio");

const thPontosRodada = document.getElementById("th_pontos_na_rodada");

const tabela = document.getElementById("cabeca_tabela");

function copiarTexto() {
    const texto = document.getElementById('textoParaCopiar').innerText; // Pega o texto do elemento
    navigator.clipboard.writeText(texto).then(() => {
        alert('Texto copiado para a área de transferência!'); // Confirmação para o usuário
    }).catch(err => {
        console.error('Erro ao copiar: ', err); // Tratamento de erro
    });
}

function mostrarPremios() {

    if (!thPremio) {
        console.log("item inexistente")
        const th = document.createElement("th");
        th.textContent = "Prêmio";
        th.setAttribute("id", "th_premio");
        th.setAttribute("class", "titulo_tabela");
        // tabela.appendChild(th);
        thPontosRodada.insertAdjacentElement("afterend", th);
    
        tdPremio.forEach(td => {
            td.style.display = "block"
        })
        console.log(thPremio)
    } else {
        console.log("Item existente")
    }
    // console.log(tabela)
    // console.log(thPremio)

    // if (typeof thPremio == null) {



    // console.log("Tag Existente")
    // tdPremio.forEach(td => {
    //     td.style.display = "none"
    // })
    // } else {
    // console.log("Tag inexistente")

    // th.id = "th_premio";
    // th.classList.add("titulo_tabela");
    // parentElement.insertBefore(th, thPontosRodada);
    // }
}