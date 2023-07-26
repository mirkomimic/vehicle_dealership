<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Models;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function models(Request $request, $id)
    {
        $models = Models::query()
            ->whereHas('brand', function ($q) use ($id) {
                $q->where('id', '=', $id);
            })
            ->withCount('vehicles')
            ->having('vehicles_count', '>', 0)
            ->get();

        return response()->json([
            'brandModels' => $models
        ]);
    }
    public function all_models(Request $request, $id)
    {
        $models = Models::query()
            ->whereHas('brand', function ($q) use ($id) {
                $q->where('id', '=', $id);
            })
            ->withCount('vehicles')
            ->get();

        return response()->json([
            'brandModels' => $models
        ]);
    }
}
