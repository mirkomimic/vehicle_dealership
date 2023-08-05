<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Filters\VehiclesFilter;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // $vehicles = Vehicle::select('vehicles.*', DB::raw('(
        //     SELECT
        //         img
        //     FROM
        //         vehicle_imgs i
        //     WHERE
        //         vehicles.id = i.vehicle_id
        //     LIMIT 1
        // ) AS image'), 'models.name as modelName', 'vehicle_types.name as typeName', 'brands.name as brandName')
        //     ->join('models', 'model_id', '=', 'models.id')
        //     ->join('brands', 'models.brand_id', '=', 'brands.id')
        //     ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
        //     ->orderBy('vehicles.id', 'ASC')
        //     ->paginate(6);

        $vehicles = VehiclesFilter::filter($request)->paginate(6);

        return view('home', ['vehicles' => $vehicles, 'brands' => $brands]);
    }

    public function test(Request $request)
    {
        $brands = Brand::all();

        $vehicles = Vehicle::select('vehicles.*', DB::raw('(
            SELECT
                img
            FROM
                vehicle_imgs i
            WHERE
                vehicles.id = i.vehicle_id
            LIMIT 1
        ) AS image'), 'models.name as modelName', 'vehicle_types.name as typeName', 'brands.name as brandName')
            ->join('models', 'model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
            ->orderBy('vehicles.id', 'ASC')
            ->paginate(5);


        dd($vehicles);
    }

    public function search(Request $request)
    {
        $brands = Brand::all();

        // if (empty($request->modelsIds)) {
        //     $vehicles = Vehicle::select('vehicles.*', DB::raw('(
        //         SELECT
        //             img
        //         FROM
        //             vehicle_imgs i
        //         WHERE
        //             vehicles.id = i.vehicle_id
        //         LIMIT 1
        //     ) AS image'), 'models.name as modelName', 'vehicle_types.name as typeName', 'brands.name as brandName')
        //         ->join('models', 'model_id', '=', 'models.id')
        //         ->join('brands', 'models.brand_id', '=', 'brands.id')
        //         ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
        //         ->orderBy('vehicles.id', 'ASC')
        //         ->paginate(6);
        // } else {
        //     $vehicles = Vehicle::select('vehicles.*', DB::raw('(
        //         SELECT
        //             img
        //         FROM
        //             vehicle_imgs i
        //         WHERE
        //             vehicles.id = i.vehicle_id
        //         LIMIT 1
        //     ) AS image'), 'models.name as modelName', 'vehicle_types.name as typeName', 'brands.name as brandName')
        //         ->join('models', 'model_id', '=', 'models.id')
        //         ->whereIn('models.id', $request->modelsIds)
        //         ->join('brands', 'models.brand_id', '=', 'brands.id')
        //         ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
        //         ->orderBy('vehicles.id', 'ASC')
        //         ->paginate(6);
        // }

        $vehicles = VehiclesFilter::filter($request)->paginate(6);

        return view('vehicles.index', ['vehicles' => $vehicles, 'brands' => $brands]);
    }

    public function searchFilterSort(Request $request)
    {
        $vehicles = Vehicle::all();
        // $vehicles = VehicleFilter::filter($vehicles, 6);
    }
}
