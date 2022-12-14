<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;

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

// login system of Breeze package 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
// login system of Breeze package  


Route::prefix('/admin')->group(function(){

    // Admin dashboard route 
    Route::match(['get', 'post'],'/login', [AdminController::class, 'login']);

    Route::group(['middleware'=>['admin']], function(){

        // Admin dashboard route 
        Route::get('/dashboard', [AdminController::class, 'dashboard']);

        // Update Admin password 
        Route::match(['get','post'],'/update-admin-password',[AdminController::class,'updateAdminPassword']);

        // Update Admin details 
        Route::match(['get','post'],'/update-admin-details',[AdminController::class,'updateAdminDetails']);

        // Check Admin password 
        Route::post('/check-admin-password',[AdminController::class,'checkAdminPassword']);
        
        // Logout route
        Route::get('/logout', [AdminController::class, 'logout']);
    });
    

});

