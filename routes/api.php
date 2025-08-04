<?php

use App\Http\Controllers\Courier\CourierController;
use App\Http\Controllers\PlatformController;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/cities/{courier:courier_service}", [CourierController::class, "getCities"])->name("courier.cities");
Route::post("/order/{courier:courier_service}/create", [CourierController::class, "createOrder"])->name("courier.createOrder");
Route::post("/order/{courier:courier_service}/cancel", [CourierController::class, "cancelOrder"])->name("order.cancel");
Route::get("/order/{courier:courier_service}/track", [CourierController::class, "track"])->name("order.track");

Route::get("/platforms", [PlatformController::class, "get"])->name("platforms.get");
Route::post("platform/create", [PlatformController::class, "store"])->name("platform.create");
Route::post("platform/{platform}/update", [PlatformController::class, "update"])->name("platform.update");
Route::post("platform/{platform}/delete", [PlatformController::class, "destroy"])->name("platform.delete");

Route::get("/materials", [\App\Http\Controllers\MaterialController::class, "get"])->name("materials.get");
Route::get("/vendors", [\App\Http\Controllers\VendorController::class, "get"])->name("vendors.get");


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
