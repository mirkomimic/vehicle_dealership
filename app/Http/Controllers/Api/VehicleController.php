<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function store(Request $request)
    {
        $vehicle = new Vehicle();
        $vehicle->model_id = $request->model_id;
        $vehicle->price = $request->price;
        $vehicle->year = $request->year;
        $vehicle->mileage = $request->mileage;
        $vehicle->save();

        return response()->json([
            'msg' => 'success'
        ]);
    }
}
