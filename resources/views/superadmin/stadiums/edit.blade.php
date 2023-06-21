@extends('superadmin.layouts.app')
@section('title', 'Edit Stadium')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Stadium</h4>
                <p class="card-description">
                    Edit Stadium
                </p>
                <form class="forms-sample" action="{{ route('super_admin.stadiums.update', $data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}"
                                id="exampleInputName1" placeholder="Name">
                            @error('name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail3">City</label>
                            <select name="city" class="form-control" id="city_search" onchange="getRegion()">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ old('city_id', $city->id) }}"
                                        {{ old('city_id', $city->id) == $data->region->city_id ? 'selected' : '' }}>
                                        {{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail3">Region</label>
                            <select name="region_id" class="form-control" id="region_search">
                                <option value="{{ $data->region->id }}" selected>{{ $data->region->name }}</option>
                            </select>
                            @error('region_id')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword4">Price</label>
                            <input type="text" class="form-control" name="price"
                                value="{{ old('price', $data->price) }}" id="exampleInputPassword4" placeholder="Price">
                            @error('price')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword4">Phone</label>
                            <input type="text" class="form-control" name="phone"
                                value="{{ old('phone', $data->phone) }}" id="exampleInputPassword4" placeholder="Phone">
                            @error('phone')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword4">Number Of Playes</label>
                            <input type="text" class="form-control" name="num_of_player"
                                value="{{ old('num_of_player', $data->num_of_player) }}" id="exampleInputPassword4"
                                placeholder="num_of_player">
                            @error('price')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputPassword4">Image</label>
                            <input type="file" class="form-control" name="image[]" value="{{ old('image[]') }}" multiple
                                placeholder="Image">
                            @error('image')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror

                            <div class="row">
                                <div class="col-md-6 my-4">
                                    <div class="swiper mySwiper">
                                        <div class="swiper-wrapper">
                                            @foreach ($data->stadium_image as $image)
                                                <div class="swiper-slide">
                                                    <img src="{{ asset('uploads/stadium/' . $image->image) }}"
                                                        alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail3">Description</label>
                            <textarea name="description" id="description" class="description">{{ old('description', $data->description) }}</textarea>
                            @error('description')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Checked</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Clothes</td>
                                        <td>
                                            <div
                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-danger d-inline">
                                                <input type="checkbox" name="clothes" class="custom-control-input"
                                                    {{ $data->clothes ? 'checked' : '' }} id="clothes" />
                                                <label class="custom-control-label" for="clothes"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bathroom</td>
                                        <td>
                                            <div
                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-danger d-inline">
                                                <input type="checkbox" name="bathroom" class="custom-control-input"
                                                    {{ $data->bathroom ? 'checked' : '' }} id="Bathroom" />
                                                <label class="custom-control-label" for="Bathroom"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shower Bathroom</td>
                                        <td>
                                            <div
                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-danger d-inline">
                                                <input type="checkbox" name="s_bathroom" class="custom-control-input"
                                                    id="s_Bathroom" {{ $data->s_bathroom ? 'checked' : '' }} />
                                                <label class="custom-control-label" for="s_Bathroom"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Closing Weather</td>
                                        <td>
                                            <div>
                                                <label for="">Winter</label>
                                                <input type="radio" name="weather"
                                                    @if ($data->weather == 'winter') checked @endif value="winter" />
                                                <label for="">Summer</label>
                                                <input type="radio" name="weather"
                                                    @if ($data->weather == 'summer') checked @endif value="summer" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Closing period</td>
                                        <td>
                                            <div>
                                                <select name="period[]" id="" multiple class="form-control">
                                                    <option value="" selected>Select Periods</option>
                                                    @foreach ($times as $time)

                                                        <option value="{{old('period',$time->id)  }}" {{ in_array($time->id,$openTime) ? 'selected' : '' }}  >{{ $time->from }} -
                                                            {{ $time->to }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">

                        {{-- Location Inputs --}}
                        <div class="col-md-12">
                            <input type="hidden" class="form-control" placeholder="lat" name="lat"
                                value="{{ $data->lat }}" id="lat">
                            <input type="hidden" class="form-control" placeholder="long" name="long"
                                value="{{ $data->long }}" id="lng">
                            <label for="">Select stadium location</label>
                            <div id="map" style="height:300px; width: 600px;" class="my-3"></div>
                        </div>
                        {{-- Location Inputs --}}
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('super_admin.stadiums.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



    <script>
        CKEDITOR.replace('description');

        $(document).ready(function() {
            $('#users_search').select2({
                placeholder: 'Select an User',
                allowClear: true
            });
            $('#city_search').select2({
                placeholder: 'Select an City',
                allowClear: true
            });
            $('#region_search').select2({
                placeholder: 'Select an Region',
                allowClear: true
            });
        });

        function getRegion() {
            let city_id = $("#city_search").find(":selected").val();

            $.ajax({
                type: 'GET',
                url: `{{ route('admin.stadiums.get-region-data') }}`,
                data: {
                    city_id: city_id
                },
                success: function(data) {
                    $("#region_search").html(data);
                },
                error: function(error) {
                    console.log('error');
                }
            });
        }
    </script>

    {{-- Get Long and lat from map --}}
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

            google.maps.event.addListener(map, 'click',
                function(event) {
                    pos = event.latLng
                    marker.setPosition(pos)
                })
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>

@stop
