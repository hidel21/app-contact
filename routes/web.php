<?php
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ContactNoteController;

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

Route::get('/', WelcomeController::class);

Route::resource('/contacts', ContactController::class);


// Route::controller(ContactController::class)->group(function (){
//     Route::get('/contacts', 'index')->name('contacts.index');

//     Route::post('/contacts', 'store')->name('contacts.store');

//     Route::get('/contacts/create','create')->name('contacts.create');
    
//     Route::get('/contacts/{id}', 'show')->name('contacts.show');

//     Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');

//     Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');

    
// });

Route::resource('/companies', CompanyController::class);

Route::resources([
    '/tags' => TagController::class,
    '/tasks' => TaskController::class
]);

//Route::resource('/activities', ActivityController::class)->names([
//    'index' => 'activities.all',
//  'show' => 'activities.view'
//]);

Route::resource('/activities', ActivityController::class)->parameters([
    'activities' => 'active'
]);

Route::resource('/contacts.note', ContactNoteController::class)->shallow();