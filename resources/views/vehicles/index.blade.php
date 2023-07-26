
{{-- tabela --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table style="width: 100%;" class="table table-stripped">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Brand</th>
                              <th>Model</th>
                              <th>Type</th>
                              <th>Price</th>
                              <th>Year</th>
                              <th>Mileage</th>
                            </tr>
                          </thead>
                          <tbody>                            
                            @forelse ($vehicles as $vehicle)
                            <tr>
                              <td>{{ $vehicle->id }}</td>
                              <td>{{ $vehicle->brandName}}</td>
                              <td>{{ $vehicle->modelName }}</td>
                              <td>{{ $vehicle->typeName }}</td>
                              <td>{{ $vehicle->price }}</td>
                              <td>{{ $vehicle->year }}</td>
                              <td>{{ $vehicle->mileage }}</td>
                            </tr>       
                            @empty        
                            <tr>
                              <td colspan="6">No vehicles found</td>
                            </tr>
                            @endforelse
                          </tbody>
                        </table>
                        
                        {!!  $vehicles->withQueryString()->links() !!}
                        
                      </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
