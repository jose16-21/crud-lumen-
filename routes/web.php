<?php
use Illuminate\Http\Request;
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


$router->get('/', function() {
    return redirect()->route('customer.index');
});
$router->get('customer', [
    'as' => 'customer.index', 'uses' => 'CustomerController@index'
]);

$router->post('customer', [
    'as' => 'customer.store', 'uses' => 'CustomerController@store'
]);
$router->patch('customer/{id}', [
    'as' => 'customer.update', 'uses' => 'CustomerController@update'
]);

$router->delete('customer/{id}', [
    'as' => 'customer.destroy', 'uses' => 'CustomerController@destroy'
]);



$router->post('/auth/login', 'AuthController@postLogin');

$router->group(['middleware' => 'auth:api'], function($router)
{
    $router->get('/test', function() {
        return response()->json([
            'message' => 'Hello World!',
        ]);
    });
});
        
   