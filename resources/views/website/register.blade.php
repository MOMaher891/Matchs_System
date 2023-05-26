@extends('layouts.login')

@section('content')
    <form action="{{route('register')}}" id="Register" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

{{-- <script src="http://code.jquery.com/jquery-3.5.1.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>
<script src="{{asset('js/firebase.js')}}"></script> --}}

<script>
    $(document).ready(function() {
        $('#Register').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
            url:"/register",
            header:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type:'POST',
            data: new FormData(this),
            processData:false,
            contentType:false,
            success:function(data){
                // console.log(data.error);
                $("#register-btn").html('Sign up').prop('disabled', false);
                localStorage.setItem('phone',JSON.stringify($("#phone").val()));
                localStorage.setItem('name', JSON.stringify($("#name").val()));

                window.location.replace("/verifiy")

                console.log('Code Sent');
                // url = `/verifiy?phone=${phoneNo}`
                // window.location.href(url)

            },
            error:function(data)
            {
                $("#register-btn").html('Sign up').prop('disabled', false);
                
                if(data.status == 422){
                    // printErrorMsg(data.responseJSON.errors)
                    msg = data.responseJSON.errors
                    $.each(msg,function(key,value){
                        $(`.${key}_err`).text(value)
                        notyf.open({
                                type: 'error',
                                message: value
                        
                            });
                    })
                }

                
            }

        });
    }); 
    })
   
    
</script>
@stop