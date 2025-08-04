<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function get() {
        $vendors = \App\Models\Vendor::query()->get();

        return \App\Http\Resources\VendorResource::collection($vendors);
    }
}
