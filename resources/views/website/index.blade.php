@extends('website.layouts.layout')
@section('content')
@section('title', 'MlE3bna')
<section class="home" id="home">
    <div class="content bg-light rounded-3  text-center">
        <div class="search-content">
            <h3>welcome to <span style="color:#85c240">MlE3bna</span></h3>

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
                                    <option value="" selected>Select Region</option>
                                    @foreach ($regions as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
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

    <div class="video-container">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('website/Images/landing5.jpeg') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('website/Images/landing3.jpeg') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('website/Images/landing2.jpeg') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('website/Images/landing4.jpeg') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('website/Images/landing1.jpeg') }}" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('website/Images/landing6.jpeg') }}" alt="">
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

</section>

<section class="packages" id="packages">
    <h1 class="heading">
        <span>S</span>
        <span>t</span>
        <span>a</span>
        <span>d</span>
        <span>i</span>
        <span>u</span>
        <span>m</span>
        <span>s</span>
    </h1>

    <div class="box-container row">
        @foreach ($stadiums as $stadium)
            <div class="box col-md-3">

                <img decoding="async"
                    @if (count($stadium->stadium_image)) src="{{ asset('uploads/stadium/' . $stadium->stadium_image[0]->image) }}"
                    @else
                    src="{{ asset('website/Images/Default_Image.png') }}" style="object-fit:contain" @endif
                    alt="No Image">

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
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="price"> {{ $stadium->price }} LB</div>
                        </div>
                        <div class="col-md-3">
                            <div class="price"> {{ $stadium->price_in_dolar }} $</div>
                            
                        </div>
    
                    </div>
                    

                    <a href="{{ route('web.stadium', $stadium->id) }}" class="btn">Book Now</a>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="services" id="services">
    <h1 class="heading">
        <span>s</span>
        <span>e</span>
        <span>r</span>
        <span>v</span>
        <span>i</span>
        <span>c</span>
        <span>e</span>
        <span>s</span>
    </h1>

    <div class="box-container">
        <div class="box">
            <i class="fas fa-hotel"></i>
            <h3>affordable hotels</h3>
            <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry</p>
        </div>
        <div class="box">
            <i class="fas fa-utensils"></i>
            <h3>food and drinks</h3>
            <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry</p>
        </div>
        <div class="box">
            <i class="fas fa-bullhorn"></i>
            <h3>safty guide</h3>
            <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry</p>
        </div>
        <div class="box">
            <i class="fas fa-globe-asia"></i>
            <h3>around the world</h3>
            <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry</p>
        </div>
        <div class="box">
            <i class="fas fa-plane"></i>
            <h3>fastest travel</h3>
            <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry</p>
        </div>
    </div>
</section>


@stop()
