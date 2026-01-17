console.log("Script de Quartos Carregado!");

        function openStatusModal(idQuarto) {
            console.log("Tentando abrir modal para o quarto ID:", idQuarto);

            const modal = document.getElementById('statusModal');
            
            const inputId = document.getElementById('statusRoomId');

            if (!modal) {
                alert("ERRO: O arquivo do modal não foi incluído corretamente. Verifique o include no PHP.");
                return;
            }

            modal.style.display = 'flex';
            
            if (inputId) {
                inputId.value = idQuarto;
            }
        }


function openStatusModal(idQuarto) {
    const modal = document.getElementById('statusModal');
    const inputId = document.getElementById('statusRoomId');

    if (modal && inputId) {
        inputId.value = idQuarto;
        modal.style.display = 'flex';
    }
}

function setStatus(novoStatus) {
    const inputStatus = document.getElementById('inputStatusValue');
    
    if (inputStatus) {
        inputStatus.value = novoStatus.toUpperCase();
    }
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}