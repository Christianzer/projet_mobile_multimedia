<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::apiResource('classe', 'API\ClasseController');
Route::apiResource('etudiant', 'API\EtudiantControllers');
Route::get('message','API\MessageController@listMessage');
Route::post('message','API\MessageController@sendMessage');
Route::post('login','API\LoginControllers@connexion');
Route::get('getclasse','API\LoginControllers@getClasse');
Route::get('getsp','API\CompteControllers@nbreCalculer');
Route::get('getEtudiant','API\CompteControllers@etudianttout');
Route::get('messageSp/{matricule}','API\CompteControllers@messageet');


