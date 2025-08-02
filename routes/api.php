<?php

use App\Http\Controllers\Courier\CourierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/cities/{courier:courier_service}", [CourierController::class, "getCities"])->name("courier.cities");
Route::get("/order/{courier:courier_service}/create", [CourierController::class, "createOrder"])->name("courier.createOrder");
Route::get("/order/{courier:courier_service}/cancel", [CourierController::class, "cancelOrder"])->name("order.cancel");
Route::get("/order/{courier:courier_service}/track", [CourierController::class, "track"])->name("order.track");

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
