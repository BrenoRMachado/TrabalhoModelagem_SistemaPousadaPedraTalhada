<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class EquipeController
{
    public function index()
    {
        $database = App::get('database');

        return view('admin/equipe', [
        ]);
    }
}
