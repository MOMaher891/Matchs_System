<header>

    <div id="menu-bar" class="fas fa-bars"></div>

    <a href="#" class="logo"><span>Ml3</span>bna</a>
    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#packages">packages</a>
        <a href="#services">services</a>
        <a href="#gallery">gallery</a>
        <a href="#review">review</a>
        <a href="#contact">contact</a>
        <a href="{{ route('register.view') }}">Register</a>
    </nav>

    <div class="icons">
        <i class="fas fa-search" id="search-btn"></i>
        <i class="fas fa-user" id="login-btn"></i>
    </div>

    <form action="" class="search-bar-container">
        <input type="search" id="search-bar" placeholder="search here...">
        <label for="search-bar" class="fas fa-search"></label>
    </form>
</header>
<div class="login-form-container">
    <i class="fas fa-times" id="form-close"></i>
    <form action="">
        <h3>login</h3>
        <input type="text" class="box" placeholder="User Name">
        <input type="password" class="box" placeholder="Password">
        <input type="submit" value="login now" class="btn">
        {{-- <input type="checkbox" id="remember"> --}}
        {{-- <label for="remember">Remember me</label> --}}
        {{-- <p>forgrt password? <a href="#">click here</a></p> --}}
        {{-- <p>don't have and account? <a href="#">register now</a></p> --}}
    </form>
</div>
