<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class EquipeController
{
    public function index()
    {
        
        $funcionarios = App::get('database')->selectAll('funcionario');

        return view('admin/equipe', compact('funcionarios'));
    }
}
