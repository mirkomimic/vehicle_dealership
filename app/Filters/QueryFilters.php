<?php

namespace App\Filters;

use App\Models\Vehicle;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryFilters
{
  protected $request;
  protected $builder;
  protected $query;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function apply()
  {
    $this->builder = $this->query;

    foreach ($this->filters() as $name => $value) {
      if (!method_exists($this, $name)) {
        continue;
      }

      // call_user_func('keyword', $value);
      if (strlen($value)) {
        $this->$name($value);
      } else {
        $this->$name();
      }
    }

    return $this->builder;
  }

  public function filters()
  {
    return $this->request->all();
  }
}
