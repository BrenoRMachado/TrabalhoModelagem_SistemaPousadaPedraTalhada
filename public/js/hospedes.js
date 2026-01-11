function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add('show');
    
    if (modalId === 'guestModal') {
        document.getElementById('modalTitle').textContent = 'Novo Hóspede';
        document.getElementById('guestForm').reset();
    }
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('show');
}

function filterTable() {
    const searchText = document.getElementById('searchGuest').value.toLowerCase();
    const table = document.getElementById('guestsTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let row of rows) {
        let name = row.cells[0].textContent.toLowerCase();
        let cpf = row.cells[1].textContent.toLowerCase();
        
        if (name.includes(searchText) || cpf.includes(searchText)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}

function editGuest(id) {
    openModal('guestModal');
    document.getElementById('modalTitle').textContent = 'Editar Hóspede';
    document.getElementById('modalGuestName').value = 'Exemplo Hóspede ' + id;
}

function deleteGuest(id) {
    if (confirm('Tem certeza que deseja deletar este hóspede?')) {
        alert('Hóspede deletado com sucesso!');
    }
}

function submitGuestForm(event) {
    event.preventDefault();
    alert('Hóspede salvo com sucesso!');
    closeModal('guestModal');
}

window.onclick = function(event) {
    const modal = document.getElementById('guestModal');
    if (event.target === modal) {
        closeModal('guestModal');
    }
}