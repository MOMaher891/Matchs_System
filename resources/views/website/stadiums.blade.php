@extends('website.layouts.layout')
@section('title', 'Stadiums')
@section('content')

<section class="m-auto">
    
    <div class="box-container row"  style="margin-top:100px">
        @foreach ($data as $stadium)
        <div class="col-md-4 mb-4">
            <div class="card h-100" >
                <img decoding="async" class="card-img-top rounded " height="200px" src="  {{ asset('uploads/stadium/' . $stadium->stadium_image[0]->image) }}"
                    alt="">
                <div class="card-body">
                    <div class="content">
                        <h3 class="mb-3">{{ $stadium->name }} </h3>
                        <h3><i class="fas fa-map-marker-alt"></i> {{ $stadium->region->name }}
                            - {{ $stadium->region->city->name }} </h3>
                        <a target="_blank"
                            href="https://wa.me/{{ $stadium->phone }}?text=Hello,%20about {{ $stadium->name }}%20Stadium%20:%20"
                            class="text-decoration-none">
                            <p style="color:#85c240;font-weight:bolder">{{ $stadium->phone }}</p>
                        </a>
                        <p>{!! $stadium->description !!}</p>
                        <div class="stars">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                        </div>
                        <div class="price"> ${{ $stadium->price }}</div>
                        @if (!Auth::guard('client')->check())
                            <a title="Login In First" class="btn unAuth">Book Now</a>
                        @else
                            <a href="{{ route('web.stadium', $stadium->id) }}" class="btn">Book Now</a>
                        @endif
                    </div>
                </div>
              </div>
        </div>
        @endforeach
    </div>
    {{ $data->onEachSide(3)->links('pagination::bootstrap-4') }}
</section>
@endsection
