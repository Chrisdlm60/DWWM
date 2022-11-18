<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('comptes', function() {
//     // Réservé aux utilisateurs authentifiés
// })->middleware('auth');

// Route::middleware('auth')->group(function () {
//     Route::get('/', function ()    {
//         // Réservé aux utilisateurs authentifiés
//     });
//     Route::get('comptes', function () {
//         // Réservé aux utilisateurs authentifiés
//     });
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
