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
$router->post('admin/update', 'HospedesController@update');
$router->get('admin/hospedes', 'HospedesController@index');



$router->get('quartos', 'QuartosController@index');


$router->get('admin/reservas', 'ReservasController@index');
$router->get('admin/index', 'IndexController@index');

$router->post('admin/hospedes/delete', 'HospedesController@delete');
$router->post('admin/equipe/edit', 'EquipeController@edit');
$router->post('admin/equipe/create', 'EquipeController@create');
$router->post('admin/equipe/delete', 'EquipeController@delete');



