@extends('layouts.login')
@section('content')
@section('title', 'Admin Login')


<form class="pt-3" method="POST" action="{{ route('admin.login.check') }}">
    @csrf
    <div class="form-group">
        <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1"
            placeholder="Username">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1"
            placeholder="Password">
    </div>
    <div class="mt-3">
        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
    </div>
    <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="form-check">
            <label class="form-check-label text-muted">
                <input type="checkbox" class="form-check-input">
                Keep me signed in
            </label>
        </div>
        <a href="#" class="auth-link text-black">Forgot password?</a>
    </div>
    <div class="mb-2">
        <button type="button" class="btn btn-block btn-facebook auth-form-btn">
            <i class="ti-facebook mr-2"></i>Connect using facebook
        </button>
    </div>
    <div class="text-center mt-4 font-weight-light">
        Don't have an account? <a href="register.html" class="text-primary">Create</a>
    </div>
</form>

@stop()
