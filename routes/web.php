<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/perfil', 'Users@index')->name('perfil');
Route::put('/alterar-usuario', 'Users@alterar')->name('alterar_usuario');

Route::get('/', 'Dashboard@index')->name('dashboard');
Route::get('/relatorio', 'Dashboard@relatorio')->name('relatorio');

Route::post('/emprestimos', 'Emprestimos@create')->name('novo_emprestimo');
Route::put('/emprestimos', 'Emprestimos@devolver')->name('devolver_emprestimo');
