<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class HospedesController
{
   public function index()
{
   
    $dados_hospedes = App::get('database')->selectAll('hospede');

    return view('admin/hospedes', [

        'hospedes' => $dados_hospedes 
    ]);
}
    public function store()
    {
        // Validação básica
        if (empty($_POST['nome'])) {
            return redirect('admin/hospedes');
        }

        // Prepara os dados
        $dados = [
            'nome' => $_POST['nome'],
            'cpf' => $_POST['cpf'],
            'email' => $_POST['email'],
            'telefone' => $_POST['telefone']
        ];

       
        if (!empty($_POST['id'])) {
            
            App::get('database')->update('hospede', $dados, $_POST['id']);

        } else {
          
            App::get('database')->insert('hospede', $dados);
        }

        return redirect('admin/hospedes');
    }

    public function update()
{
    
    $id = $_POST['id']; 
    
    $dados = [
        'nome' => $_POST['nome'],
        'cpf' => $_POST['cpf'],
        'email' => $_POST['email'],
        'telefone' => $_POST['telefone']
    ];

  
    App::get('database')->update('hospedes', $id, $dados);

  
    return redirect('admin/hospedes');
}

    public function delete()
{

    if (isset($_POST['id'])) {
  
        App::get('database')->delete('hospede', $_POST['id']);
    }


    return redirect('admin/hospedes');
}
}