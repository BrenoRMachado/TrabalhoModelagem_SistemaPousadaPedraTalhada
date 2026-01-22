<?php

namespace App\Controllers;

use App\Core\App;

class FinanceiroController
{
    public function index()
    {
        $idFuncionario = $_SESSION['idFuncionario'] ?? 1;

$caixaAberto = App::get('database')->selectWhere('caixadiario', 'STATUS', 'ABERTO');
$caixa = null;

foreach ($caixaAberto as $c) {
    if ($c->idFuncionario == $idFuncionario) {
        $caixa = $c;
        break;
    }
}


        $caixa = $caixaAtual[0] ?? null;

        $saldoInicial = $caixa['saldoInicial'] ?? 0;
        $saldoAtual = $caixa['saldoFinal'] ?? 0;

        // Movimentações
        $movimentacoes = [];
        if($caixa){
            $movimentacoes = App::get('database')->selectWhere(
                'movimentacaocaixa',
                '*',
                ['idCaixaDiario' => $caixa['id']]
            );
        }

        return view('admin/financeiro', compact('caixa', 'saldoInicial', 'saldoAtual', 'movimentacoes'));
    }

    public function abrirCaixa()
{
    $dados = json_decode(file_get_contents('php://input'), true);
    $valorInicial = $dados['valor'] ?? 0;
    $idFuncionario = $_SESSION['idFuncionario'] ?? 1;

    $campos = [
        'DATA' => date('Y-m-d H:i:s'),
        'saldoInicial' => $valorInicial,
        'saldoFinal' => $valorInicial,
        'STATUS' => 'ABERTO',
        'idFuncionario' => $idFuncionario
    ];

    try {
        App::get('database')->insert('caixadiario', $campos);
        echo json_encode(['success' => true, 'valor' => $valorInicial]);
    } catch (\Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
}
