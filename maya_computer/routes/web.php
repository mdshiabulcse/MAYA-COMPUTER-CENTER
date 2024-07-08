<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\generatePdfController;
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

require __DIR__.'/admin_route.php';
require __DIR__.'/center_route.php';
require __DIR__.'/student_route.php';

Route::get('center/generate-pdf/{id}', [App\Http\Controllers\generatePdfController::class, 'generate_result'])->name('generatePDF');


// Route::get('/', function () { return view('welcome');});
//Route::get('/', function () { echo 'here';});


Route::get('/', [App\Http\Controllers\indexController::class, 'index']);
