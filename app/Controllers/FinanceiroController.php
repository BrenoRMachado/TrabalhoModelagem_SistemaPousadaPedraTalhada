<?php

namespace App\Controllers;

use App\Core\App;

class FinanceiroController
{
    public function index()
    {
        $idFuncionario = $_SESSION['idFuncionario'] ?? 1;

        // Recupera caixa aberto do funcionário
        $caixasAbertos = App::get('database')->selectWhere('caixadiario', 'STATUS', 'ABERTO');
        $caixa = null;
        foreach ($caixasAbertos as $c) {
            if ($c->idFuncionario == $idFuncionario) {
                $caixa = $c;
                break;
            }
        }

        $saldoInicial = $caixa->saldoInicial ?? 0;
        $saldoAtualCalculado = $caixa->saldoFinal ?? $saldoInicial;

        // Movimentações do caixa
        $movimentacoes = [];
        if ($caixa) {
            $movimentacoes = App::get('database')->selectWhere('movimentacaocaixa', 'idCaixaDiario', $caixa->id);
        }

        // Adiciona contas pagas como entradas do dia
        $contasPagas = App::get('database')->selectWhere('conta', 'STATUS', 'PAGA');
        foreach ($contasPagas as $conta) {
            $movimentacoes[] = [
                'descricao' => "Pagamento Reserva #{$conta->idReserva}",
                'tipo'      => 'ENTRADA',
                'valor'     => (float)$conta->valorTotal,
                'dataHora'  => $conta->dataPagamento ?? date('Y-m-d H:i:s')
            ];
        }

        // Calcula entradas, saídas e saldo atual
        $entradasDia = 0;
        $saidasDia = 0;

        foreach ($movimentacoes as $m) {
            if ($m['tipo'] === 'ENTRADA') $entradasDia += $m['valor'];
            else $saidasDia += $m['valor'];
        }

        $saldoAtualCalculado = $saldoInicial + $entradasDia - $saidasDia;

        return view('admin/financeiro', compact(
            'caixa',
            'saldoInicial',
            'saldoAtualCalculado',
            'movimentacoes',
            'entradasDia'
        ));
    }

    public function abrirCaixa()
    {
        $dados = json_decode(file_get_contents('php://input'), true);
        $valorInicial = (float)($dados['valor'] ?? 0);
        $idFuncionario = $_SESSION['idFuncionario'] ?? 1;

        $campos = [
            'DATA' => date('Y-m-d H:i:s'),
            'saldoInicial' => $valorInicial,
            'saldoFinal' => $valorInicial,
            'STATUS' => 'ABERTO',
            'idFuncionario' => $idFuncionario
        ];

        try {
            $idCaixa = App::get('database')->insert('caixadiario', $campos);
            echo json_encode(['success' => true, 'valor' => $valorInicial, 'idCaixa' => $idCaixa]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
