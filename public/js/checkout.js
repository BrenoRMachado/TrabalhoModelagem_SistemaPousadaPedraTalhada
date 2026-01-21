document.getElementById('add-item-btn').addEventListener('click', function() {
    const descricao = document.getElementById('descricao').value;
    const quantidade = document.getElementById('quantidade').value;
    const valorUnitario = document.getElementById('valorUnitario').value;
    const idConta = document.getElementById('idConta').value;

    if(!descricao || !quantidade || !valorUnitario){
        alert('Preencha todos os campos');
        return;
    }

    fetch('/admin/checkout/adicionarConsumo', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `descricao=${descricao}&quantidade=${quantidade}&valorUnitario=${valorUnitario}&idConta=${idConta}`
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success'){
            const tbody = document.getElementById('consumos-body');
            tbody.innerHTML = '';
            data.consumos.forEach(item => {
                tbody.innerHTML += `<tr>
                    <td>${item.descricao}</td>
                    <td>${item.quantidade}</td>
                    <td>R$ ${parseFloat(item.valorUnitario).toFixed(2).replace('.',',')}</td>
                    <td><strong>R$ ${(item.quantidade*item.valorUnitario).toFixed(2).replace('.',',')}</strong></td>
                </tr>`;
            });

            // Atualizar resumo
            const totalConsumos = data.total;
            const diarias = <?= (strtotime($reserva->dataSaidaPrevista) - strtotime($reserva->dataEntradaPrevista)) / 86400 ?>;
            const valorHospedagem = <?= $quarto->precoDiaria ?> * diarias;
            const taxaServico = valorHospedagem * 0.1;
            const total = valorHospedagem + taxaServico + totalConsumos;

            const resumo = document.getElementById('resumo-pagamento');
            resumo.innerHTML = `
                <div class="checkout-summary-line">
                    <span>Hospedagem (${diarias} dias):</span>
                    <span>R$ ${valorHospedagem.toFixed(2).replace('.',',')}</span>
                </div>
                <div class="checkout-summary-line">
                    <span>Consumos:</span>
                    <span>R$ ${totalConsumos.toFixed(2).replace('.',',')}</span>
                </div>
                <div class="checkout-summary-line">
                    <span>Taxa de Serviço:</span>
                    <span>R$ ${taxaServico.toFixed(2).replace('.',',')}</span>
                </div>
                <div class="checkout-summary-line">
                    <span>Descontos:</span>
                    <span>R$ 0,00</span>
                </div>
                <hr class="checkout-divider">
                <div class="checkout-summary-total">
                    <span class="checkout-text">TOTAL A PAGAR:</span>
                    <span class="checkout-total-value">R$ ${total.toFixed(2).replace('.',',')}</span>
                </div>
            `;

            // Limpar inputs
            document.getElementById('descricao').value = '';
            document.getElementById('quantidade').value = '';
            document.getElementById('valorUnitario').value = '';
        }
    });
});
