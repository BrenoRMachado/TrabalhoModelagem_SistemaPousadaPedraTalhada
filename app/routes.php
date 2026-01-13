<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'LoginController@index');
$router->get('admin/equipe', 'EquipeController@index');
$router->get('admin/financeiro', 'FinanceiroController@index');
$router->get('admin/hospedes', 'HospedesController@index');
$router->get('admin/quartos', 'QuartosController@index');
