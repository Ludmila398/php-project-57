<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__ . '/auth.php';

Route::resource('tasks', TaskController::class);

Route::resource('labels', LabelController::class)->only([
'index', 'create', 'store', 'edit', 'update', 'destroy'
]);

Route::resource('task_statuses', TaskStatusController::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
