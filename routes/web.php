<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::controller(StudentController::class)->group(function () {
    Route::get('/add-new-student', 'add')->name('add-new-student');
    Route::post('/add-new-student', 'create')->name('create-new-student');
    Route::get('/edit-student', 'edit')->name('edit-student');
    Route::post('/update-student', 'update')->name('update-student');
    Route::get('/delete-student', 'remove')->name('remove-student');
    Route::post('/delete-student', 'delete')->name('delete-student');
    Route::get('/view-all-students', 'read')->name('view-all-students');
    Route::get('/rollSearch', 'getInfo');
    Route::get('/dateSearch', 'getInfo');
    Route::post('/allLists', 'ajaxList')->name('allLists');

});

