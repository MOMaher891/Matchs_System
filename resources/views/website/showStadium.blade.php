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

            ::-webkit-scrollbar {
                width: 20px;
            }

            ::-webkit-scrollbar-thumb {
                /* width: 500px; */
                background-color: rgba(133, 194, 64, 0.665);
                border-radius: 3px;
            }
        </style>
    </head>

    <body class="light dark">
        <div class="container my-5" style="">
            <div class="row" style="margin-top:150px">
                {{-- Left Div --}}
                <div class="col-xl-6 col-md-12 com-sm-12 mt-8 px-2" style="overflow: hidden">
                    <div class="d-flex">
                        <img src="{{ asset('website/Images/tag.png') }}" alt="">
                        <div class="flex-grow-1 pt-1" style="margin-right:180px;margin-left:20px">
                            <h3 class="fw-bold">{{ $data->name }}</h3>
                            <h3 class="mb-2"><i class="fas fa-map-marker-alt" style="color:green"></i>
                                {{ $data->region->name }}
                                - {{ $data->region->city->name }} </h3>
                            <p>Number Of Player <span class="fw-bolder">{{ $data->num_of_player }} <span
                                        class="text-success">V.S</span>
                                    {{ $data->num_of_player }}</span></p>
                            <p>Players Number <span class="fw-bolder">{{ $data->num_of_player - 1 }} + </span> Goal Keeper
                            </p>

                        </div>
                        <div class="d-none d-md-block">
                            <a target="_blank"
                                href="https://wa.me/{{ $data->phone }}?text=Hello,%20about {{ $data->name }}%20Stadium%20:%20"
                                class="text-decoration-none"><img src="{{ asset('website/Images/whatsapp.png') }}"
                                    width="22" class="me-2" alt="img"></a>
                        </div>
                    </div>
                    <img src="{{ asset('website/Images/bgSmall.png') }}" class="bgsmall" width="40%" alt="">
                    <div class="mt-3" style="width:100%;">
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
                                <div id="map" style="height:300px; width: 100%;" class="my-3"></div>
                            </div>
                            {{-- Location Inputs --}}
                        </div>
                        <div class="position-relative w-100 my-5" style="padding-bottom:100px">
                            <h3>Options</h3>
                            <img src="{{ asset('website/Images/bgSmall.png') }}" width="25%" class="bgsmall"
                                alt="">
                            <div class="row d-flex my-5 justify-content-between" style="width: 97%;">
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

                                @if ($data->weather)
                                    @if ($data->weather == 'winter')
                                        <div class="col-md-2">
                                            <div class="option">
                                                <img src="{{ asset('website/Images/winter.png') }}" width="39"
                                                    class="mx-2" alt="">
                                                <span>Summer</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-2">
                                            <div class="option">
                                                <img src="{{ asset('website/Images/summer.png') }}" width="40"
                                                    height="39" class="mx-2" alt="">
                                                <span>Winter</span>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <div class="col-md-2">
                                        <div class="option">
                                            <img src="{{ asset('website/Images/summer.png') }}" width="40"
                                                height="39" class="mx-2" alt="">
                                            <span>Winter</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="option">
                                            <img src="{{ asset('website/Images/winter.png') }}" width="39"
                                                class="mx-2" alt="">
                                            <span>Summer</span>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                {{-- Right Div --}}
                <div class="col-xl-6 col-md-12 com-sm-12 px-3">
                    <div class=" pb-3 d-flex justify-content-between">
                        <div>
                            <h2 class="fw-bolder">Booking</h2>
                            <img src="{{ asset('website/Images/bgSmall.png') }}" class="bgsmall" width="100%"
                                alt="">

                        </div>
                        <div>
                            <h2 class="fw-bolder pt-3" style="color:#85c240" id="price">{{ $data->price }}$</h2>

                        </div>
                    </div>
                    <form action="{{ route('booking', $data->id) }}" method="post"
                        class="d-flex justify-content-between">
                        @csrf
                        <input type="hidden" name="price" value="{{ $data->price }}">
                        <div class="form-group " style="width:220px">
                            <label for="" class="fw-bolder">Choose Day</label>
                            <input type="date" onchange="getDate()" name="date" placeholder="Choose Day"
                                class="form-control mt-3 p-3 w-100" id="">
                            @error('date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <input type="submit" value="Book" class="btn btn-success">
                        </div>
                        <div class="d-flex flex-column">

                            <div class="form-check form-switch mt-5 justify-content-center align-items-center">
                                <input class="form-check-input" style="font-size:20px" type="checkbox" role="switch"
                                    id="flexSwitchCheckDefault" onclick="typeToggle()" name="type">

                                <label class="form-check-label fw-bolder" id="const"
                                    for="flexSwitchCheckDefault">Const
                                    Booking</label>
                                <input type="number" hidden class="form-control mt-3 p-3 w-100"
                                    placeholder="Enter Month Number" name="months" id="months">

                            </div>


                            <div class="form-check form-switch my-5 justify-content-center align-items-center">
                                <input class="form-check-input" style="font-size:20px" type="checkbox" role="switch"
                                    id="flexSwitchCheckDefault" name="twoHour" value="off" onchange="hourToggle()">
                                <label class="form-check-label fw-bolder" for="flexSwitchCheckDefault">Two Hour
                                </label>
                            </div>

                            <div class="form-check form-switch  justify-content-center align-items-center">
                                <input class="form-check-input" style="font-size:20px" type="checkbox" role="switch"
                                    id="flexSwitchCheckDefault2" name="hour_half" value="off"
                                    onchange="hour_half_Toggle()">
                                <label class="form-check-label fw-bolder" for="flexSwitchCheckDefault2">Hour + Half
                                </label>
                            </div>
                        </div>
                        @php
                            use Illuminate\Support\Facades\Auth;
                        @endphp
                        @isset(Auth::guard('client')->user()->id)
                            <input type="hidden" name="client_id" value="{{ Auth::guard('client')->user()->id }}">
                        @endisset
                        <input type="hidden" name="stadium_id" value="{{ $data->id }}">
                        <input type="hidden" name="times">
                    </form>

                    <h2 class="fw-bolder pt-3">Avaliable Times</h2>
                    <img src="{{ asset('website/Images/bgSmall.png') }}" class="bgsmall" width="30%" alt="">
                    <p>You Should Choose <span id="alert" class="fw-bolder"
                            style="color:rgb(133, 194, 64) ;font-size:17px"> 2
                        </span> Buttons For Booking <span id="hours" class="fw-bolder"
                            style="color:rgb(133, 194, 64) ;font-size:17px"> 1 </span> Hour</p>
                    @error('times')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @enderror
                    <div class="row time_btn" id="time_btn" style="height: 500px;overflow: scroll;">
                        @foreach ($times as $time)
                            <button class="col-md-3" onclick="getTime({{ $time->id }})"
                                id="{{ $time->id }}">{{ Carbon\Carbon::parse($time->from)->format('H:i') }} -
                                {{ Carbon\Carbon::parse($time->to)->format('H:i') }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{-- Get Long and lat from map --}}


        <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
            flatpickr("input[type=date]", {
                minDate: new Date(),
            });
        </script>

        <script>
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
            var ids = [];
            var two = document.getElementsByName('twoHour')[0];
            var half = document.getElementsByName('hour_half')[0];
            var y = document.getElementsByName('type')[0].value;
            var hidden_month_input = document.querySelector('#months');
            var price = document.getElementById('price');
            var total = document.getElementsByName('price');

            function getTime(id) {
                ids.push(id);
                if (two.value != 'on' && half.value != 'on') {
                    ids.push(id + 1);
                    var buttons = document.querySelectorAll('#time_btn .col-md-3');
                    ids = ids.slice(-2);
                    buttons.forEach(function(e) {
                        if (e.id == ids[0] || e.id == ids[1]) {

                            e.style.backgroundColor = "#85c240";
                            e.style.color = 'white';
                        } else {
                            e.style.backgroundColor = "rgb(240 240 248)";
                            e.style.color = "black";
                        }
                    })
                    document.getElementsByName('times')[0].value = ids;

                } else if (half.value != 'on') {
                    ids.push(id + 1);
                    ids.push(id + 2);
                    ids.push(id + 3);

                    ids = ids.slice(-4);
                    var buttons = document.querySelectorAll('#time_btn .col-md-3');
                    buttons.forEach(function(e) {

                        if (e.id == ids[0] || e.id == ids[1] || e.id == ids[2] || e.id == ids[3]) {
                            e.style.backgroundColor = "#85c240";
                            e.style.color = 'white';

                        } else {
                            e.style.backgroundColor = "rgb(240 240 248)";
                            e.style.color = "black";
                        }
                    })

                    document.getElementsByName('times')[0].value = ids;

                } else {
                    ids.push(id + 1);
                    ids.push(id + 2);
                    ids = ids.slice(-3);
                    // console.log(ids);
                    var buttons = document.querySelectorAll('#time_btn .col-md-3');
                    buttons.forEach(function(e) {
                        if (e.id == ids[0] || e.id == ids[1] || e.id == ids[2]) {
                            e.style.backgroundColor = "#85c240";
                            e.style.color = 'white';

                        } else {
                            e.style.backgroundColor = "rgb(240 240 248)";
                            e.style.color = "black";
                        }
                    })

                    document.getElementsByName('times')[0].value = ids;
                }
            }



            function hourToggle() {

                var buttons = document.querySelectorAll('#time_btn .col-md-3');
                ids.splice(0, ids.length);
                document.getElementsByName('times')[0].value = ids;
                buttons.forEach(function(e) {
                    e.style.backgroundColor = "rgb(240 240 248)";
                    e.style.color = "black";
                })

                if (two.value == 'off') {
                    two.value = 'on';
                    document.getElementById('alert').innerHTML = 4;
                    document.getElementById('hours').innerHTML = 2;
                    price.innerHTML = {{ $data->price }} * 2 + "$";
                    total[0].value = {{ $data->price }} * 2;
                    two.checked = true;
                    if (half.checked == true) {
                        half.checked = false;
                        half.value = 'off';
                    }

                } else {
                    two.value = 'off';
                    document.getElementById('alert').innerHTML = 2;
                    document.getElementById('hours').innerHTML = 1;
                    price.innerHTML = {{ $data->price }} + "$";
                    total[0].value = {{ $data->price }};
                    two.checked = false;
                }
            }

            function hour_half_Toggle() {
                var buttons = document.querySelectorAll('#time_btn .col-md-3');
                ids.splice(0, ids.length);
                document.getElementsByName('times')[0].value = ids;
                buttons.forEach(function(e) {
                    e.style.backgroundColor = "rgb(240 240 248)";
                    e.style.color = "black";
                })
                if (half.value == 'off') {
                    half.value = 'on';
                    document.getElementById('alert').innerHTML = 3;
                    document.getElementById('hours').innerHTML = 1.5;
                    price.innerHTML = {{ $data->price }} * 1.5 + "$";
                    total[0].value = {{ $data->price }} * 1.5;
                    half.checked = true;
                    if (two.checked == true) {
                        two.checked = false;
                        two.value = 'off';
                    }
                } else {
                    half.value = 'off';
                    document.getElementById('alert').innerHTML = 2;
                    document.getElementById('hours').innerHTML = 1;
                    price.innerHTML = {{ $data->price }} + "$";
                    total[0].value = {{ $data->price }};
                    half.checked = false;
                }
                ids.length = 0;
            }

            function typeToggle() {

                if (y == 'off') {
                    y = 'on';
                    hidden_month_input.hidden = true;

                } else {
                    y = 'off';
                    hidden_month_input.hidden = false;
                }
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
    </body>



@stop()
