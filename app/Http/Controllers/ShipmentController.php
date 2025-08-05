<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index(Request $request) {
        $destination_city = $request->destination_city ?? null;
        $date_from = $request->date_from ?? null;
        $date_to = $request->date_to ?? null;

        $shipments = Shipment::query()
                            ->when($destination_city, function ($query) use ($destination_city) {
                                return $query->where('destination_city', $destination_city);
                            })
                            ->when($date_from, function($query) use($date_from) {
                                return $query->where('created_at', ">=", $date_from);
                            })
                            ->when($date_to, function($query) use($date_to) {
                                return $query->where('created_at', '<=', $date_to);
                            })
                            ->get();

        return response()->json(["data" => $shipments]);
    }
}
