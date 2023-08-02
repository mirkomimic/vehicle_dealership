<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Comment;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function create()
    {
        $brands = Brand::all();
        $years = range(1980, date('Y'));
        return view('vehicles.add', ['brands' => $brands, 'years' => $years]);
    }

    // public function show2($id)
    // {
    //     $vehicle = Vehicle::query()->where('vehicles.id', '=', $id)
    //         ->join('models', 'model_id', '=', 'models.id')
    //         ->join('brands', 'models.brand_id', '=', 'brands.id')
    //         ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
    //         ->select('vehicles.*', 'models.name as model', 'brands.name as brandName', 'vehicle_types.name as type')
    //         ->orderBy('vehicles.id', 'ASC')
    //         ->first();

    //     $v = Vehicle::find($id);
    //     $images = $v->images;

    //     $comments = $v->comments;

    //     // dd($vehicle);
    //     return view('vehicles.show', ['vehicle' => $vehicle, 'images' => $images, 'comments' => $comments]);
    // }

    public function show($id)
    {
        $vehicle = Vehicle::query()->where('vehicles.id', '=', $id)
            ->join('models', 'model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id')
            ->select('vehicles.*', 'models.name as model', 'brands.name as brandName', 'vehicle_types.name as type')
            ->orderBy('vehicles.id', 'ASC')
            ->first();

        $comments = Comment::query()
            ->whereNull('parent_id')
            ->where('comments.vehicle_id', $id)
            ->with('user')
            ->with('replies')
            ->orderBy('comments.created_at', 'desc')
            ->get();

        return view('vehicles.show', ['vehicle' => $vehicle, 'comments' => $comments]);
    }
}
