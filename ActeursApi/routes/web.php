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
        return $router->app->version();
    });
    $router-> group ([ 'prefix' => 'api','middleware' => ['auth']], function () use ($router) {
        $router-> group ([ 'prefix' => 'acteurs' ], function () use ($router ) {
            $router-> get ( '/' , ['uses' => 'ActeursController@index' ]);
            $router-> post ( '/' , ['uses' => 'ActeursController@store' ]);
            $router-> get ( '/{idacteur}' , ['uses'=> 'ActeursController@show' ]);
            $router-> patch ( '/{acteur}' , ['uses' => 'ActeursController@update' ]);
            $router-> delete ( '/{acteur}' , ['uses' => 'ActeursController@destroy' ]);

        });
    });
