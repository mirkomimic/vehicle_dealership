<?php

namespace App\Filters;

use App\Models\Vehicle;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleFilters extends QueryFilters
{
  protected $request;

  public function __construct(Request $request)
  {
    $this->request = $request;
    // parent::__construct($request);
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

  public function keyword($keyword)
  {
    return $this->builder
      ->where('models.name', 'LIKE', "%" . $keyword . "%")
      ->orWhere('vehicle_types.name', 'LIKE', "%" . $keyword . "%")
      ->orWhere('brands.name', 'LIKE', "%" . $keyword . "%");
  }
}
