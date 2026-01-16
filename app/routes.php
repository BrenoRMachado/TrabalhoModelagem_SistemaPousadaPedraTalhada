<?php

namespace App\Controllers;
use App\Controllers\ExampleController;
use App\Core\Router;

$router->get('', 'LoginController@index');
$router->post('login', 'LoginController@efetuaLogin');
$router->get('login', 'LoginController@index');
$router->get('admin/equipe', 'EquipeController@index');
$router->get('admin/financeiro', 'FinanceiroController@index');
$router->post('admin/hospedes', 'HospedesController@store');
$router->get('admin/hospedes', 'HospedesController@index');
$router->get('admin/quartos', 'QuartosController@index');
$router->get('admin/reservas', 'ReservasController@index');
$router->get('admin/index', 'IndexController@index');

$router->post('admin/hospedes/delete', 'HospedesController@delete');


