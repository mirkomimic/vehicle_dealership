<?php

namespace App\Models\Filters;

use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiclesFilter
{
  private $query;

  public function __construct()
  {
    $this->query = Vehicle::select('vehicles.*', DB::raw('(
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
      ->join('vehicle_types', 'models.vehicle_type_id', '=', 'vehicle_types.id');
  }

  public function filterByModel(Request $request)
  {
    $this->query->whereIn('models.id', $request->modelsIds);
  }

  public function searchByKeyword(Request $request)
  {
    $this->query
      ->where(function ($q) use ($request) {
        $q->where('models.name', 'LIKE', "%" . $request->keyword . "%");
        $q->orWhere('vehicle_types.name', 'LIKE', "%" . $request->keyword . "%");
        $q->orWhere('brands.name', 'LIKE', "%" . $request->keyword . "%");
      });
    // ->where('models.name', 'LIKE', "%" . $request->keyword . "%")
    // ->orWhere('vehicle_types.name', 'LIKE', "%" . $request->keyword . "%")
    // ->orWhere('brands.name', 'LIKE', "%" . $request->keyword . "%");
  }


  public function minMaxPrice(Request $request)
  {
    $this->query->where('vehicles.price', '>=', $request->priceMin ?? 0);
    $this->query->where('vehicles.price', '<=', $request->priceMax ?? 9999999);
  }

  public function minMaxYear(Request $request)
  {
    $this->query->where('vehicles.year', '>=', $request->yearMin ?? 0);
    $this->query->where('vehicles.year', '<=', $request->yearMax ?? 3000);
  }

  // sort = priceAsc
  public function sort(Request $request)
  {
    switch ($request->sort) {
      case "priceAsc":
        $this->query->orderBy('vehicles.price', 'asc');
        break;
      case "priceDesc":
        $this->query->orderBy('vehicles.price', 'desc');
        break;
      case "createdAsc":
        $this->query->orderBy('vehicles.created_at', 'asc');
        break;
      case "createdDesc":
        $this->query->orderBy('vehicles.created_at', 'desc');
        break;
      default:
        $this->query->orderBy('vehicles.id', 'asc');
    }

    // return $this->query;
  }

  public function filtering(Request $request)
  {
    if (isset($request->modelsIds) && !empty($request->modelsIds)) {
      $this->filterByModel($request);
    }
    if (isset($request->keyword) && $request->keyword != null) {
      $this->searchByKeyword($request);
    }
    if (isset($request->priceMin) || isset($request->priceMax)) {
      $this->minMaxPrice($request);
    }
    if (isset($request->yearMin) || isset($request->yearMax)) {
      $this->minMaxYear($request);
    }
    $this->sort($request);

    return $this->query;
  }

  public static function filter(Request $request)
  {
    return (new self)->filtering($request);
  }
}
