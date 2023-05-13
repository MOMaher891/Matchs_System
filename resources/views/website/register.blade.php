@extends('layouts.login')

@section('content')
    <form action="{{route('register')}}" method="POST" id="SendCode">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                    @error('name')
                        {{$message}}
                    @enderror
                </div>
            </div>
            {{-- <div class="col-md-12">
                <div class="form-group">
                    <label for="">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email">
                    @error('email')
                        {{$message}}
                    @enderror
                </div>
            </div> --}}

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                    @error('password')
                        {{$message}}
                    @enderror
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Password Confirmation</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Password">
                    @error('password')
                        {{$message}}
                     @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
                    @error('phone')
                    {{$message}}
                @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Date of Birth</label>
                    <input type="date" class="form-control" name="birth_date">
                </div>
            </div>

            <div id="recaptcha-container"></div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Enter Address">
                </div>
            </div>

            
            <div class="mt-3">
                <button class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" id="register-btn">SIGN Up</button>
            </div>

        </div>
    </form>


@endsection

@section('js')
<script src="http://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>

<script src="{{asset('js/firebase.js')}}"></script>
{{-- <script>
    $('#verifPhNum').on('click', function() {
        let isAuth = false;
        let phoneNo = '';
        var code = $('#codeToVerify').val();
        console.log(code);
        $(this).attr('disabled', 'disabled');
        $(this).text('Processing..');
        confirmationResult.confirm(code).then(function (result) {
                    // alert('Succecss');
                    isAuth = true;
                    phoneNo = result.user.phoneNumber;
                    console.log(phoneNo);
                    console.log(isAuth);
                    var user = result.user;
            console.log(user);
    
    
            // ...
        }.bind($(this))).catch(function (error) {
        
            // User couldn't sign in (bad verification code?)
            // ...
            $(this).removeAttr('disabled');
            $(this).text('Invalid Code');
            setTimeout(() => {
                $(this).text('Verify Phone No');
            }, 2000);
        }.bind($(this)));
    
    });
    
</script> --}}
@stop