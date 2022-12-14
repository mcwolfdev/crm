<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CreateJobController;
use App\Http\Controllers\EditJobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModelsController;
use App\Http\Controllers\PrintJobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
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

/*Route::get('/model', function () {
    return view('model.index_model');
})->middleware('auth');*/

Route::prefix('/')->middleware('auth')->group(function () {

    /*Route::get('/', function () {
    return view('home');
});*/

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('job/create', [CreateJobController::class, 'index'])->name('job_create');
    Route::get('job/edit/{id}', [EditJobController::class, 'index'])->name('job_edit');
    Route::get('job/print={id}', [PrintJobController::class, 'index'])->name('job_print');
    Route::post('job/edit/', [EditJobController::class, 'edit_job'])->name('edit_job');

    Route::post('find_client', [CreateJobController::class, 'find_client'])->name('find_client');
    Route::post('/create_job-input-fields', [CreateJobController::class, 'add_new_work'])->name('create_job_input_fields');
    Route::get('find_model/{id}', [CreateJobController::class, 'findModel']);

    //TODO find
    Route::post('find_parts/', [EditJobController::class, 'find_parts'])->name('find_parts');
    Route::post('find_jobs/', [EditJobController::class, 'find_jobs'])->name('find_jobs');

    //TODO Settings
    Route::get('/settings/model', [ModelsController::class, 'index']);
    Route::get('/settings/brand', [BrandsController::class, 'index']);
    Route::get('/settings/vehicle', [VehicleController::class, 'index']);
    Route::get('/settings/clients', [ClientsController::class, 'index']);
    Route::get('/settings/users', [UserController::class, 'index']);
    //Route::get('find_info_client/{id}', [CreateJobController::class, 'findinfoclient']);

});


Auth::routes(['register' => false]);



/*Route::get('/home', function () {
    return view('home');
});*/
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
