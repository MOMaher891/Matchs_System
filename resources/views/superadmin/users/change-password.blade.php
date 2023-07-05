@extends('superadmin.layouts.app')
@section('title', 'Change Password')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">Change Password</h4>
    
          <form class="forms-sample" action="{{route('super_admin.users.change-password',$data->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
        
            
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
    
</div>
@endsection