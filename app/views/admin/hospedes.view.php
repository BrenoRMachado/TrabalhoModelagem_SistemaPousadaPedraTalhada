<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóspedes - Pousada Pedra Talhada</title>
    
    <link rel="stylesheet" href="/public/css/hospedes.css"> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
 
    <div class="app-container">
        <?php require 'app/views/admin/sidebar.html'; ?> <main>
            <div class="page-header">
                <div>
                    <h1>Lista de Hóspedes</h1>
                    <p class="subtitle">Gerencie os hóspedes cadastrados</p>
                </div>
                <div class="page-header-actions">
                    <button class="btn btn-blue" onclick="openModal('guestModal')">
                        <span class="material-icons-round">add</span> Novo Hóspede
                    </button>
                </div>
            </div>

            <div class="filter-container">
                <div class="filter-group">
                    <label>Buscar</label>
                    <div class="search-box">
                        <span class="material-icons-round search-icon">search</span>
                        <input type="text" id="searchGuest" placeholder="Buscar por nome ou CPF" onkeyup="filterTable()" />
                    </div>
                </div>
            </div>

            <div class="table-container">
                <table id="guestsTable">
                    <thead>
                        <tr>
                            <th>ID</th> 
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Última Estadia</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($hospedes as $hospede): ?>
                        <tr>
                            <td><?= $hospede->id ?></td>
                            <td><?= $hospede->nome ?></td>
                            <td><?= $hospede->cpf ?></td>
                            <td><?= $hospede->telefone ?></td>
                            <td><?= $hospede->email ?></td>
                            <td><?= $hospede->observacoes ?? 'N/A' ?></td>
                            
                            
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-small" onclick="editGuest(<?= $hospede->id ?>)" title="Editar">
                                        <span class="material-icons-round edit-color">edit</span>
                                    </button>
                                    
                                    <form action="/admin/hospedes/delete" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza?');">
                                        <input type="hidden" name="id" value="<?= $hospede->id ?>">
                                        <button type="submit" class="btn btn-small" title="Excluir">
                                            <span class="material-icons-round delete-color">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <div id="guestModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Novo Hóspede</h2>
            </div>
            
            <form action="/admin/hospedes" method="POST" id="guestForm">
                
                <div class="form-group">
                    <label for="nome">Nome Completo *</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF/RG *</label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone *</label>
                    <input type="tel" id="telefone" name="telefone" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('guestModal')">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block'; // ou 'flex', dependendo do seu CSS
        }
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        // Fecha o modal se clicar fora dele
        window.onclick = function(event) {
            var modal = document.getElementById('guestModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function editGuest(id, nome, cpf, email, telefone) {
    // 1. Abre o modal
    document.getElementById('guestModal').style.display = 'block'; // ou 'flex'
    document.getElementById('modalTitle').innerText = 'Editar Hóspede';

    // 2. Preenche os campos do formulário com os dados que vieram do PHP
    document.getElementById('guestId').value = id; // O campo hidden importante!
    document.getElementById('nome').value = nome;
    document.getElementById('cpf').value = cpf;
    document.getElementById('email').value = email;
    document.getElementById('telefone').value = telefone;
}
    </script>

    
    <script src="/public/js/hospedes.js"></script> 
</body>
</html>