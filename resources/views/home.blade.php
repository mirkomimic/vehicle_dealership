@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10">
        <div class="col-md-6">
            <a href="/add_vehicle" class="btn btn-warning w-50">Add New Vehicle</a>
        </div>
      </div>
    </div>
</div>

  {{-- jquery multiselect --}}
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">{{ __('Filter') }}</div>
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
            <div class="p-3">
              <div class="col-md-6">
                <form action="" method="" id="filter">
                  @csrf
                  <input type="submit" value="Find" class="btn btn-success w-50" id="filterBtn">
                </form>
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
@endsection

@endsection
