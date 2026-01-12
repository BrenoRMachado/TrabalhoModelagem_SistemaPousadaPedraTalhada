<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Caixa</title>
    <link rel="stylesheet" href="/public/css/financeiro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php require 'app\views\admin\sidebar.html'; ?>
    <main class="conteudo">
        <header class="cabecalho">
                <div>
                    <h1>Controle de Caixa</h1>
                    <p class="subtitulo">Gerencie as movimentações financeiras</p>
                </div>
        </header>

        <section class="informacoes">
            <article class="informacoes-card">
                <div class="icon verde">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <span class="label">Saldo Inicial</span>
                <strong>R$ 200,00</strong>
            </article>

            <article class="informacoes-card">
                <div class="icon verde">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                </div>
                <span class="label">Entradas do Dia</span>
                <strong class="positivo">R$ 2.000,00</strong>
            </article>

             <article class="informacoes-card">
                <div class="icon verde">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
                <span class="label">Saldo Atual</span>
                <strong>R$ 1.700,00</strong>
            </article>
        </section>
        
        <section class="acoes">
            <button class="btn abrir">Abrir Caixa</button>
            <button class="btn sangria">Registrar Sangria</button>
            <button class="btn fechar">Fechar Caixa</button>
        </section>

        <h3 class="titulo-tabela">Movimentações Recentes</h3>
        <section class="secao-tabela">
            <table class="tabela">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Horário</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pagamento Reserva 102</td>
                        <td><span class="tag entrada">Entrada</span></td>
                        <td class="positivo">R$ 850,00</td>
                        <td>14:30</td>
                    </tr>
                     <tr>
                        <td>Sangria para banco</td>
                        <td><span class="tag saida">Saída</span></td>
                        <td class="negativo">R$ 500,00</td>
                        <td>12:00</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>