<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Esta ruta devuelve un JSON de este tipo: { "name": "John Doe", "email": "}
Route::get('/user', function () {
    return response()->json([
        'name' => 'John Doe',
        'email' => 'john-doe@gmail.com'
    ]);
});
