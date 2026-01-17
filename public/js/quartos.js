console.log("Script de Quartos Carregado!");

        function openStatusModal(idQuarto) {
            console.log("Tentando abrir modal para o quarto ID:", idQuarto);

            // 1. Pega o Modal
            const modal = document.getElementById('statusModal');
            
            // 2. Pega o Input Oculto
            const inputId = document.getElementById('statusRoomId');

            if (!modal) {
                alert("ERRO: O arquivo do modal não foi incluído corretamente. Verifique o include no PHP.");
                return;
            }

            // 3. Abre o modal e preenche o ID
            modal.style.display = 'flex';
            
            if (inputId) {
                inputId.value = idQuarto;
            }
        }


        function openStatusModal(id) {
    // 1. Encontra o modal no HTML
    const modal = document.getElementById('modalMudarStatus'); 
    
    // 2. Define o ID do quarto em um input escondido dentro do modal
    // para saber qual quarto será atualizado depois
    document.getElementById('quarto_id_input').value = id;
    
    // 3. Mostra o modal (exemplo usando display block)
    modal.style.display = 'block';
}

        function setStatus(novoStatus) {
            const idQuarto = document.getElementById('statusRoomId').value;
            console.log("Alterando status do quarto " + idQuarto + " para " + novoStatus);

            // --- ATUALIZAÇÃO VISUAL (AJAX) ---
            const card = document.getElementById('card-' + idQuarto);
            const texto = document.getElementById('text-' + idQuarto);
            const icone = document.getElementById('icon-' + idQuarto);

            if (card) {
                // Remove as cores antigas e poe a nova
                card.classList.remove('disponivel', 'ocupado', 'manutencao');
                card.classList.add(novoStatus);

                // Muda o texto
                if(texto) texto.innerText = novoStatus.charAt(0).toUpperCase() + novoStatus.slice(1);

                // Muda o icone
                if(icone) {
                    if(novoStatus === 'disponivel') icone.innerText = 'meeting_room';
                    else if(novoStatus === 'ocupado') icone.innerText = 'person';
                    else icone.innerText = 'build';
                }
            }

            // --- ENVIA PARA O BANCO DE DADOS ---
            const dados = new FormData();
            dados.append('id', idQuarto);
            dados.append('status', novoStatus);

            fetch('/admin/quartos/status', {
                method: 'POST',
                body: dados
            })
            .then(response => {
                console.log("Salvo no banco com sucesso");
                closeModal('statusModal'); // Fecha só depois de enviar
            })
            .catch(error => {
                console.error("Erro:", error);
                alert("Erro ao salvar. Verifique a conexão.");
            });
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Fecha ao clicar fora
        window.onclick = function(event) {
            const modal = document.getElementById('statusModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }