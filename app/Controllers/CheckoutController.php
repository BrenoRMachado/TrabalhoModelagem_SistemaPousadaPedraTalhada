<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class CheckoutController
{
    // Página do checkout
    public function index()
    {
        $idReserva = $_GET['id'] ?? null;
        if (!$idReserva) {
            throw new Exception("Reserva não encontrada.");
        }

        $db = App::get('database');

        $reserva = $db->selectWhere('reserva', 'id', $idReserva);
        if (empty($reserva)) {
            throw new Exception("Reserva não encontrada.");
        }
        $reserva = $reserva[0];

        $hospede = $db->selectWhere('hospede', 'id', $reserva->idHospede);
        $hospede = $hospede[0] ?? null;

        $quarto = $db->selectWhere('quarto', 'numero', $reserva->idQuarto);
        $quarto = $quarto[0] ?? null;

        $conta = $db->selectWhere('conta', 'idReserva', $reserva->id);
        $conta = $conta[0] ?? null;

        // Buscar consumos relacionados à conta
        $consumos = $conta ? $db->selectWhere('itemconsumo', 'idConta', $conta->id) : [];

        return view('admin/checkout', [
            'reserva'  => $reserva,
            'hospede'  => $hospede,
            'quarto'   => $quarto,
            'conta'    => $conta,
            'consumos' => $consumos
        ]);
    }

    // Confirmar checkout
    public function confirmar()
    {
        $idReserva = $_POST['idReserva'] ?? null;
        if (!$idReserva) {
            throw new Exception("Reserva inválida.");
        }

        $db = App::get('database');

        $db->update('reserva', [
            'STATUS'       => 'FINALIZADA',
            'dataCheckout' => date('Y-m-d H:i:s')
        ], ['id' => $idReserva], 'id');

        $db->update('conta', [
            'STATUS' => 'PAGA'
        ], ['idReserva' => $idReserva], 'idReserva');

        $reserva = $db->selectWhere('reserva', 'id', $idReserva)[0];
        $db->update('quarto', [
            'STATUS' => 'DISPONIVEL'
        ], ['numero' => $reserva->idQuarto], 'numero');

        return redirect('/admin/reservas');
    }

    // Adicionar item de consumo
    public function adicionarConsumo()
    {
        $descricao = $_POST['descricao'] ?? null;
        $quantidade = $_POST['quantidade'] ?? null;
        $valorUnitario = $_POST['valorUnitario'] ?? null;
        $idConta = $_POST['idConta'] ?? null;

        if (!$descricao || !$quantidade || !$valorUnitario || !$idConta) {
            return json_encode(['status' => 'error', 'msg' => 'Dados incompletos']);
        }

        $db = App::get('database');

        // Inserir no banco
        $db->insert('itemconsumo', [
            'descricao' => $descricao,
            'quantidade' => $quantidade,
            'valorUnitario' => $valorUnitario,
            'idConta' => $idConta
        ]);

        // Atualizar total da conta
        $itens = $db->selectWhere('itemconsumo', 'idConta', $idConta);

        $totalConsumos = 0;
        foreach ($itens as $item) {
            $totalConsumos += $item->quantidade * $item->valorUnitario;
        }

        $db->update('conta', [
            'valorTotal' => $totalConsumos
        ], ['id' => $idConta], 'id');

        return json_encode([
            'status' => 'success',
            'consumos' => $itens,
            'total' => $totalConsumos
        ]);
    }
}
