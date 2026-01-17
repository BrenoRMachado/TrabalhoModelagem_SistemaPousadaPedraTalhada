<?php

namespace App\Controllers;

use App\Core\App;

class ReservasController
{
    public function index()
    {
      
        $reservas = App::get('database')->selectAll('reserva');

        return view('admin/reservas', [
            'reservas' => $reservas
        ]);
    }
}