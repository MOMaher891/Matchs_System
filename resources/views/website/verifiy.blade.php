<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('Admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('Admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('Admin/images/favicon.png') }}" />
</head>



<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="../../images/logo.svg" alt="logo">
                            </div>
                            {{-- <h4>Hello! let's get started</h4> --}}
                            <h6 class="font-weight-light">Verifiy Account Email to continue.</h6>
                            <form action="{{route('verifiy')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Enter Verfication Code</label>
                                            <input type="text" class="form-control" name="code" id="codeToVerify"  placeholder="xxxxx">
                                        </div>
                                    </div>
                        
                                    {{-- <div id="recaptcha-container"></div> --}}

                                    <div class="mt-3">
                                        <button class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" id="Ve">Submit</button>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{route('resend')}}" id="resend" class="btn btn-block btn-light btn-lg font-weight-medium auth-form-btn">resend</a>
                                    </div>
                        
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <script src="http://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>

    <script src="{{asset('js/firebase.js')}}"></script> --}}

    <!-- plugins:js -->
    <script src="{{ asset('Admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('Admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('Admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('Admin/js/template.js') }}"></script>
    <script src="{{ asset('Admin/js/settings.js') }}"></script>
    <script src="{{ asset('Admin/js/todolist.js') }}"></script>

    <script>
    $(document).ready(function() {
        $('#resend').on('click', function(e) {
            e.preventDefault()
            let phone = JSON.parse(localStorage.getItem('phone'));
            let name = JSON.parse(localStorage.getItem('name'));
           
            $.ajax({
            type:'GET',
            url:'/resend'+`?phone=${phone}&name=${name}`,
            header:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
           
            processData:false,
            contentType:false,
            success:function(data){
                console.log(data);
                // console.log(data.error);
                // window.location.replace("/verifiy")
                // console.log('Code Sent');
                // url = `/verifiy?phone=${phoneNo}`
                // window.location.href(url)

            },
            error:function(data)
            {
              alert('error')
                // $("#register-btn").html('Sign up').prop('disabled', false);
                
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
       <!-- endinject -->
</body>
