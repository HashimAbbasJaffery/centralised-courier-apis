<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Http\Resources\CitiesResource;
use App\Models\Courier;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourierController extends Controller
{
    public function getCities(Courier $courier) {
        $service = $courier->courier_service;
        $response = resolve($service)->getCities();
        return CitiesResource::collection($response);
    }
    public function createOrder(Request $request, Courier $courier) {

        $service = $courier->courier_service;

        $data = [
            "destination_city" => $request->destination_city,
            "shipment_type" => $request->shipment_type,
            "booked_packet_weight" => $request->booked_packet_weight,
            "booked_packet_no_piece" => $request->booked_packet_no_piece,
            "booked_packet_collect_amount" => $request->booked_packet_collect_amount,
            "order_id" => $request->order_id,
            "consignee_name" => $request->consignee_name,
            "consignee_phone" => $request->consignee_phone,
            "consignee_address" => $request->consignee_address,
            "special_instructions" => $request->special_instructions,
        ];

        $response = resolve($service)->createOrder($data);

        $shipment = Shipment::create([
            "consignee_name" => $request->consignee_name,
            "consignee_phone" => $request->consignee_phone,
            "consignee_address" => $request->consignee_address,
            "destination_city" => $request->destination_city,
            "shipment_type" => $request->shipment_type,
            "division" => $request->division,
            "product_description" => $request->product_description ?? "",
            "weight" => $request->booked_packet_weight,
            "no_of_pieces" => $request->booked_packet_no_piece,
            "cod_amount" => $request->booked_packet_collect_amount,
            "tracking_number" => $response['track_number'] ?? null,
            "special_instructions" => $request->special_instructions ?? "",
            "slip_link" => $response['slip_link'] ?? "",
            "courier_id" => $courier->id,
            "order_id" => $request->order_id,
            "status" => "Pickup Request not Send"
        ]);

        $items = $request->items ?? [];
        foreach ($items as $item) {
            $shipment->items()->create([
                "vendor_id" => $item['vendor_id'],
                "platform_id" => $item['platform_id'],
                "item_name" => $item['item_name'],
                "purchase_cost" => $item['purchase_cost'],
                "item_price" => $item['item_price'],
                "material_id" => $item['material_id'],
                "advance_payment" => $item['advance_payment']
            ]);
        }

        return response()->json($response);
    }
    public function cancelOrder(Request $request, Courier $courier) {
        $service = $courier->courier_service;

        $tracking_number = $request->tracking_number ?? "KI7505327195";
        $response = resolve($service)->cancelOrder($tracking_number);

        $shipment = Shipment::where("tracking_number", $tracking_number)->update([
            "is_cancelled" => true,
            "status" => "Cancelled"
        ]);

        return response()->json($response);
    }
    public function track(Request $request, Courier $courier) {
        $service = $courier->courier_service;

        $tracking_number = $request->tracking_number ?? "KI7505327195";
        $response = resolve($service)->track($tracking_number);

        return response()->json($response);
    }
}
