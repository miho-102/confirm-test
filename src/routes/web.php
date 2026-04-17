<?php
namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;
use App\Http\controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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
Route::get('/',[ContactController::class,'index']);
Route::post('/confirm',[ContactController::class,'confirm']);
route::post('/thanks',[ContactController::class,'store']);
Route::post('/back', [ContactController::class, 'back']);
//Route::get('/register', [AuthController::class, 'register']);
//Route::post('/register', [AuthController::class, 'store']);
//Route::get('/login', [AuthController::class, 'login']);
Route::get('/admin', [AdminController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/delete', [AdminController::class, 'destroy']);
    Route::get('/admin/export', [AdminController::class, 'export']);
});