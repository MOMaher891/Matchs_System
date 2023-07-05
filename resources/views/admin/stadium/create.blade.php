@extends('admin.layouts.app')
@section('title', 'Add Stadium')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Stadium</h4>
                <p class="card-description">
                    Add Stadium
                </p>
                <form class="forms-sample" action="{{ route('admin.stadiums.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
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
                                    <option value="{{ old('city_id', $city->id) }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail3">Region</label>
                            <select name="region_id" class="form-control" id="region_search">
                                <option value="{{ old('region_id') }}" disabled>Select Region</option>
                            </select>
                            @error('region_id')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword4">Price in LB</label>
                            <input type="text" class="form-control" name="price" value="{{ old('price') }}"
                                id="exampleInputPassword4" placeholder="Price">
                            @error('price')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>


                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword4">Price in Dolar </label>
                            <input type="text" class="form-control" name="price_in_dolar" value="{{ old('price') }}"
                                id="exampleInputPassword4" placeholder="Price In Dolar">
                            @error('price_in_dolar')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword4">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                                id="exampleInputPassword4" placeholder="Phone">
                            @error('phone')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword4">Number Of Playes + Goal Keeper</label>
                            <input type="text" class="form-control" name="num_of_player"
                                value="{{ old('num_of_player') }}" id="exampleInputPassword4" placeholder="num_of_player">
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail3">Description</label>
                            <textarea name="description" id="description" class="description">{{ old('description') }}</textarea>
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
                                                    id="clothes" />
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
                                                    id="Bathroom" />
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
                                                    id="s_Bathroom" />
                                                <label class="custom-control-label" for="s_Bathroom"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Closing Weather</td>
                                        <td>
                                            <div>
                                                <label for="">Winter</label>
                                                <input type="radio" name="weather" value="winter" />
                                                <label for="">Summer</label>
                                                <input type="radio" name="weather" value="summer" />
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
                                                        <option value="{{ old('period', $time->id) }}">
                                                            {{ $time->from }}
                                                            -
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
                            <input type="hidden" class="form-control" placeholder="lat" name="lat" id="lat">
                            <input type="hidden" class="form-control" placeholder="long" name="long"
                                id="lng">
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
                    lat: 33.89362857288377,
                    lng: 35.47826286142629
                },
                zoom: 8,
                scrollwheel: true,
            });

            const uluru = {
                lat: 33.89362857288377,
                lng: 35.47826286142629
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