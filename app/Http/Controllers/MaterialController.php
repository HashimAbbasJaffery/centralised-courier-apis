<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaterialResource;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function get() {
        $materials = Material::query()->get();

        return MaterialResource::collection($materials);
    }
}
