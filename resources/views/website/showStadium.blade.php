@extends('website.layouts.layout')
@section('title', $data['name'])
@section('content')

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="{{ asset('website/calendar.css') }}">
        <style>
            .swiper {
                width: 100%;
                height: 100% !important;
                border-radius: 20px;
                z-index: 1
            }

            .swiper-slide.swiper-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .swiper-slide img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;

                border-radius: 20px;
            }

            .option {
                border: 1px solid #C2C9D1;
                border-radius: 8px;
                padding: 0.5rem;
                min-width: 118px;
                transition: all linear .2s;
            }

            .option:hover {
                background-color: var(--orange);
                color: white;
                cursor: pointer;
            }

            .bgsmall {
                transform: scaleX(-1);
            }

            .col-md-3 {
                width: 160px;
                padding: 20px 15px;
                border: 1px solid #DDD;
                border-radius: 15px;
                margin: 20px 10px;
                text-align: center;
                cursor: pointer;
                text-decoration: none;
                /* display: none; */
            }

            .col-md-3:hover {
                background-color: var(--orange);
                color: white;
            }

            .col-md-3:focus {
                background-color: var(--orange);
                color: white;
            }
        </style>
    </head>

    <body class="light dark">
        <div class="container py-5 my-5" style="height:175vh;margin-top:50px">
            <div class="d-flex justify-content-between" style="margin-top:150px">
                <div class="mt-8">
                    <h2 class="" style="font-weight:bolder">{{ $data->name }}</h2>
                    <h3><i class="fas fa-map-marker-alt" style="color:green"></i> {{ $data->region->name }}
                        - {{ $data->region->city->name }} </h3>
                    <img src="{{ asset('website/Images/bgSmall.png') }}" class="bgsmall" width="20%" alt="">
                    <div class="d-flex pt-4">
                        <img src="{{ asset('website/Images/tag.png') }}" alt="">
                        <div class="flex-grow-1 pt-1" style="margin-right:180px;margin-left:20px">
                            <h3 class="fw-bold">{{ $data->name }}</h3>
                            <p>Number Of Player <span class="fw-bolder">{{ $data->num_of_player + 1 }} <span
                                        class="text-success">V.S</span>
                                    {{ $data->num_of_player + 1 }}</span></p>
                            <img src="{{ asset('website/Images/bgSmall.png') }}" class="bgsmall" width="40%"
                                alt="">
                        </div>
                        <div class="d-none d-md-block">
                            <a target="_blank"
                                href="https://wa.me/{{ $data->phone }}?text=Hello,%20about {{ $data->name }}%20Stadium%20:%20"
                                class="text-decoration-none"><img src="{{ asset('website/Images/whatsapp.png') }}"
                                    width="22" class="me-2" alt="img"></a>
                        </div>

                    </div>
                    <div class="position-relative mt-3" style="width:700px;height:400px">
                        <div class="swiper mySwiper position-relative">
                            <div class="swiper-wrapper">
                                @foreach ($images as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('uploads/stadium/' . $image->image) }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="position-relative w-100 my-5">
                            {{-- Location Inputs --}}
                            <div class="col-md-12">
                                <h3>Stadium Location</h3>
                                <img src="{{ asset('website/Images/bgSmall.png') }}" class="bgsmall" width="30%"
                                    alt="">
                                <div id="map" style="height:300px; width: 600px;" class="my-3"></div>
                            </div>
                            {{-- Location Inputs --}}
                        </div>
                        <div class="position-relative w-100 my-5" style="padding-bottom:100px">
                            <h3>Options</h3>
                            <img src="{{ asset('website/Images/bgSmall.png') }}" width="25%" class="bgsmall"
                                alt="">
                            <div class="row d-flex my-5">
                                <div class="col-md-2">
                                    <div class="option">
                                        <img src="{{ asset('website/Images/ball.png') }}" width="40" class="mx-2"
                                            alt="">
                                        <span>Ball</span>
                                    </div>
                                </div>
                                @if ($data->clothes)
                                    <div class="col-md-2">
                                        <div class="option">
                                            <img src="{{ asset('website/Images/shirt.png') }}" width="40"
                                                class="mx-2" alt="">
                                            <span>Shirts</span>
                                        </div>
                                    </div>
                                @endif

                                @if ($data->s_bathroom)
                                    <div class="col-md-2">
                                        <div class="option">
                                            <img src="{{ asset('website/Images/shower.png') }}" width="40"
                                                class="mx-2" alt="">
                                            <span>Shower</span>
                                        </div>
                                    </div>
                                @endif

                                @if ($data->bathroom)
                                    <div class="col-md-2">
                                        <div class="option">
                                            <img src="{{ asset('website/Images/toilet.png') }}" width="40"
                                                class="mx-2" alt="">
                                            <span>Toilet</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                </div>


                {{-- Right Div --}}

                <div class="mx-5">
                    <div class=" pb-3">
                        <h2 class="fw-bolder">Booking</h2>
                        <img src="{{ asset('website/Images/bgSmall.png') }}" class="bgsmall" width="30%" alt="">
                    </div>
                    <form action="{{ route('booking', $data->id) }}" method="post" class="d-flex justify-content-between">
                        @csrf
                        <div class="form-group " style="width:220px">
                            <label for="" class="fw-bolder">Choose Day</label>
                            <input type="date" onchange="getDate()" name="date" placeholder="Choose Day"
                                class="form-control mt-3 p-3 w-100" id="">

                            <input type="submit" value="Book" class="btn btn-success">
                        </div>
                        <div class="form-check form-switch mt-5 justify-content-center align-items-center">
                            <input class="form-check-input" style="font-size:20px" type="checkbox" role="switch"
                                id="flexSwitchCheckDefault" name="type">
                            <label class="form-check-label fw-bolder" for="flexSwitchCheckDefault">Const
                                Booking</label>
                        </div>
                        @php
                            use Illuminate\Support\Facades\Auth;
                        @endphp
                        <input type="hidden" name="client_id" value="{{ Auth::guard('client')->user()->id }}">
                        <input type="hidden" name="stadium_id" value="{{ $data->id }}">
                        <input type="hidden" name="times">
                    </form>
                    <div class="row" id="time_btn">
                        @foreach ($times as $time)
                            <button class="col-md-3" onclick="getTime({{ $time->id }})"
                                id="">{{ $time->from }} - {{ $time->to }}</button>
                        @endforeach
                    </div>
                </div>

            </div>


        </div>
        {{-- Get Long and lat from map --}}

        <script>
            var ids = [];

            function getTime(id) {
                ids.push(id);
                document.getElementsByName('times')[0].value = ids[ids.length - 1];
            }

            function getDate() {
                var x = document.getElementsByName('date')[0].value;
                var stadium_id = document.getElementsByName('stadium_id')[0].value;
                // var y = x.value;


                $.ajax({
                    url: "{{ route('getDates') }}",
                    type: 'GET',
                    data: {
                        date: x,
                        std_id: stadium_id
                    },
                    success: function(data) {
                        $("#time_btn").html(data);
                    },
                    error: function(reject) {
                        console.log('reject');
                    }
                })
            }
        </script>
        <script>
            let map;

            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat: {{ $data->lat }},
                        lng: {{ $data->long }}
                    },
                    zoom: 18,
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

                // google.maps.event.addListener(map, 'click',
                //     function(event) {
                //         pos = event.latLng
                //         marker.setPosition(pos)
                //     })
            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr("input[type=date]", {
                minDate: new Date(),
            });
        </script>
    </body>



@stop()
