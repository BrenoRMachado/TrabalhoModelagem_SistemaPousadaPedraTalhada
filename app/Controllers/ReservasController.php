<?php

namespace App\Controllers;

use App\Core\App;

class ReservasController
{
    public function index()
    {
      
        $reservas = App::get('database')->selectAll('reservas');

        return view('admin/reservas', [
            'reservas' => $reservas
        ]);
    }
}