@extends('superadmin.layouts.app')
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
                <form class="forms-sample" action="{{ route('super_admin.stadiums.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" name="name" id="exampleInputName1"
                                placeholder="Name">
                            @error('name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="users">User</label>
                            <select name="admin_id" id="users_search" class="form-control">
                                <option value="" disabled>Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword4">Price</label>
                            <input type="text" class="form-control" name="price" id="exampleInputPassword4"
                                placeholder="Price">
                            @error('price')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword4">Phone</label>
                            <input type="text" class="form-control" name="phone" id="exampleInputPassword4"
                                placeholder="Phone">
                            @error('price')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputPassword4">Image</label>
                            <input type="file" class="form-control" name="image[]" multiple id="exampleInputPassword4"
                                placeholder="Image">
                            @error('price')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail3">Description</label>
                            <textarea name="description" id="description" class="description" cols="30" rows="10"></textarea>
                            @error('description')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        {{-- Location Inputs --}}
                        <div class="col-md-6">
                            <input type="hidden" class="form-control" placeholder="lat" name="lat" id="lat">
                            <input type="hidden" class="form-control" placeholder="long" name="long" id="lng">
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
                placeholder: 'Select an option',
                allowClear: true
            });
        });
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
