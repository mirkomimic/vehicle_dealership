<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $vehicle = new Vehicle();
            $vehicle->model_id = $request->model;
            $vehicle->price = $request->price;
            $vehicle->year = $request->year;
            $vehicle->mileage = $request->mileage;
            $vehicle->save();

            if ($request->hasFile('vehicleImg')) {
                foreach ($request->vehicleImg as $img) {
                    $image = new VehicleImg();
                    $image->vehicle_id = $vehicle->id;
                    $img->store('images', 'public');
                    $image->img = $img->hashName();
                    $image->save();
                }
            }
        });
        return response()->json([
            'msg' => 'success'
        ]);
    }
}
