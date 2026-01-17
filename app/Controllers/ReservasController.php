<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class ReservasController
{
public function index()
{
    $database = App::get('database');
    
    $quartosDisponiveis = $database->selectWhere('quarto', 'STATUS', 'DISPONIVEL');

    $reservas = $database->selectAll('reserva');

    foreach ($reservas as $reserva) {
        $hospede = $database->selectWhere('hospede', 'id', $reserva->idHospede);
        
        if (!empty($hospede)) {
            $reserva->nome = $hospede[0]->nome;
            $reserva->cpf = $hospede[0]->cpf;
        } else {
            $reserva->nome = 'Não encontrado';
            $reserva->cpf = '000.000.000-00';
        }
    }

    return view('admin/reservas', [
        'reservas' => $reservas,
        'quartos' => $quartosDisponiveis
    ]);
}


public function criar()
{
    $idHospede = App::get('database')->insert('hospede', [
        'nome' => $_POST['nome'],
        'cpf' => $_POST['cpf'],
        'email' => $_POST['email'],
        'telefone' => $_POST['telefone'],
        'observacoes' => $_POST['observacoes']
    ]);

    $idReserva = App::get('database')->insert('reserva', [
        'dataEntradaPrevista' => $_POST['dataEntradaPrevista'],
        'dataSaidaPrevista' => $_POST['dataSaidaPrevista'],
        'idQuarto' => $_POST['idQuarto'],
        'idHospede' => $idHospede,
        'STATUS' => 'RESERVADA'
    ]);

    App::get('database')->insert('conta', [
        'valorTotal' => $_POST['valorTotal'],
        'STATUS' => 'ABERTA',
        'idReserva' => $idReserva
    ]);

    return redirect('admin/reservas');
}

public function checkin()
{
    $id = $_POST['id'];

    $dados = [
        'STATUS' => 'HOSPEDADA',
        'dataCheckin' => date('Y-m-d H:i:s')
    ];

    App::get('database')->update('reserva', $dados, 'id', $id);

    return redirect('admin/reservas');
}

public function atualizar()
{
    $id = $_POST['id'];

    $dados = [
        'dataEntradaPrevista' => $_POST['dataEntradaPrevista'],
        'dataSaidaPrevista' => $_POST['dataSaidaPrevista'],
        'idQuarto' => $_POST['idQuarto']
    ];

    App::get('database')->update('reserva', $dados, 'id', $id);
    
    return redirect('admin/reservas');
}

public function deletar()
{
    $id = $_POST['id'];
    App::get('database')->delete('reserva', 'id', $id);

    return redirect('admin/reservas');
}

}