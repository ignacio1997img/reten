<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\TicketController;

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

Route::get('login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/', function () {
    return redirect('admin');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::resource('fee', FeeController::class);
    Route::get('fee/view/addfee/{id}', [feecontroller::class, 'view_fee'])->name('view_add_fee');
    Route::post('fee/store-update', [feecontroller::class, 'store_update'])->name('store_update_fee');
    Route::get('fee/view/addpeople/{id}', [feecontroller::class, 'view_people'])->name('view_add_people');
    Route::post('fee/add-people', [feecontroller::class, 'add_people'])->name('store_people_fee');
    Route::post('fee/inactivar-people', [feecontroller::class, 'inactivar_people'])->name('inactivar_people_fee');
    Route::post('fee/activar-people', [feecontroller::class, 'activar_people'])->name('activar_people_fee');



    Route::resource('ticket', TicketController::class);
    Route::get('ticket/generar-ticket/{id?}/{fee?}', [TicketController::class, 'generar_ticket'])->name('generar_ticket');

    // Route::post('ticket/store-generate-ticket', [TicketController::class, 'generar_ticket'])->name('generar_ticket');



});

// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
