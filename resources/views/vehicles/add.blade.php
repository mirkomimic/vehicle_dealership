@extends('layouts.app')

@section('content')

  @section('styles')
    <link rel="stylesheet" href="css/addVehicle.css">
  @endsection

  {{-- alert --}}
  <div class="container">
    <div class="loader position-absolute top-50 start-50"></div>
    <div class="row justify-content-center position-absolute top-0 end-0 z-1" style="width: 400px; margin-top: 55px">
      <div id="alert" class="d-none">
        <div class="alert alert-success alert-dismissible fade show d-flex" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
          <div id="alertMsg"></div>
          <div class="ms-auto">
            <button type="button" class="btn-close ms-3" aria-label="Close" data-bs-dismiss="alert"></button>
          </div>
        </div>
      </div>
    </div>
  
    {{-- form --}}
    <div class="row justify-content-center mb-3">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header d-flex">{{ __('Add Vehicle') }}        
          </div>

            <div class="p-3">
              {{-- https://www.cssscript.com/single-multi-select-vanilla/ --}}
              <select id="brand" form="add_vehicle_form" form="add_vehicle_form">
                @foreach ($brands as $brand)
                  <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
              </select>          
            </div>
            <div class="p-3">
              <select id="model" form="add_vehicle_form" name="model">
              </select>          
            </div>
            <hr class="m-2">
            <div class="p-3">
              <input type="number" name="price" id="price" placeholder="Price" class="form-control w-50" form="add_vehicle_form">
            </div>
            <div class="p-3">
              <select name="year" id="year" class="form-select w-50" form="add_vehicle_form">
                <option name="" id="" disabled selected>Select Year</option>
                @foreach ($years as $year)
                  <option value="{{ $year }} ">{{ $year }}</option>
                @endforeach
              </select>
            </div>
            <div class="p-3">
              <input type="number" name="mileage" id="mileage" placeholder="Mileage" class="form-control w-50" form="add_vehicle_form">
            </div>
            <div class="p-3">
              <input class="form-control w-50" type="file" name="vehicleImg[]" form="add_vehicle_form" multiple>
            </div>

            <div class="p-3">
              <div class="col-md-6">
                <form action="" method="" id="add_vehicle_form" enctype="multipart/form-data" >
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
