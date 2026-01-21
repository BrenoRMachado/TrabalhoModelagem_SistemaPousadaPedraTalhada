document.addEventListener('DOMContentLoaded', () => {

    const addItemBtn = document.getElementById('add-item-btn');
    const descricaoInput = document.getElementById('descricao');
    const quantidadeInput = document.getElementById('quantidade');
    const valorUnitarioInput = document.getElementById('valorUnitario');

    const idConta = document.getElementById('idConta').value;
    const diarias = parseInt(document.getElementById('diarias').value);
    const valorHospedagem = parseFloat(document.getElementById('valorHospedagem').value);

    const tbody = document.getElementById('consumos-body');
    const resumo = document.getElementById('resumo-pagamento');

    function atualizarResumo(totalConsumos) {
        const taxaServico = valorHospedagem * diarias * 0.1;
        const total = valorHospedagem * diarias + taxaServico + totalConsumos;

        resumo.innerHTML = `
            <div class="checkout-summary-line">
                <span>Hospedagem (${diarias} dias):</span>
                <span>R$ ${ (valorHospedagem * diarias).toFixed(2).replace('.', ',') }</span>
            </div>
            <div class="checkout-summary-line">
                <span>Consumos:</span>
                <span>R$ ${ totalConsumos.toFixed(2).replace('.', ',') }</span>
            </div>
            <div class="checkout-summary-line">
                <span>Taxa de Serviço:</span>
                <span>R$ ${ taxaServico.toFixed(2).replace('.', ',') }</span>
            </div>
            <div class="checkout-summary-line">
                <span>Descontos:</span>
                <span>R$ 0,00</span>
            </div>
            <hr class="checkout-divider">
            <div class="checkout-summary-total">
                <span class="checkout-text">TOTAL A PAGAR:</span>
                <span class="checkout-total-value">R$ ${ total.toFixed(2).replace('.', ',') }</span>
            </div>
        `;
    }

    addItemBtn.addEventListener('click', () => {
        const descricao = descricaoInput.value.trim();
        const quantidade = parseInt(quantidadeInput.value);
        const valorUnitario = parseFloat(valorUnitarioInput.value.replace(',', '.'));

        if (!descricao || !quantidade || !valorUnitario) {
            alert('Preencha todos os campos');
            return;
        }

        fetch('/admin/checkout/adicionarConsumo', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `descricao=${encodeURIComponent(descricao)}&quantidade=${quantidade}&valorUnitario=${valorUnitario}&idConta=${idConta}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                tbody.innerHTML = '';
                let totalConsumos = 0;

                data.consumos.forEach(item => {
                    const totalItem = item.quantidade * item.valorUnitario;
                    totalConsumos += totalItem;

                    tbody.innerHTML += `
                        <tr>
                            <td>${item.descricao}</td>
                            <td>${item.quantidade}</td>
                            <td>R$ ${item.valorUnitario.toFixed(2).replace('.',',')}</td>
                            <td><strong>R$ ${totalItem.toFixed(2).replace('.',',')}</strong></td>
                        </tr>
                    `;
                });

                atualizarResumo(totalConsumos);

                descricaoInput.value = '';
                quantidadeInput.value = '';
                valorUnitarioInput.value = '';
            } else {
                alert('Erro ao adicionar consumo');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Erro na requisição');
        });
    });

});
