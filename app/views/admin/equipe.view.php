<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipe e Acessos</title>
    <link rel="stylesheet" href="/public/css/equipe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="/public/js/modais_equipe.js"></script>
    <link rel="stylesheet" href="/public/css/modal_editar_usuario.css">
    <link rel="stylesheet" href="/public/css/index.css">
</head>
<body>
    <div class="app-container">
        <?php require 'app/views/admin/sidebar.html'; ?>
        <main class="conteudo">
            <header class="cabecalho">
                <div class="titulo">
                    <h2>Equipe e Acessos</h2>
                    <p>Gerencie os funcionários e suas permissões</p>
                </div>

                <button
    class="btn-adicionar"
    onclick="abrirModalNovoUsuario('modal_novo_usuario')">
    <i class="fa-solid fa-plus"></i>
    Cadastrar Funcionário
</button>
            </header>
            <section class="time">
                <?php foreach ($funcionarios as $funcionario): ?>
                <article class="card">
                    <div class="avatar">
                        <img src="../../../public/Assets/icone_user.jpg" alt="">
                    </div>
                    <h3><?=htmlspecialchars($funcionario->nome)?></h3>
                    <span class="email"><?=htmlspecialchars($funcionario->email)?></span>
                    <span class="cargo <?= strtolower($funcionario->cargo)?>">
                        <?php if($funcionario->cargo === 'Gerente'): ?>
                            <i class="fa-solid fa-shield"></i>
                        <?php else: ?>
                            <i class="fa-solid fa-user"></i>
                        <?php endif; ?>

                        <?=htmlspecialchars($funcionario->cargo)?>
                    </span>

                    <div class="acoes">
    <!-- EDITAR -->
    <button
        class="btn-editar"
        onclick="abrirModalEditarUsuario('modal_editar_usuario_<?= $funcionario->id ?>')">
        Editar
    </button>

    <!-- INATIVAR -->
    <button
        class="btn-inativar"
        onclick="abrirModalInativarUsuario('modal_inativar_usuario_<?= $funcionario->id ?>')">
        Inativar
    </button>
</div>

                </article>
            <?php endforeach;?>

            </section>
             <?php foreach ($funcionarios as $funcionario):?>
        <?php require 'app\views\admin\Modais\Equipe\modal_editar_usuario.view.php'; ?>
    <?php endforeach;?>
        <div id="filtro" style="display:none;"></div>
        </main>
    </div>

</body>
</html>