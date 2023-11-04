<?php

namespace App\Filters3;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleFilter
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

  public static function getQuery()
  {
    return (new self)->query;
  }

  public function keyword($keyword)
  {
    $this->query
      ->where(function ($q) use ($keyword) {
        $q->where('models.name', 'LIKE', "%" . $keyword . "%");
        $q->orWhere('vehicle_types.name', 'LIKE', "%" . $keyword . "%");
        $q->orWhere('brands.name', 'LIKE', "%" . $keyword . "%");
      });
  }

  public function priceMin($priceMin)
  {
    $this->query->where('vehicles.price', '>=', $priceMin ?? 0);
  }
  public function priceMax($priceMax)
  {
    $this->query->where('vehicles.price', '<=', $priceMax ?? 9999999);
  }

  public function yearMin($yearMin)
  {
    $this->query->where('vehicles.year', '>=', $yearMin ?? 0);
  }
  public function yearMax($yearMax)
  {
    $this->query->where('vehicles.year', '<=', $yearMax ?? 3000);
  }

  public function modelsIds($modelsIds)
  {
    $this->query->whereIn('models.id', $modelsIds);
  }

  // sort = priceAsc
  public function sort($sort)
  {
    switch ($sort) {
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

  public function apply(Request $request)
  {
    foreach ($this->filters($request) as $name => $value) {
      if (!method_exists($this, $name)) {
        continue;
      }
      call_user_func(array($this, $name), $value);
    }
    return $this->query;
  }

  public static function filter(Request $request)
  {
    return (new self)->apply($request);
  }

  private function filters(Request $request)
  {
    return $request->all();
  }
}
