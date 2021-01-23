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

$router-> group ([ 'prefix' => 'api','middleware' => ['auth'] ], function () use ($router) {
    $router-> group ([ 'prefix' => 'film' ], function () use ($router ) {
        $router-> get ( '/' , ['uses' => 'FilmsController@index' ]);
        $router-> post ( '/' , ['uses' => 'FilmsController@store' ]);
        $router-> get ( '/{film}' , ['uses'=> 'FilmsController@show' ]);
        $router-> patch ( '/{film}' , ['uses' => 'FilmsController@update' ]);
        $router-> delete ( '/{film}' , ['uses' => 'FilmsController@destroy' ]);

        $router-> get ( 'inYear/{year}' , ['uses'=> 'FilmsController@showFilmsInYear' ]);
        $router-> get ( 'acteur/{idActeur}' , ['uses'=> 'FilmsController@showActeursFilm' ]);
        $router-> get ( 'actor/{nomActeur}' , ['uses'=> 'FilmsController@showActorsFilm' ]);
    });
});
