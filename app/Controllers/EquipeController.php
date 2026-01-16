<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class EquipeController
{
    public function index()
    {
        $funcionarios = App::get('database')->selectAll('funcionario');
        $usuarios = App::get('database')->selectAll('usuario');

        return view('admin/equipe', compact('funcionarios', 'usuarios'));
    }
    
public function edit()
{
    $idFuncionario = $_POST['id_funcionario'];
    $idUsuario     = $_POST['id_usuario'];

    // Atualiza dados do Funcionário
    App::get('database')->update(
        'funcionario',
        [
            'nome'  => $_POST['nome'],
            'email' => $_POST['email'],
            'cargo' => $_POST['cargo']
        ],
        $idFuncionario
    );

    // Prepara dados básicos do Usuário
    $dadosUsuario = [
        'login' => $_POST['login']
    ];

    // Se uma nova senha foi digitada, adiciona o hash ao array de atualização
    if (!empty($_POST['senha'])) {
        $dadosUsuario['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    }

    // Faz um único update no Usuário
    App::get('database')->update('usuario', $dadosUsuario, $idUsuario);

    header('Location: /admin/equipe');
    exit;
}



}