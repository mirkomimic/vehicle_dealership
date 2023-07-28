@extends('layouts.app')

@section('content')

@section('styles')
  <link rel="stylesheet" href="../css/skitter.css">
@endsection

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10"> 
      <div class="card">
        <div class="card-header">{{ __('Vehicle') }}</div>
        <div class="card-body">
          {{-- galery --}}
          {{-- https://skitter-slider.net/options.html --}}

          <div class="mb-5 pb-5">
            <div class="skitter skitter-large skitter-themed skitter-clean mx-auto">
              <ul>
                @foreach ($images as $image)
                  <li>
                    <a href="">
                      <img src="{{ asset('storage/images/'.$image->img) }}" class="fade" />
                    </a>
                  </li>                 
                @endforeach
              </ul>
            </div>

          </div>
          <div class="col-md-6">
            {{-- vehicle info --}}
            <ul class="list-group">
              <li class="list-group-item"><span class="fw-bold" style="font-weight: bold">Brand:</span> {{ $vehicle->brandName}}</li>
              <li class="list-group-item"><span class="fw-bold" style="font-weight: bold">Model:</span> {{ $vehicle->model }}</li>
              <li class="list-group-item"><span class="fw-bold" style="font-weight: bold">Price:</span> {{ number_format($vehicle->price, '2', ',', '.') }} &euro;</li>
              <li class="list-group-item"><span class="fw-bold" style="font-weight: bold">Mileage:</span> {{ $vehicle->mileage }}</li>
            </ul>
          </div>
        </div>
      </div>     
    </div>
  </div>
</div>

@section('scripts')
  {{-- <script src="../js/jquery-2.1.1.min.js"></script> --}}
  <script src="../js/jquery.skitter.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script>
    $(document).ready(function () {
      $(".skitter-large").skitter({
        thumbs: true,
        <!-- dots: true, -->
        navigation: true,
        interval: 5000000,
        enable_navigation_keys: true,
        focus: true
      });
    });
  
  </script>
@endsection


@endsection
