<?php

namespace App\Filters2;

use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class VehicleQuery
{
  protected $query;

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

  public function getQuery()
  {
    return $this->query;
  }
}
