@extends('superadmin.layouts.app')
@section('title', 'Show Stadium')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <div class="row">
                    <div class="col-md-3">
                        <h2 class="card-title"> Stadium : <span class="text-gray"
                                style="font-weight:normal">{{ $data->name }} </span></h2>
                        <h2 class="card-title">Owner : <span class="text-gray"
                                style="font-weight:normal">{{ $data->admin->name }}</span></h2>
                    </div>
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-3">
                        <h2 class="card-title">Phone : <span class="text-gray"
                                style="font-weight:normal">{{ $data->phone }} </span></h2>
                    </div>
                    <div class="col-md-3">
                        <h2 class="card-title text-success">Price : {{ $data->price }}.LE </h2>
                    </div>

                </div>

                <div class="row">


                    <div class="col-md-6 my-4">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach ($images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('uploads/stadium/' . $image->image) }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                </div>

                <h3 class="card-title">Stadium Location</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div id="map" style="height:400px; width: 650px;" class="my-3" disabled></div>
                    </div>
                </div>

            </div>
        </div>


    @stop
    @section('js')
        {{-- Get Long and lat from map --}}
        <script>
            let map;

            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat: {{ $data->lat }},
                        lng: {{ $data->long }}
                    },
                    zoom: 8,
                    scrollwheel: true,
                });

                const uluru = {
                    lat: {{ $data->lat }},
                    lng: {{ $data->long }}
                };
                let marker = new google.maps.Marker({
                    position: uluru,
                    map: map,
                    draggable: true
                });

                google.maps.event.addListener(marker, 'position_changed',
                    function() {
                        let lat = marker.position.lat()
                        let lng = marker.position.lng()
                        $('#lat').val(lat)
                        $('#lng').val(lng)
                    })

                google.maps.event.addListener(map, 'click',
                    function(event) {
                        pos = event.latLng
                        marker.setPosition(pos)
                    })
            }
        </script>
    @stop
