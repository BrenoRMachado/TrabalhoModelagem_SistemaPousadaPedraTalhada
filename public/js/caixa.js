function abrirCaixa() {
    const modal = document.getElementById('modal-abrir-caixa');
    if(modal) modal.classList.add('active');
}

function fecharCaixa() {
    const modal = document.getElementById('modal-abrir-caixa');
    const valorInput = document.getElementById('valor-inicial');
    if(modal) modal.classList.remove('active');
    if(valorInput) valorInput.value = '';
}

document.addEventListener('click', function(e){
    const modal = document.getElementById('modal-abrir-caixa');
    if(modal && modal.classList.contains('active') && e.target === modal){
        fecharCaixa();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const btnConfirmar = document.getElementById('confirmar-abrir-caixa');
    
    if(btnConfirmar) {
        btnConfirmar.addEventListener('click', async function() {
            const valorInput = document.getElementById('valor-inicial');
            const cardSaldoInicial = document.getElementById('saldo-inicial');
            const cardSaldoAtual = document.getElementById('saldo-atual');

            const valorRaw = valorInput.value.replace('.', '').replace(',', '.');
            const valor = parseFloat(valorRaw);

            if (isNaN(valor) || valor < 0) {
                alert('Digite um valor válido.');
                return;
            }

            try {
                const response = await fetch('/financeiro/abrir-caixa', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ valor: valor })
                });
                const result = await response.json();

                if (result.success) {
                    const valorFormatado = new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(valor);

                    cardSaldoInicial.innerText = valorFormatado;
                    cardSaldoAtual.innerText = valorFormatado;

                    alert('Caixa aberto com sucesso!');
                    fecharCaixa();
                } else {
                    alert('Erro ao abrir caixa: ' + result.message);
                }
            } catch (error) {
                console.error('Erro na requisição:', error);
                alert('Erro de conexão com o servidor.');
            }
        });
    }
});