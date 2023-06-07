@extends('admin.layouts.app')
@section('content')

<div class="card">
    <div class="card-body">
      <h4 class="card-title">Profile</h4>

      <div class="text-center">
        <div class="image-content rounded-circle">
            <img src="{{asset('uploads/admin/'.auth()->user()->image)}}" width="300px" alt="">
          </div>    
      </div>

      <form class="forms-sample" action="{{route('admin.profiles.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleInputUsername1">Name</label>
          <input type="text" class="form-control" id="exampleInputUsername1"  name="name" value="{{auth()->user()->name}}" placeholder="Username">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{auth()->user()->email}}" placeholder="Email">
        </div>        
        <div class="form-group">
            <label for="exampleInputEmail1">Phone</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="phone" value="{{auth()->user()->phone}}" placeholder="Email">
          </div>
               
          <div class="form-group">
            <label for="exampleInputEmail1">Image</label>
            <input type="file" class="form-control" id="exampleInputEmail1" name="image" placeholder="Address">
          </div>
     
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a class="btn btn-danger" href="{{route('admin.profiles.change-password-view')}}">Change Password</a>
      </form>
    </div>
  </div>
@endsection