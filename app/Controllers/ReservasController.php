<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class ReservasController
{
    public function index()
    {
        return view('admin/reservas');
    }
}