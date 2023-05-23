@extends('superadmin.layouts.app')
@section('title', 'Show Stadium')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Show Stadium</h4>
                <p class="card-description">
                    Add Stadium
                </p>
                <form class="forms-sample">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" value="{{ $data->name }}" name="name"
                                id="exampleInputName1" placeholder="Name" disabled>
                            @error('name')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="users">User</label>
                            <select name="admin_id" id="users_search" class="form-control" disabled>
                                <option value="" disabled>Select User</option>
                                <option value="">{{ $data->admin->name }}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail3">City</label>
                            <select name="city" class="form-control" id="city_search" disabled>
                                <option value="">{{ $data->region->city->name }}</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="exampleInputEmail3">Region</label>
                            <select name="region_id" class="form-control" id="region_search" disabled>
                                <option value="">{{ $data->region->name }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="exampleInputPassword4">Price</label>
                            <input type="text" class="form-control" name="price" id="exampleInputPassword4"
                                placeholder="Price" value="{{ $data->price }}" disabled>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="exampleInputPassword4">Phone</label>
                            <input type="text" class="form-control" name="phone" id="exampleInputPassword4"
                                placeholder="Phone" value="{{ $data->phone }}" disabled>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="exampleInputPassword4">Number Of Playes</label>
                            <input type="text" class="form-control" name="num_of_player" id="exampleInputPassword4"
                                placeholder="num_of_player" value="{{ $data->num_of_player }}" disabled>
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
                                                    id="clothes" @if ($data->clothes == 1) checked @endif
                                                    disabled>
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
                                                    id="Bathroom" @if ($data->bathroom == 1) checked @endif
                                                    disabled />
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
                                                    id="s_Bathroom" @if ($data->s_bathroom == 1) checked @endif
                                                    disabled />
                                                <label class="custom-control-label" for="s_Bathroom"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Closing period</td>
                                        <td>
                                            <div>
                                                <select name="period[]" id="" multiple class="form-control"
                                                    disabled>
                                                    @foreach ($times as $time)
                                                        <option value="{{ $time->id }}">{{ $time->from }} -
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
                            <label for="">Stadium location</label>
                            <div id="map" style="height:300px; width: 600px;" class="my-3"></div>
                        </div>
                        {{-- Location Inputs --}}
                    </div>


                    <a href="{{ route('super_admin.stadiums.index') }}" class="btn btn-primary mr-2">Back</a>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


@stop




{{-- <h3 class="card-title">Stadium Location</h3>
<div class="row">
    <div class="col-md-6">
        <div id="map" style="height:400px; width: 650px;" class="my-3" disabled></div>
    </div>
</div> --}}
@section('js')

    {{-- Get Long and lat from map --}}
    <script>
        CKEDITOR.replace('description');
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
