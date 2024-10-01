<?php

use App\Http\Controllers\EtiquetasController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UsuarioController::class, 'login']);
Route::get("/usuario",[UsuarioController::class, 'index'] );
Route::post("/usuario",[UsuarioController::class, 'store'] );
Route::put("/usuario/{id}",[UsuarioController::class, 'update'] );
Route::get("/usuario/{id}",[UsuarioController::class, 'show']);
Route::patch('/usuario/{id}',[UsuarioController::class,'updatePartial']);
Route::delete("/usuario/{id}",[UsuarioController::class, 'destroy']);


Route::get('/nota',[NotasController::class,'index']);
Route::post('/nota',[NotasController::class,'store']);
Route::get("/nota/{id}",[NotasController::class, 'show']);
Route::patch('/nota/{id}',[NotasController::class,'updatePartial']);
Route::delete("/nota/{id}",[NotasController::class, 'destroy']);

Route::get('/etiqueta',[EtiquetasController::class,'index']);
Route::post('/etiqueta',[EtiquetasController::class,'store']);
Route::get("/etiqueta/{id}",[EtiquetasController::class, 'show']);
Route::put("/etiqueta/{id}",[EtiquetasController::class, 'update'] );
Route::delete("/etiqueta/{id}",[EtiquetasController::class, 'destroy']);