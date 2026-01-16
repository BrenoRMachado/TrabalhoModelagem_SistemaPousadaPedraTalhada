function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
    document.getElementById('guestForm').reset(); // Limpa os campos
    document.getElementById('guestId').value = ''; // Garante que o ID está vazio
    document.getElementById('modalTitle').innerText = 'Novo Hóspede';
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

function editGuest(id, nome, cpf, email, telefone) {

    document.getElementById('guestModal').style.display = 'block';
    

    document.getElementById('modalTitle').innerText = 'Editar Hóspede';

    document.getElementById('nome').value = nome;
    document.getElementById('cpf').value = cpf;
    document.getElementById('email').value = email;
    document.getElementById('telefone').value = telefone;


    document.getElementById('guestId').value = id;
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