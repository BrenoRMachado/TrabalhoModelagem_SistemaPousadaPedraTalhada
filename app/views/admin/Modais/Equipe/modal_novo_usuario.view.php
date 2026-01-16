    <div class="novo-usuario-container" id="modal_novo_usuario_<?= $funcionario->id ?>">
        <div class="modal-novo-usuario">
            <h2>Cadastrar Novo Usuário</h2>
            <div class="novo-usuario-input-container">
                <div class="novo-usuario-input">
                    <label>Nome Completo<span class="required">*</span></label>
                    <input type="text" required>
                </div>
                <div class="novo-usuario-input">
                    <label>Usuário<span class="required">*</span></label>
                    <input type="text" required>
                </div>
                <div class="novo-usuario-input">
                    <label>Senha<span class="required">*</span></label>
                    <input type="text" required>
                </div>
                <div class="novo-usuario-input">
                    <label>Cargo<span class="required">*</span></label>
                    <select required>
                        <option value="" disabled selected>Selecione um cargo</option>
                        <option value="recepcionista">Recepcionista</option>
                        <option value="gerente">Gerente</option>
                    </select>
                </div>

            </div>
            <div class="novo-usuario-btn-container">
                <button class="btn-cancelar-novo-usuario">Cancelar</button>
                <button class="btn-salvar-novo-usuario">Salvar</button>
            </div>
        </div>
    </div>  