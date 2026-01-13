<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quartos - Pousada Pedra Talhada</title>
    <!-- Importação do CSS -->
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/quartos.css">
    <!-- Icones e fontes -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <?php require 'app\views\admin\sidebar.html'; ?>
        <main>
            <header class="header">
                <h1>Gerenciamento de Quartos</h1>
                <div class="legenda">
                    <div class="legenda-item">
                        <span class="status disponivel"></span>
                        <span>Disponível</span>
                    </div>
                    <div class="legenda-item">
                        <span class="status ocupado"></span>
                        <span>Ocupado</span>
                    </div>
                    <div class="legenda-item">
                        <span class="status manutencao"></span>
                        <span>Manutenção</span>
                    </div>
                </div>
            </header>
            <section class="quartos-container">

                <article class="card disponivel">
                    <div class="card-header">
                        <span class="material-icons-round">meeting_room</span>
                        <span>Disponível</span>
                    </div>
                    <div class="room-num">101</div>
                    <div class="card-footer">
                        <div class="guest-info">Standard</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card ocupado">
                    <div class="card-header">
                        <span class="material-icons-round">person</span>
                        <span>Ocupado</span>
                    </div>
                    <div class="room-num">102</div>
                    <div class="card-footer">
                        <div class="guest-info">Duplo</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card ocupado">
                    <div class="card-header">
                        <span class="material-icons-round">person</span>
                        <span>Ocupado</span>
                    </div>
                    <div class="room-num">102</div>
                    <div class="card-footer">
                        <div class="guest-info">Duplo</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card disponivel">
                    <div class="card-header">
                        <span class="material-icons-round">meeting_room</span>
                        <span>Disponível</span>
                    </div>
                    <div class="room-num">101</div>
                    <div class="card-footer">
                        <div class="guest-info">Standard</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card manutencao">
                    <div class="card-header">
                        <span class="material-icons-round">build</span>
                        <span>Manutenção</span>
                    </div>
                    <div class="room-num">103</div>
                    <div class="card-footer">
                        <div class="guest-info">Suite</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card disponivel">
                    <div class="card-header">
                        <span class="material-icons-round">meeting_room</span>
                        <span>Disponível</span>
                    </div>
                    <div class="room-num">101</div>
                    <div class="card-footer">
                        <div class="guest-info">Standard</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card ocupado">
                    <div class="card-header">
                        <span class="material-icons-round">person</span>
                        <span>Ocupado</span>
                    </div>
                    <div class="room-num">102</div>
                    <div class="card-footer">
                        <div class="guest-info">Duplo</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card disponivel">
                    <div class="card-header">
                        <span class="material-icons-round">meeting_room</span>
                        <span>Disponível</span>
                    </div>
                    <div class="room-num">101</div>
                    <div class="card-footer">
                        <div class="guest-info">Standard</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card ocupado">
                    <div class="card-header">
                        <span class="material-icons-round">person</span>
                        <span>Ocupado</span>
                    </div>
                    <div class="room-num">102</div>
                    <div class="card-footer">
                        <div class="guest-info">Duplo</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card disponivel">
                    <div class="card-header">
                        <span class="material-icons-round">meeting_room</span>
                        <span>Disponível</span>
                    </div>
                    <div class="room-num">101</div>
                    <div class="card-footer">
                        <div class="guest-info">Standard</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card manutencao">
                    <div class="card-header">
                        <span class="material-icons-round">build</span>
                        <span>Manutenção</span>
                    </div>
                    <div class="room-num">103</div>
                    <div class="card-footer">
                        <div class="guest-info">Suite</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card disponivel">
                    <div class="card-header">
                        <span class="material-icons-round">meeting_room</span>
                        <span>Disponível</span>
                    </div>
                    <div class="room-num">101</div>
                    <div class="card-footer">
                        <div class="guest-info">Standard</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card manutencao">
                    <div class="card-header">
                        <span class="material-icons-round">build</span>
                        <span>Manutenção</span>
                    </div>
                    <div class="room-num">103</div>
                    <div class="card-footer">
                        <div class="guest-info">Suite</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card disponivel">
                    <div class="card-header">
                        <span class="material-icons-round">meeting_room</span>
                        <span>Disponível</span>
                    </div>
                    <div class="room-num">101</div>
                    <div class="card-footer">
                        <div class="guest-info">Standard</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>

                <article class="card disponivel">
                    <div class="card-header">
                        <span class="material-icons-round">meeting_room</span>
                        <span>Disponível</span>
                    </div>
                    <div class="room-num">101</div>
                    <div class="card-footer">
                        <div class="guest-info">Standard</div>
                        <div class="material-icons-round card-edit">edit</div>
                    </div>
                </article>
                
            </section>
        </main>
    </div>
</body>
</html>