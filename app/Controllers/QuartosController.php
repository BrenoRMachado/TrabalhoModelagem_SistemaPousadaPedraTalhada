<?php

namespace App\Controllers;

use App\Core\App;
use Exception;


class QuartosController
{
 public function index()
    {
        $dados = App::get('database')->selectAll('quarto');
        return view('admin/quartos', ['quarto' => $dados]);
    }

    // SALVA NO BANCO (Esta é a parte que faltava)
    public function updateStatus()
    {
        // 1. Recebe os dados do JavaScript
        $id = $_POST['id'];
        $novoStatus = $_POST['status'];

        // 2. Validação simples de segurança
        $statusPermitidos = ['disponivel', 'manutencao', 'ocupado', 'limpeza'];

        if (in_array($novoStatus, $statusPermitidos)) {
            
            // 3. Manda o banco atualizar
            // Assume que você tem uma função update() no seu QueryBuilder
            App::get('database')->update('quarto', $id, [
                'status' => $novoStatus
            ]);
            
            // Retorna sucesso para o JavaScript não dar erro
            echo json_encode(['sucesso' => true]);
            exit;
        }
    }
}