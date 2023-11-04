<?php

namespace App\Http\Controllers;

use App\Filters3\VehicleFilter;
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

        $vehicles = VehicleFilter::getQuery()->orderBy('vehicles.created_at', 'desc')->take(5)->get();

        return view('home', ['vehicles' => $vehicles, 'brands' => $brands]);
        // return view('vehicles.index', ['vehicles' => $vehicles, 'brands' => $brands]);
    }

    public function search(Request $request)
    {
        $brands = Brand::all();

        // $vehicles = VehiclesFilter::filter($request)->paginate(6);

        // Filter3
        $vehicles = VehicleFilter::filter($request)->paginate(6);

        return view('vehicles.index', ['vehicles' => $vehicles, 'brands' => $brands]);
    }
}
