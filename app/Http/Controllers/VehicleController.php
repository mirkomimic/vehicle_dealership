<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function show()
    {
        $brands = Brand::all();
        $years = range(1980, date('Y'));
        return view('vehicles.add', ['brands' => $brands, 'years' => $years]);
    }
}
