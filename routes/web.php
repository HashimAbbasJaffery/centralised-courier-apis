<?php

use App\Classes\CourierServices\LeopardCourier;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/cities", function() {

    $courier = resolve("leopard")->getCities();

    dd($courier);
});


Route::get("create-order", function() {
    $data = [
        "destination_city" => 789,
        "shipment_type" => "OVERNIGHT",
        "booked_packet_weight" => 1000,
        "booked_packet_no_piece" => 1,
        "booked_packet_collect_amount" => 500,
        "order_id" => 12,
        "consignee_name" => "Hashim Abbas",
        "consignee_phone" => 1231456,
        "consignee_address" => "Testing address",
        "special_instructions" => "Please handle it with care!",
    ];

    $courier = resolve("leopard")->createOrder($data);

    dd($courier);
});


Route::get("cancel-order", function() {
    $trackingNumber = "KI7505327175";

    $courier = resolve("leopard")->cancelOrder($trackingNumber);

    dd($courier);
});

Route::get("track", function() {
    $trackingNumber = "KI7505375916";

    $courier = resolve("leopard")->track($trackingNumber);

    dd( $courier );
});

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get("booking/create", [BookingController::class, "create"])->name("booking.create");
Route::get("bookings", [BookingController::class, "index"])->name("booking.index");
Route::get("booking/{booking:tracking_no}", [BookingController::class, "show"])->name("booking.show");

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
