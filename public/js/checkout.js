document.addEventListener('DOMContentLoaded', () => {

    const addItemBtn = document.getElementById('add-item-btn');
    const descricaoInput = document.getElementById('descricao');
    const quantidadeInput = document.getElementById('quantidade');
    const valorUnitarioInput = document.getElementById('valorUnitario');
    const idConta = parseInt(document.getElementById('idConta').value);

    const resumo = document.getElementById('resumo-pagamento');
    const tbody = document.getElementById('consumos-body');

    const diarias = parseInt(resumo.dataset.diarias);
    const valorHospedagem = parseFloat(resumo.dataset.valorHospedagem);
    let totalConsumos = parseFloat(resumo.dataset.totalConsumos);

    function atualizarResumo() {
        const taxaServico = valorHospedagem * diarias * 0.1;
        const total = valorHospedagem * diarias + taxaServico + totalConsumos;

        resumo.innerHTML = `
            <div class="checkout-summary-line">
                <span>Hospedagem (${diarias} dias):</span>
                <span>R$ ${(valorHospedagem * diarias).toFixed(2).replace('.', ',')}</span>
            </div>
            <div class="checkout-summary-line">
                <span>Consumos:</span>
                <span>R$ ${totalConsumos.toFixed(2).replace('.', ',')}</span>
            </div>
            <div class="checkout-summary-line">
                <span>Taxa de Serviço:</span>
                <span>R$ ${taxaServico.toFixed(2).replace('.', ',')}</span>
            </div>
            <hr class="checkout-divider">
            <div class="checkout-summary-total">
                <span class="checkout-text">TOTAL A PAGAR:</span>
                <span class="checkout-total-value">R$ ${total.toFixed(2).replace('.', ',')}</span>
            </div>
        `;
    }

    // Inicializa resumo
    atualizarResumo();

    // Adicionar consumo
    addItemBtn.addEventListener('click', () => {
        const descricao = descricaoInput.value.trim();
        const quantidade = parseInt(quantidadeInput.value) || 0;
        const valorUnitario = parseFloat(valorUnitarioInput.value.replace(',', '.')) || 0;

        if (!descricao || quantidade <= 0 || valorUnitario <= 0) {
            alert('Preencha todos os campos corretamente');
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
                totalConsumos = 0;

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

                atualizarResumo();

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
