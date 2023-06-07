@extends('admin.layouts.app')
@section('title', 'Stadium Owner')
@section('content')
<div class="row">
    <div class="col-md-4 mb-4 stretch-card transparent">
        <div class="card card-tale">
          <div class="card-body">
            <p class="mb-4">Stadiums</p>
            <p class="fs-30 mb-2">{{$stdCount}}</p>
          </div>
        </div>
    </div>

    <div class="col-md-4 mb-4 stretch-card transparent">
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-4">Requests</p>
            <p class="fs-30 mb-2">{{$requestCount}}</p>
          </div>
        </div>
    </div>


    <div class="col-md-4 mb-4 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Bookings</p>
            <p class="fs-30 mb-2">{{$bookingCount}}</p>
          </div>
        </div>
    </div>
</div>
@stop
