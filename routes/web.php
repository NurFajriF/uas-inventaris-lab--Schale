<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LandingController;
use App\Models\InventoryItem;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('landing');
// });
Route::get('/',[LandingController::class,'index'])->name('landing');
Route::post('/landing-add',[LandingController::class,'store'])->name('landing.store');


// Route::get('/', function () {
//     if (Auth::check()) {
//         // Jika login, arahkan ke halaman admin
//         return redirect()->route('all.loan');
//     }
//     // Jika tidak login, tampilkan form peminjaman
//     return redirect()->route('add.loan');
// });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function (){
         return view('dashboard');
        })->name('dashboard');
    Route::resource('/inventory', InventoryController::class);
    Route::resource('/loans', LoanController::class)->except(['studentForm', 'staffForm', 'store']);
});


Route::get('/add-item', function () {
    return view('inventories.add_inventoryitem');
})->middleware(['auth'])->name('add.inventoryitem');

Route::get('/all-item',[InventoryController::class,'index'])->middleware(['auth'])->name('all.inventoryitem');
Route::post('/insert-item',[InventoryController::class,'store'])->middleware(['auth']);
Route::get('/edit-item/{id}', [InventoryController::class, 'edit'])->name('edit.item');
Route::put('/update-item/{id}', [InventoryController::class, 'update'])->name('update.item');
Route::delete('/delete-item/{id}', [InventoryController::class, 'destroy'])->name('delete.inventoryitem');


Route::get('/add-loan',[LoanController::class,'create'])->middleware(['auth'])->name('add.loan');
Route::get('/all-loan',[LoanController::class,'index'])->middleware(['auth'])->name('all.loan');
Route::post('/insert-loan',[LoanController::class,'store'])->middleware(['auth']);
Route::get('/edit-loan/{id}', [LoanController::class, 'edit'])->name('edit.loan');
Route::put('/update-loan/{id}', [LoanController::class, 'update'])->name('update.loan');
// Route::put('/approve-loan/{id}', [LoanController::class, 'update'])->name('approve.loan');
// Route::put('/reject-loan/{id}', [LoanController::class, 'update'])->name('reject.loan');
Route::delete('/delete-loan/{id}', [LoanController::class, 'destroy'])->name('delete.loan');




require __DIR__.'/auth.php';