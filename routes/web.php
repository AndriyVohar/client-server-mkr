<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;

Route::get('/', function () {
    return view('welcome');
});

// Resource routes for Medicines CRUD
Route::resource('medicines', MedicineController::class);
