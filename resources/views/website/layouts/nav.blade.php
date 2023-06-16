<style>
    a {
        text-decoration: none;
    }
</style>
<header style="z-index: 1000">
    <div id="menu-bar" class="fas fa-bars"></div>

    <a href="{{ route('client.home') }}" class="logo"><span>ML3</span>bna</a>
    <nav class="navbar">
        <a href="{{ route('client.home') }}">home</a>
        <a href="#review">reviews</a>
        <a href="#review">Book</a>
        @if (!auth('client')->user())
            <a href="{{ route('register.view') }}">Register</a>
        @endif
    </nav>

    <div class="icons">
        <i class="fas fa-search" id="search-btn"></i>
        @if (!auth('client')->user())
            <i class="fas fa-user" id="login-btn"></i>
        @else
            <a href="{{ route('client.logout') }}"><i class="fa-solid fa-right-from-bracket"></i></a>
           <a href="{{route('client.profile')}}"> <i class="fas fa-user"></i></a>
        
        @endif

        <form action="" class="search-bar-container">
            <input type="search" id="search-bar" placeholder="search here...">
            <label for="search-bar" class="fas fa-search"></label>
        </form>
</header>





<div class="login-form-container">
    <i class="fas fa-times" id="form-close"></i>
    <form action="{{ route('client.login') }}" method="POST">
        @csrf
        <h3>login</h3>
        <input type="text" name="phone" class="box" placeholder="Phone">
        <input type="password" name="password" class="box" placeholder="Password">
        <input type="submit" value="login now" class="btn">
        {{-- <input type="checkbox" id="remember"> --}}
        {{-- <label for="remember">Remember me</label> --}}
        {{-- <p>forgrt password? <a href="#">click here</a></p> --}}
        {{-- <p>don't have and account? <a href="#">register now</a></p> --}}
    </form>
</div>
