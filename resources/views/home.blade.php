@extends('layouts.app')

@section('content')

@section('styles')
<link rel="stylesheet" href="../css/vanillaSelectBox.css">
<link rel="stylesheet" href="../css/product_card.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/custom_pagination.css">

@endsection

<div class="container">
  <div class="row justify-content-center mb-3">
    <div class="col-12 col-md-8">
      <div class="col-md-6">
          <a href="/add_vehicle" class="btn btn-warning ">Add New Vehicle</a>
      </div>
    </div>
  </div>


  {{-- jquery multiselect --}}
  <div class="row justify-content-center mb-3">
    <div class="col-12 col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Filter') }}</div>
          <div class="row">
            <div class="col-12 col-lg-6">
              <div class="p-3">
                {{-- https://www.cssscript.com/single-multi-select-vanilla/ --}}
                <select id="brand" form="filter">
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>          
              </div>
              <div class="p-3">
                <select id="model" form="filter" multiple>
                </select>          
              </div>
            </div>
            {{-- search keyword --}}
            <div class="col-12 col-lg-6">
              <div class="p-3">
                <input class="form-control" type="text" name="keyword" id="keyword" form="filter" placeholder="Search">
              </div>
            </div>
          </div>
          <div class="p-3">
            <div class="col-md-6">
              <form action="" method="" id="filter">
                @csrf
                <input type="submit" value="Find" class="btn btn-success w-50" id="filterBtn">
              </form>
            </div>
          </div>
          {{-- more filters --}}
          <div class="ps-3">
            <div class="col-md-6">
              <p>
                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  More Filter Options
                </button>
              </p>
              <div class="collapse" id="collapseExample">
                <div class="mb-3">
                  <div class="d-flex mb-2">
                    <input class="form-control inline" type="number" name="priceMin" id="priceMin" placeholder="Min Price" form="filter">
                    <input class="form-control inline" type="number" name="priceMax" id="priceMax" placeholder="Max Price" form="filter">
                  </div>
                  <div class="d-flex">
                    <input class="form-control inline" type="number" name="yearMin" id="yearMin" placeholder="Min Year" form="filter">
                    <input class="form-control inline" type="number" name="yearMax" id="yearMax" placeholder="Max Year" form="filter">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="vehiclesTable">
    @include('vehicles.index')
</div>

@section('scripts')
  <script src="js/script.js" type="text/javascript"></script>
  <script src="js/vanillaSelectBox.js" typse="text/javascript"></script>

@endsection

@endsection
