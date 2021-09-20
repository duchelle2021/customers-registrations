<?php

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
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
  $router->get('customers',  ['uses' => 'CustomerController@showAllCustomers']);

  $router->get('customer/{customer_id}', ['uses' => 'CustomerController@showOneCustomer']);

  $router->post('customer', ['uses' => 'CustomerController@createCustomer']);

  $router->delete('customer/{customer_id}', ['uses' => 'CustomerController@deleteCustomer']);

  $router->put('customer/{customer_id}', ['uses' => 'CustomerController@updateCustomer']);
});
