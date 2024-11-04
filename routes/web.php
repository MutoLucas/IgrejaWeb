<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Login;
use App\Http\Controllers\Dpt;
use App\Http\Controllers\Calendario;
use App\Http\Controllers\Pedido;
use App\Http\Controllers\Email;

Route::get('/', [Controller::class, 'show_home'])->name('home.index');

Route::get('/cadastro', [Login::class, 'form_cadastro'])->name('cadastro.index');
Route::post('/cadastro/store', [Login::class, 'storeUser'])->name('cadastro.store');

Route::post('/login', [Login::class, 'authLogin'])->name('login.auth');
Route::get('/logout', [Login::class, 'logout'])->name('logout');

Route::get('/perfil/{id}', [Controller::class, 'showEditUser'])->name('edit.index');
Route::post('/perfil/edit/{id}', [Controller::Class, 'editUser'])->name('edit.update');

Route::get('/departamentos', [Dpt::class, 'index'])->name('dpt.index');
Route::post('/departamentos/criar', [Dpt::class, 'criarDpt'])->name('dpt.criar');
Route::get('/departamentos/excluir/{id}', [Dpt::class, 'excluirDpt'])->name('dpt.excluir');
Route::post('/departamento/adicionar/pessoa/{id}', [Dpt::class, 'adicionarPessoa'])->name('dpt.adicionar');
Route::get('/departamento/desvincular/{nome_pessoa}/{nome_dpt}', [Dpt::class, 'desvincularPessoa'])->name('dpt.desvincular');

Route::get('/calendario/home', [Calendario::class, 'showCalendario'])->name('calendario.index');

Route::get('/pedidos/home', [Pedido::class, 'showPedidos'])->name('pedidos.index');

Route::get('/catch/email', [Email::class, 'catchEmail'])->name('email.catch');
Route::get('/catch/token', [Email::class, 'catchToken'])->name('email.token');
Route::post('/verify/email', [Email::class, 'verifySendEmail'])->name('email.verifySendEmail');
Route::post('/verify/token', [Email::class, 'verifyToken'])->name('email.verifyToken');
Route::post('/modificar/senha/{email}', [Email::class, 'modificarSenha'])->name('email.novaSenha');
