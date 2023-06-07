@extends('admin.layouts.app')
@section('content')

<div class="card">
    <div class="card-body">
      <h4 class="card-title">Profile</h4>

      <form class="forms-sample" action="{{route('admin.profiles.change-password')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleInputUsername1">Old Password</label>
          <input type="password" class="form-control" id="exampleInputUsername1"  name="old_password" placeholder="Old Password">
        </div>
    
        
        <div class="form-group">
            <label for="exampleInputUsername1">New  Password</label>
            <input type="password" class="form-control" id="exampleInputUsername1"  name="password" placeholder="Password">
          </div>
     
          <div class="form-group">
            <label for="exampleInputUsername1">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputUsername1"  name="password_confirmation" placeholder="Confirm Password">
          </div>
     
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
      </form>
    </div>
  </div>
@endsection