<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function create()
    {
        $brands = Brand::all();
        $years = range(1980, date('Y'));
        return view('vehicles.add', ['brands' => $brands, 'years' => $years]);
    }

    public function show($id)
    {
        $vehicle = Vehicle::query()->where('vehicles.id', '=', $id)
            ->join('models', 'model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
            ->select('vehicles.*', 'models.name as model', 'brands.name as brandName', 'vehicle_types.name as type')
            ->orderBy('vehicles.id', 'ASC')
            ->first();

        $v = Vehicle::find($id);
        $images = $v->images;

        // dd($vehicle);
        return view('vehicles.show', ['vehicle' => $vehicle, 'images' => $images]);
    }
}
