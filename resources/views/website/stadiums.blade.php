@extends('website.layouts.layout')
@section('title', 'Stadiums')
@section('content')

    <section class="m-auto">
        <div class="header text-center mb-3" style="margin-top:100px">
            <h1 style="font-size: 40px"><span style="color: #85c240">All </span>Stadiums</h1>
        </div>

        <div class="content text-center mb-5">
            <div class="search-content">
                <form action="{{ route('stadiums') }}" method="GET" class="mt-3" novalidate="novalidate">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-12 p-0 mb-3">
                                    <input type="date" class="form-control search-slt" name="date"
                                        placeholder="Enter Date">
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12 p-0 mb-3">

                                    {{-- <input type="time" class="form-control search-slt" name="time_from" placeholder="Enter Time"> --}}
                                    <select name="time_from" class="search-slt form-control" id="">
                                        <option selected>Select Time From</option>
                                        @foreach ($times as $time)
                                            <option value="{{ $time->id }}">{{ $time->from }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12 p-0 mb-3">
                                    <select name="time_to" class="search-slt" id="">
                                        <option value="" selected>Select Time To</option>
                                        @foreach ($times as $time)
                                            <option value="{{ $time->id }}">{{ $time->to }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 p-0 mb-3">

                                    <select class="form-select search-slt" name="region" id="exampleFormControlSelect1">
                                        @foreach ($regions as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-1 col-md-3 col-sm-12">
                                    <button type="submit" class="btn btn-primary ">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>

        <div class="box-container row">

            @foreach ($data as $stadium)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img decoding="async" class="card-img-top rounded " height="200px"
                            src="  {{ asset('uploads/stadium/' . $stadium->stadium_image[0]->image) }}" alt="">
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
                                <a href="{{ route('web.stadium', $stadium->id) }}" class="btn">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $data->onEachSide(3)->links('pagination::bootstrap-4', ['class' => 'text-success']) }}
    </section>
@endsection
