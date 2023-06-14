<div class="card">
  <div class="card-body">
    <h4 class="card-title">Profile</h4>

    <div class="text-center">
      <div class="image-content rounded-circle">
          <img src="{{$user->image  ? asset('uploads/client/'.$user->image): asset('Admin/images/dashboard/people.png')}}" width="300px" alt="">
        </div>    
    </div>
    

    <form class="forms-sample" action="{{route('client.profile.update',$user->id)}}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="exampleInputEmail1">Image</label>
        <input type="file" class="form-control" id="exampleInputEmail1" name="image" placeholder="Address">
      </div>
      <div class="form-group">
        <label for="exampleInputUsername1">Name</label>
        <input type="text" class="form-control" id="exampleInputUsername1"  name="name" value="{{$user->name}}" placeholder="Username">
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">Phone</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="phone" value="{{$user->phone}}" placeholder="Email">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Date </label>
        <input type="date" class="form-control" id="exampleInputEmail1" name="date" value="{{$user->date}}" placeholder="Email">
      </div>
             
   
      <button type="submit" class="btn btn-primary">Submit</button>
      <a class="btn btn-danger" href="{{route('client.change.password.view')}}">Change Password</a>
    </form>
  </div>
</div>