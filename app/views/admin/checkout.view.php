<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../../../public/css/checkout.css">
    <link rel="stylesheet" href="../../../public/css/index.css">
</head>
<body>
    <div class="checkout-app-container">
        <header>
            <div class="checkout-header-content">
                <h1>Checkout</h1>
            </div>
        </header>
        <main class="checkout-main-content">
            <section class="checkout-details-section">

                <!-- Dados do hóspede -->
                <div class="checkout-group-container">
                    <h2 class="checkout-section-title">Dados do Hóspede</h2>
                    <div class="checkout-info-grid">
                        <div class="checkout-info-item">
                            <label>NOME</label>
                            <span><?= $hospede->nome ?></span>
                        </div>
                        <div class="checkout-info-item">
                            <label>CPF</label>
                            <span><?= $hospede->cpf ?></span>
                        </div>
                        <div class="checkout-info-item">
                            <label>E-MAIL</label>
                            <span><?= $hospede->email ?></span>
                        </div>
                        <div class="checkout-info-item">
                            <label>TELEFONE</label>
                            <span><?= $hospede->telefone ?></span>
                        </div>
                    </div>
                </div>

                <!-- Detalhes da hospedagem -->
                <div class="checkout-group-container">
                    <h2 class="checkout-section-title">Detalhes da Hospedagem</h2>
                    <div class="checkout-info-grid">
                        <div class="checkout-info-item">
                            <label>QUARTO</label>
                            <span><?= $quarto->numero ?></span>
                        </div>
                        <div class="checkout-info-item">
                            <label>TIPO DE QUARTO</label>
                            <span><?= $quarto->tipo ?></span>
                        </div>
                        <div class="checkout-info-item">
                            <label>DATA DE ENTRADA</label>
                            <span><?= date('d/m/Y', strtotime($reserva->dataEntradaPrevista)) ?></span>
                        </div>
                        <div class="checkout-info-item">
                            <label>DATA DE SAÍDA</label>
                            <span><?= date('d/m/Y', strtotime($reserva->dataSaidaPrevista)) ?></span>
                        </div>
                    </div>
                </div>

                <!-- Consumos e taxas -->
                <div class="checkout-group-container">
                    <h2 class="checkout-section-title">Consumos e Taxas Adicionais</h2>
                    <table class="checkout-table">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Valor</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="consumos-body">
                            <?php foreach ($consumos as $item): ?>
                            <tr>
                                <td><?= $item->descricao ?></td>
                                <td><?= $item->quantidade ?></td>
                                <td>R$ <?= number_format($item->valorUnitario, 2, ',', '.') ?></td>
                                <td><strong>R$ <?= number_format($item->quantidade * $item->valorUnitario, 2, ',', '.') ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Adicionar consumo -->
                    <div class="checkout-add-item-row">
                        <input type="text" id="descricao" placeholder="Nome do item" class="checkout-input-small">
                        <input type="number" id="quantidade" placeholder="Qtd" class="checkout-input-small">
                        <input type="text" id="valorUnitario" placeholder="Valor" class="checkout-input-small">
                        <button id="add-item-btn" class="checkout-btn-confirm">Adicionar</button>
                        <input type="hidden" id="idConta" value="<?= $conta->id ?>">
                    </div>
                </div>

                <div class="checkout-group-container">
                    <h2 class="checkout-section-title">Observações e Avisos</h2>
                    <textarea class="checkout-textarea"><?= $hospede->observacoes ?></textarea>
                </div>
            </section>

            <!-- Resumo de pagamento -->
            <aside class="checkout-summary-aside">
                <div class="checkout-summary-card">
                    <h2 class="checkout-summary-title">Resumo de Pagamento</h2>
                    <div class="checkout-summary-details" id="resumo-pagamento">
                        <!-- Será atualizado via JS -->
                        <?php
                        $totalConsumos = 0;
                        foreach ($consumos as $item) {
                            $totalConsumos += $item->quantidade * $item->valorUnitario;
                        }
                        $diarias = (strtotime($reserva->dataSaidaPrevista) - strtotime($reserva->dataEntradaPrevista)) / 86400;
                        $valorHospedagem = $quarto->precoDiaria * $diarias;
                        $taxaServico = $valorHospedagem * 0.1;
                        $total = $valorHospedagem + $taxaServico + $totalConsumos;
                        ?>
                        <div class="checkout-summary-line">
                            <span>Hospedagem (<?= $diarias ?> dias):</span>
                            <span>R$ <?= number_format($valorHospedagem, 2, ',', '.') ?></span>
                        </div>
                        <div class="checkout-summary-line">
                            <span>Consumos:</span>
                            <span>R$ <?= number_format($totalConsumos, 2, ',', '.') ?></span>
                        </div>
                        <div class="checkout-summary-line">
                            <span>Taxa de Serviço:</span>
                            <span>R$ <?= number_format($taxaServico, 2, ',', '.') ?></span>
                        </div>
                        <div class="checkout-summary-line">
                            <span>Descontos:</span>
                            <span>R$ 0,00</span>
                        </div>
                        <hr class="checkout-divider">
                        <div class="checkout-summary-total">
                            <span class="checkout-text">TOTAL A PAGAR:</span>
                            <span class="checkout-total-value">R$ <?= number_format($total, 2, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
                <div class="checkout-actions">
                    <button class="checkout-btn-cancel" onclick="history.back()">Retornar</button>
                    <button class="checkout-btn-confirm" onclick="document.getElementById('form-confirm').submit()">Confirmar Pagamento e Liberar Quarto</button>
                </div>
            </aside>
        </main>
    </div>

    <script src="../../../public/js/checkout.js"></script>
</body>
</html>
