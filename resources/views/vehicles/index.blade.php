

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12 col-md-12">

      <div class="card" id="vehicles_section">
          <div class="card-header">{{ __('Vehicles') }}</div>
            <div class="card-body">
              <!-- Vehicle Card -->
              <div class="row" id="ads">
                @forelse ($vehicles as $vehicle)
                  <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card rounded">
                      <div class="card-image text-center">
                        <span class="card-notify-badge">{{ $vehicle->brandName }}</span>
                        <span class="card-notify-year">{{ $vehicle->year }}</span>
                        @if ($vehicle->image)
                          <img class="img-fluid" src="{{ asset('storage/images/'. $vehicle->image) }}" alt="Alternate Text" />
                        @else
                          <img class="img-fluid" src="https://imageonthefly.autodatadirect.com/images/?USER=eDealer&PW=edealer872&IMG=USC80HOC011A021001.jpg&width=440&height=262" alt="Alternate Text" />
                        @endif
                      </div>
                      <div class="card-image-overlay m-auto mt-2">
                        <span class="card-detail-badge">{{ $vehicle->typeName }}</span>
                        <span class="card-detail-badge">{{ number_format($vehicle->price, '2', ',', '.') }}	&euro;</span>
                        <span class="card-detail-badge">{{ $vehicle->mileage }} Kms</span>
                      </div>
                      <div class="card-body text-center">
                        <div class="ad-title m-auto">
                            <h5>{{ $vehicle->brandName . ' ' . $vehicle->modelName }}</h5>
                        </div>
                        <a class="ad-btn" href="{{ url('vehicle/'. $vehicle->id) }}">View</a>
                      </div>
                    </div>
                  </div>
                @empty
                  <p>No Vehicles Found!</p>
                @endforelse
                
                {!!  $vehicles->withQueryString()->links('vendor.pagination.custom') !!}                      
  
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
