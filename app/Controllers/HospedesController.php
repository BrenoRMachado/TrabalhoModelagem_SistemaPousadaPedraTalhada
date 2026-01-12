<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class HospedesController
{
    public function index()
    {
        return view('admin/hospedes');
    }
}
