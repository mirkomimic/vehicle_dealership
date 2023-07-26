@extends('layouts.app')

@section('content')

  {{-- jquery multiselect --}}
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">{{ __('Add Vehicle') }}</div>
            <div class="p-3">
              {{-- https://www.cssscript.com/single-multi-select-vanilla/ --}}
              <select id="brand" form="add_vehicle_form">
                @foreach ($brands as $brand)
                  <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
              </select>          
            </div>
            <div class="p-3">
              <select id="model" form="add_vehicle_form">
              </select>          
            </div>
            <div class="p-3">
              <input type="number" name="price" id="price" placeholder="Price" class="form-control w-50">
            </div>
            <div class="p-3">
              <select name="year" id="year" class="form-select w-50">
                <option name="" id="" disabled selected>Select Year</option>
                @foreach ($years as $year)
                  <option value="{{ $year }} ">{{ $year }}</option>
                @endforeach
              </select>
            </div>
            <div class="p-3">
              <input type="number" name="mileage" id="mileage" placeholder="Mileage" class="form-control w-50">
            </div>

            <div class="p-3">
              <div class="col-md-6">
                <form action="" method="" id="add_vehicle_form">
                  @csrf
                  <input type="submit" value="Add" class="btn btn-success w-50" id="add_vehicle_btn">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@section('scripts')
  <script src="js/add_vehicle.js" type="text/javascript"></script>
@endsection


@endsection
