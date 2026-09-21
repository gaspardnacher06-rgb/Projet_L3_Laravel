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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;

Route::get('/panier', [CartController::class, 'index'])->name('panier')->middleware('auth');
Route::post('/panier/ajouter/{article}', [CartController::class, 'add'])->name('panier.ajouter')->middleware('auth');
Route::patch('/panier/{cartItem}', [CartController::class, 'update'])->name('panier.update')->middleware('auth');
Route::delete('/panier/{cartItem}', [CartController::class, 'remove'])->name('panier.remove')->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [ArticleController::class, 'boutique'])->name('boutique');

Route::resource('articles', ArticleController::class)->except('show')->middleware('admin');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show')->middleware('auth');