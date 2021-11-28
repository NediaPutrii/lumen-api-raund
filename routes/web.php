<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return ["Hello Hai..!!!"];
});

$router->get('/travel_agent', function () use ($router) {
    $results = app('db')->select("SELECT * FROM travel_agents");
    return response()->json($results);
});

$router->post('/register', 'UserController@register');
$router->post('/login','AuthController@login');

$router->get('/saved_address/{nim}', 'SavedAddressController@show');
$router->post('/saved_address', 'SavedAddressController@store');

// $router->post('/travel_agent_store', 'TravelAgentController@store');
$router->get('/mobil/{id_travel_agent}', 'MobilController@show');
// $router->get('/savedaddress/{nim}', function () use ($router) {
//     $results = app('db')->select("SELECT * FROM saved_address where nim=$nim");
//     return response()->json($results);
// });


$router->group(['middleware' => 'auth'], function() use ($router){
    $router->post('/logout', 'AuthController@logout');
});
