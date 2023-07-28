<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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

        // $vehicles = Vehicle::query()
        //     ->leftJoin('models', 'model_id', '=', 'models.id')
        //     ->leftJoin('brands', 'models.brand_id', '=', 'brands.id')
        //     ->leftJoin('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
        //     ->leftJoin('vehicle_imgs', function ($q) {
        //         $q->on('vehicles.id', '=', 'vehicle_imgs.vehicle_id')->limit(1);
        //     })
        //     ->distinct('id')
        //     ->select('vehicles.id', 'models.name as modelName', 'vehicles.price', 'vehicles.year', 'vehicles.mileage', 'brands.name as brandName', 'vehicle_types.name as typeName', 'vehicle_imgs.img as image')
        //     ->orderBy('vehicles.id', 'ASC')
        //     ->get();

        // ->paginate(5);
        // dd($vehicles);

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
            ->paginate(6);

        return view('home', ['vehicles' => $vehicles, 'brands' => $brands]);
    }

    public function test(Request $request)
    {
        $brands = Brand::all();

        // $vehicles = Vehicle::query()
        //     ->leftJoin('vehicle_imgs', function ($q) {
        //         $q->on('vehicles.id', '=', 'vehicle_imgs.vehicle_id')->limit(1);
        //     })
        //     ->select('vehicles.id', 'vehicles.price', 'vehicles.year', 'vehicles.mileage', 'vehicle_imgs.img as image')
        //     ->orderBy('vehicles.id', 'ASC')
        //     ->distinct('vehicles')
        //     ->get();
        // ->paginate(5);

        // $vehicles = Vehicle::select('vehicles.id', 'vehicle_imgs.img')
        //     ->leftJoin('vehicle_imgs', function ($join) {
        //         $join->on('vehicles.id', '=', 'vehicle_imgs.vehicle_id')
        //             ->limit(1);
        //     })
        //     ->distinct('vehicles.id')
        //     ->orderBy('vehicles.id', 'ASC')
        //     ->get();

        // ->join('models', 'model_id', '=', 'models.id')
        // ->join('brands', 'models.brand_id', '=', 'brands.id')
        // ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')

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
        // dd(Vehicle::all());
    }

    public function search(Request $request)
    {
        $brands = Brand::all();

        // if (empty($request->modelsIds)) {
        //     $vehicles = Vehicle::query()
        //         ->join('models', 'model_id', '=', 'models.id')
        //         // ->whereIn('models.id', $request->modelsIds)
        //         ->join('brands', 'models.brand_id', '=', 'brands.id')
        //         ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
        //         ->select('vehicles.id', 'models.name as modelName', 'vehicles.price', 'vehicles.year', 'vehicles.mileage', 'brands.name as brandName', 'vehicle_types.name as typeName')
        //         ->orderBy('vehicles.id', 'ASC')
        //         ->paginate(5);
        // } else {
        //     $vehicles = Vehicle::query()
        //         ->join('models', 'model_id', '=', 'models.id')
        //         ->whereIn('models.id', $request->modelsIds)
        //         ->join('brands', 'models.brand_id', '=', 'brands.id')
        //         ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
        //         ->select('vehicles.id', 'models.name as modelName', 'vehicles.price', 'vehicles.year', 'vehicles.mileage', 'brands.name as brandName', 'vehicle_types.name as typeName')
        //         ->orderBy('vehicles.id', 'ASC')
        //         ->paginate(5);
        // }

        if (empty($request->modelsIds)) {
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
                ->paginate(6);
        } else {
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
                ->whereIn('models.id', $request->modelsIds)
                ->join('brands', 'models.brand_id', '=', 'brands.id')
                ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
                ->orderBy('vehicles.id', 'ASC')
                ->paginate(6);
        }


        return view('vehicles.index', ['vehicles' => $vehicles, 'brands' => $brands]);
    }
}
