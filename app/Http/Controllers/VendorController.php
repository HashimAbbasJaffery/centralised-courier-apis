<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function get() {
        $vendors = \App\Models\Vendor::query()->get();

        return \App\Http\Resources\VendorResource::collection($vendors);
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $vendor = \App\Models\Vendor::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Vendor created successfully', 'vendor' => $vendor], 201);
    }
    public function update(Request $request, $id) {
        $vendor = \App\Models\Vendor::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $vendor->update([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Vendor updated successfully', 'vendor' => $vendor]);
    }
    public function destroy($id) {
        $vendor = \App\Models\Vendor::findOrFail($id);
        $vendor->delete();
        return response()->json(['message'=> '']);
    }
}
