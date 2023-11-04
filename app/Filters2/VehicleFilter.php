<?php

namespace App\Filters2;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleFilter
{
  // public VehicleQuery $vehicleQuery;
  protected $request;
  protected $query;

  public function __construct(VehicleQuery $vehicleQuery)
  {
    // var_dump($query->getQuery());
    // $this->query = $query->getQuery();
    // $this->request = $request;
    $this->query = $vehicleQuery->getQuery();
  }

  // public function setQuery(VehicleQuery $vehicleQuery)
  // {
  //   return $this->query = $vehicleQuery->getQuery();
  // }

  public function keyword($keyword)
  {
    return $this->query
      ->where('models.name', 'LIKE', "%" . $keyword . "%")
      ->orWhere('vehicle_types.name', 'LIKE', "%" . $keyword . "%")
      ->orWhere('brands.name', 'LIKE', "%" . $keyword . "%");
  }

  public function apply(Request $request)
  {
    // $this->query = (new VehicleQuery)->getQuery();

    foreach ($this->filters($request) as $name => $value) {
      if (!method_exists($this, $name)) {
        continue;
      }
      call_user_func(array($this, $name), $value);
    }
    return $this->query;
  }

  public function filter(Request $request)
  {
    return $this->apply($request);
  }

  private function filters(Request $request)
  {
    return $request->all();
  }
}
