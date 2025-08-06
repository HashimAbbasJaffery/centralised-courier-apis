<?php

use App\Models\Shipment;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function() {

    $shipments = Shipment::where("is_cancelled", 0)->get();

    foreach($shipments as $shipment) {
        $response = Http::get(route("order.track", [
            "courier" => $shipment->courier->courier_service,
            "tracking_number" => $shipment->tracking_number
        ]));

        if ($response->successful()) {
            $data = $response->json();

            // Safely access booked_packet_status from the first packet
            $bookedPacketStatus = $data['packet_list'][0]['booked_packet_status'] ?? null;

            $shipment->update([
                "status" => $bookedPacketStatus,
            ]);

            $shipment->save();
        } else {
            \Log::error("Failed to fetch tracking info: " . $response->body());
        }

        Log::info($response);
    }

})->everyMinute();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
