const valorPago = document.getElementById("valor_pago");

function formatarMoeda(input) {
  let valor = input.value;

  // Remove qualquer caractere que não seja número
  valor = valor.replace(/\D/g, "");

  // Converte para decimal (centavos)
  valor = (valor / 100).toFixed(2);

  // Formata para o padrão brasileiro (R$)
  input.value = new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  }).format(valor);
}