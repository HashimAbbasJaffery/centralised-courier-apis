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
        $status = $request->status ?? null;
        $origin_city = $request->origin_city ?? null;

        $shipments = Shipment::query()
                            ->when($destination_city, function ($query) use ($destination_city) {
                                return $query->where('destination_city', $destination_city);
                            })
                            ->when($origin_city, function ($query) use ($origin_city) {
                                return $query->where('origin_city', $origin_city);
                            })
                            ->when($status, function ($query) use ($status) {
                                return $query->where('status', $status);
                            })
                            ->when($date_from, function($query) use($date_from) {
                                return $query->where('created_at', ">=", $date_from);
                            })
                            ->when($date_to, function($query) use($date_to) {
                                return $query->where('created_at', '<=', $date_to);
                            })
                            ->latest()
                            ->get();

        return response()->json(["data" => $shipments]);
    }
}
