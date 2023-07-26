<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $brands = Brand::all();

        $vehicles = Vehicle::query()
            ->join('models', 'model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
            ->select('vehicles.id', 'models.name as modelName', 'vehicles.price', 'vehicles.year', 'vehicles.mileage', 'brands.name as brandName', 'vehicle_types.name as typeName')
            ->orderBy('vehicles.id', 'ASC')
            ->paginate(5);

        return view('home', ['vehicles' => $vehicles, 'brands' => $brands]);
    }

    public function search(Request $request)
    {
        $brands = Brand::all();
        if (empty($request->modelsIds)) {
            $vehicles = Vehicle::query()
                ->join('models', 'model_id', '=', 'models.id')
                // ->whereIn('models.id', $request->modelsIds)
                ->join('brands', 'models.brand_id', '=', 'brands.id')
                ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
                ->select('vehicles.id', 'models.name as modelName', 'vehicles.price', 'vehicles.year', 'vehicles.mileage', 'brands.name as brandName', 'vehicle_types.name as typeName')
                ->orderBy('vehicles.id', 'ASC')
                ->paginate(5);
        } else {
            $vehicles = Vehicle::query()
                ->join('models', 'model_id', '=', 'models.id')
                ->whereIn('models.id', $request->modelsIds)
                ->join('brands', 'models.brand_id', '=', 'brands.id')
                ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
                ->select('vehicles.id', 'models.name as modelName', 'vehicles.price', 'vehicles.year', 'vehicles.mileage', 'brands.name as brandName', 'vehicle_types.name as typeName')
                ->orderBy('vehicles.id', 'ASC')
                ->paginate(5);
        }

        return view('vehicles.index', ['vehicles' => $vehicles, 'brands' => $brands]);
    }
}
