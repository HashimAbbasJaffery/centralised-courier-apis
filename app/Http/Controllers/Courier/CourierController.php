<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function getCities(Courier $courier) {
        $service = $courier->courier_service;
        $response = resolve($service)->getCities();
        return response()->json($response);
    }
    public function createOrder(Request $request, Courier $courier) {
        $service = $courier->courier_service;

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

        $response = resolve($service)->createOrder($data);

        return response()->json($response);
    }
    public function cancelOrder(Request $request, Courier $courier) {
        $service = $courier->courier_service;

        $tracking_number = $request->tracking_number ?? "KI7505327195";
        $response = resolve($service)->cancelOrder($tracking_number);

        return response()->json($response);
    }
    public function track(Request $request, Courier $courier) {
        $service = $courier->courier_service;

        $tracking_number = $request->tracking_number ?? "KI7505327195";
        $response = resolve($service)->track($tracking_number);

        return response()->json($response);
    }
}
