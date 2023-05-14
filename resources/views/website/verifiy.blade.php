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
                            <h6 class="font-weight-light">Verifiy Your Email to continue.</h6>
                            {{-- <form action=""> --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Enter Verfication Code</label>
                                            <input type="text" class="form-control" id="codeToVerify" name="ver-code" placeholder="xxxxx">
                                        </div>
                                    </div>
                        
                                    <div id="recaptcha-container"></div>

                                    <div class="mt-3">
                                        {{-- <button class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" id="Ve">Submit</button> --}}
                                        <a  class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" id="verifPhNum" >Submit</a>
                                    </div>
                        
                                </div>
                            {{-- </form> --}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>

    <script src="{{asset('js/firebase.js')}}"></script>

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

       <!-- endinject -->
</body>
