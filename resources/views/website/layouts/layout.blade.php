<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') </title>

    {{-- <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" /> --}}
    <link rel="stylesheet" href="{{asset('Admin/cdns/swiper.css')}}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="{{asset('Admin/cdns/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('website/style.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/vendors/datatables/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Admin/js/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{asset('website/form.css')}}">
    <style>
        html,
        body {
            position: relative;
            height: 100%;
        }

        body {
            background: #eee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .swiper {
            width: 100%;
            height: 100%;
            border-radius: 20px;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;

            border-radius: 20px;
        }
        .pagination > li > a:focus,
        .pagination > li > span:focus {
            background-color:#85c240 !important ;

        }

        .page-item.active .page-link {
            background-color: #85c240 !important;
            border-color: #85c240 !important;
        }
        .pagination > li > a {
          color: #000 !important; 

        }

    </style>
</head>

<body>
    @include('website.layouts.nav')
    @yield('content')
    <div style="width:150% !important;">
        @include('website.layouts.footer')
    </div>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js" defer data-deferred="1"></script>
    <script src="{{ asset('website/main.js') }}" defer data-deferred="1"></script>
    <!-- Swiper JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script> --}}
    <script src="{{asset('Admin/cdns/swiper.js')}}"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 10000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

    <script src="http://code.jquery.com/jquery-3.5.1.js"></script>


    {{-- <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js" defer data-deferred="1"></script> --}}
    <script src="{{ asset('website/main.js') }}" defer data-deferred="1"></script>
    <script src="{{ asset('website/calendar.js') }}" defer data-deferred="1"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script> --}}
    <script src="{{asset('Admin/cdns/bootstrap.min.js')}}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });
    </script>

    <script src="{{ asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('Admin/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Admin/vendors/datatables/datatables.min.js') }}"></script>

    @yield('js')
</body>

</html>
