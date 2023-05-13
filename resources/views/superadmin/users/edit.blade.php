@extends('superadmin.layouts.app')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update User</h4>
                <p class="card-description">
                    Update User
                </p>
                <form class="forms-sample" action="{{ route('super_admin.users.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName1" placeholder="Name"
                            value="{{ $user->name }}">
                        @error('name')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail3"
                            placeholder="Email" value="{{ $user->email }}">
                        @error('email')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Phone Number</label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail3"
                            placeholder="Phone" value="{{ $user->phone }}">
                        @error('phone')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>File upload</label>
                        <div class="input-group col-xs-12">
                            <input type="file" name="image" class="form-control" placeholder="Upload Image"
                                value="{{ old('image', $user->image) }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="{{ route('super_admin.users.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
@stop
