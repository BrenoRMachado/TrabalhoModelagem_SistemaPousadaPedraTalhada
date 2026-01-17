<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quartos - Pousada Pedra Talhada</title>
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/quartos.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
   
    </style>
</head>
<body>
   <div class="app-container">
        <?php require 'app/views/admin/sidebar.html'; ?>
        <main>
            <header class="header">
                <h1>Gerenciamento de Quartos</h1>
                <div class="legenda">
                    <div style="display:flex; gap:15px; align-items:center;">
                        <span style="width:12px; height:12px; background:#4CAF50; border-radius:50%; display:inline-block;"></span> Disponível
                        <span style="width:12px; height:12px; background:#F44336; border-radius:50%; display:inline-block;"></span> Ocupado
                        <span style="width:12px; height:12px; background:#FFC107; border-radius:50%; display:inline-block;"></span> Manutenção
                    </div>
                </div>
            </header>

            <section class="quartos-container">

                <?php foreach ($quarto as $quart): ?>
                    
                    <article class="card <?= strtolower($quart->status) ?>">
                        
                        <div class="card-header">
                            <?php if($quart->status == 'disponivel'): ?>
                                <span class="material-icons-round">meeting_room</span>
                            <?php elseif($quart->status == 'ocupado'): ?>
                                <span class="material-icons-round">person</span>
                            <?php else: ?>
                                <span class="material-icons-round">build</span>
                            <?php endif; ?>
                            
                            <span><?= ucfirst($quart->status) ?></span>
                        </div>

                        <div class="room-num"><?= $quart->numero ?></div>

                        <div class="card-footer">
                            <div class="guest-info"><?= $quart->tipo ?></div>
                            
                            <button type="button" class="btn-icon" onclick="openStatusModal('<?= $quart->id ?>')" title="Alterar Status">
                                <span class="material-icons-round card-edit">edit</span>
                            </button>
                        </div>
                    </article>

                <?php endforeach; ?>
                </section>
        </main>
    </div>

    <?php include 'app/views/admin/Modais/Quartos/modal_mudar_status.view.php'; ?>
    <script src="/public/js/quartos.js"></script>

</body>
</html>