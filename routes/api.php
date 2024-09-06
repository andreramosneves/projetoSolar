<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EquipamentController;
use App\Http\Controllers\TypeInstallationController;
use App\Http\Controllers\UfController;


use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectEquipamentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Req 7*/
Route::get('/type_installation', [TypeInstallationController::class, 'list']);
Route::get('/equipament', [EquipamentController::class, 'list']);
Route::get('/uf', [UfController::class, 'list']);

/*Somente para inserir no banco de dados/deletar*/
Route::post('/uf', [UfController::class, 'save']);
Route::post('/type_installation', [TypeInstallationController::class, 'save']);
Route::post('/equipament', [EquipamentController::class, 'save']);

Route::delete('/uf/{id}', [UfController::class, 'destroy']);
Route::delete('/type_installation/{id}', [TypeInstallationController::class, 'destroy']);
Route::delete('/equipament/{id}', [EquipamentController::class, 'destroy']);


/* Req 8 */
Route::get('/client', [ClientController::class, 'list']);
Route::put('/client/{id}', [ClientController::class, 'update']);
Route::post('/client', [ClientController::class, 'save']);
Route::delete('/client/{id}', [ClientController::class, 'destroy']);


/*Req 1, 4*/
Route::post('/project', [ProjectController::class, 'save']);

/* Req 2 */
Route::get('/project', [ProjectController::class, 'list']);

/* Req 3 */
Route::get('/project/{id}', [ProjectController::class, 'detail']);

/*Req 5 Quantidade, E Item Equipamento Obrigatorio*/
Route::put('/project_equipament/{idProject}/{idEquip}', [ProjectEquipamentController::class, 'update']);
/*Req 5 Quantidade, E Item Equipamento Obrigatorio*/
Route::post('/project_equipament/{idProject}/{idEquip}', [ProjectEquipamentController::class, 'add']);

/*Req 5 Quantidade, E Item Equipamento Obrigatorio*/
Route::delete('/project_equipament/{idProject}/{idEquip}', [ProjectEquipamentController::class, 'destroyEquipament']);

/*Req 6*/
Route::delete('/project/{id}', [ProjectController::class, 'destroy']);




