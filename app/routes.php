<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Route for the default page.
 */
Route::get('/', function () {
    return View::make('index', array('menuItem' => MenuItems::__default));
});

/**
 * Route for the generate page.
 */
Route::get('/generate', 'GenerateController@showPage');

/**
 * Route for the generate form.
 */
Route::post('/generate', 'GenerateController@generate');

/**
 * Route for the start page.
 */
Route::get('/start', 'GenerateController@showStartPage');

/**
 * Route for the results page.
 */
Route::get('/results', 'ResultsController@showPage');

/**
 * Route for the Blum-Micali results page.
 */
Route::get('/results/blummicali', 'ResultsController@showBlumMicaliPage');

/**
 * Route for the RSA results page.
 */
Route::get('/results/rsa', 'ResultsController@showRsaPage');

/**
 * Route for AJAX request.
 */
Route::get('/api/isPrime/{number}', 'GenerateController@isPrime')
    ->where('number', '[0-9]+');

/**
 * Route for AJAX request.
 */
Route::get('/api/areCoprime/{number},{number1},{number2}', 'GenerateController@areCoprime')
    ->where(array('number' => '[0-9]+', 'number1' => '[0-9]+', 'number2' => '[0-9]+'));
