@extends('website.layouts.layout')
@section('content')
@section('title', 'Ml3bna')
<section class="home" id="home">
    <div class="content">
        <h3>welcome to A Ml3bna</h3>
        <p>You Can Book Stadium Through Us</p>
        <a href="#" class="btn">discover more</a>
    </div>

    <div class="video-container">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    <div class="swiper-slide">
                        <img src="{{ asset('uploads/stadium/' . $image->image) }}" alt="">
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

</section>

<section class="packages" id="packages">
    <h1 class="heading">
        <span>S</span>
        <span>t</span>
        <span>a</span>
        <span>d</span>
        <span>i</span>
        <span>u</span>
        <span>m</span>
        <span>s</span>
    </h1>

    <div class="box-container row">
        @foreach ($stadiums as $stadium)
            <div class="box col-md-3">
                <img decoding="async" src="  {{ asset('uploads/stadium/' . $stadium->stadium_image[0]->image) }}"
                    alt="">
                <div class="content">
                    <h3 class="mb-3">{{ $stadium->name }} </h3>
                    <h3><i class="fas fa-map-marker-alt"></i> {{ $stadium->region->name }}
                        - {{ $stadium->region->city->name }} </h3>
                    <p>{!! $stadium->description !!}</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <div class="price"> ${{ $stadium->price }}</div>
                    @if (!Auth::guard('client')->check())
                        <a disabled title="Login In First" class="btn">Book Now</a>
                    @else
                        <a href="{{ route('web.stadium', $stadium->id) }}" class="btn">Book Now</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>






<section class="services" id="services">
    <h1 class="heading">
        <span>s</span>
        <span>e</span>
        <span>r</span>
        <span>v</span>
        <span>i</span>
        <span>c</span>
        <span>e</span>
        <span>s</span>
    </h1>

    <div class="box-container">
        <div class="box">
            <i class="fas fa-hotel"></i>
            <h3>affordable hotels</h3>
            <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry</p>
        </div>
        <div class="box">
            <i class="fas fa-utensils"></i>
            <h3>food and drinks</h3>
            <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry</p>
        </div>
        <div class="box">
            <i class="fas fa-bullhorn"></i>
            <h3>safty guide</h3>
            <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry</p>
        </div>
        <div class="box">
            <i class="fas fa-globe-asia"></i>
            <h3>around the world</h3>
            <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry</p>
        </div>
        <div class="box">
            <i class="fas fa-plane"></i>
            <h3>fastest travel</h3>
            <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry</p>
        </div>
        <div class="box">
            <i class="fas fa-hiking"></i>
            <h3>adventures</h3>
            <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                Lorem Ipsum is simply dummy text of the farhan and typesetting industry</p>
        </div>
    </div>
</section>






<section class="gallery" id="gallery">
    <h1 class="heading">
        <span>g</span>
        <span>a</span>
        <span>l</span>
        <span>l</span>
        <span>e</span>
        <span>r</span>
        <span>y</span>
    </h1>


    <div class="box-container">
        <div class="box">
            <img decoding="async" src="img/g-1.jpg" alt="">
            <div class="content">
                <h3>amazing places</h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <a href="#" class="btn">see more</a>
            </div>
        </div>
        <div class="box">
            <img decoding="async" src="img/g-2.jpg" alt="">
            <div class="content">
                <h3>amazing places</h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <a href="#" class="btn">see more</a>
            </div>
        </div>
        <div class="box">
            <img decoding="async" src="img/g-3.jpg" alt="">
            <div class="content">
                <h3>amazing places</h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <a href="#" class="btn">see more</a>
            </div>
        </div>
        <div class="box">
            <img decoding="async" src="img/g-4.jpg" alt="">
            <div class="content">
                <h3>amazing places</h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <a href="#" class="btn">see more</a>
            </div>
        </div>
        <div class="box">
            <img decoding="async" src="img/g-5.jpg" alt="">
            <div class="content">
                <h3>amazing places</h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <a href="#" class="btn">see more</a>
            </div>
        </div>
        <div class="box">
            <img decoding="async" src="img/g-6.jpg" alt="">
            <div class="content">
                <h3>amazing places</h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <a href="#" class="btn">see more</a>
            </div>
        </div>
        <div class="box">
            <img decoding="async" src="img/g-7.jpg" alt="">
            <div class="content">
                <h3>amazing places</h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <a href="#" class="btn">see more</a>
            </div>
        </div>
        <div class="box">
            <img decoding="async" src="img/g-8.jpg" alt="">
            <div class="content">
                <h3>amazing places</h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <a href="#" class="btn">see more</a>
            </div>
        </div>
        <div class="box">
            <img decoding="async" src="img/g-9.jpg" alt="">
            <div class="content">
                <h3>amazing places</h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <a href="#" class="btn">see more</a>
            </div>
        </div>
    </div>
</section>





<section class="review" id="review">
    <h1 class="heading">
        <span>r</span>
        <span>e</span>
        <span>v</span>
        <span>i</span>
        <span>e</span>
        <span>w</span>
    </h1>
    <div class="swiper mySwiper review-slider">
        <div class="swiper-wrapper wrapper">
            <div class="swiper-slide">
                <div class="box">
                    <img decoding="async" src="img/pic1.png" alt="">
                    <h3>Lalisa Bey</h3>
                    <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                        Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                        Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                        farhan and typesetting industry.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="box">
                    <img decoding="async" src="img/pic2.png" alt="">
                    <h3>Edward Bey</h3>
                    <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                        Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                        Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                        farhan and typesetting industry.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="box">
                    <img decoding="async" src="img/pic3.png" alt="">
                    <h3>Jenna Bey</h3>
                    <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                        Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                        Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                        farhan and typesetting industry.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="box">
                    <img decoding="async" src="img/pic4.png" alt="">
                    <h3>Edward Bey</h3>
                    <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.
                        Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                        Lorem Ipsum is simply dummy text of the farhan and typesetting industry
                        farhan and typesetting industry.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="book" id="book">
    <h1 class="heading">
        <span>b</span>
        <span>o</span>
        <span>o</span>
        <span>k</span>
        <span class="space"></span>
        <span>n</span>
        <span>o</span>
        <span>w</span>
    </h1>

    <div class="row">
        <div class="img">
            <img decoding="async" src="img/book-img.svg" alt="">
        </div>

        <form action="">
            <div class="inputBox">
                <h3>where to</h3>
                <input type="text" placeholder="place name">
            </div>
            <div class="inputBox">
                <h3>how many</h3>
                <input type="number" placeholder="number of guests">
            </div>
            <div class="inputBox">
                <h3>arrivals</h3>
                <input type="date">
            </div>
            <div class="inputBox">
                <h3>leaving</h3>
                <input type="date">
            </div>
            <input type="submit" class="btn" value="book now">
        </form>
    </div>
</section>



<section class="contact" id="contact">
    <h1 class="heading">
        <span>c</span>
        <span>o</span>
        <span>n</span>
        <span>t</span>
        <span>a</span>
        <span>c</span>
        <span>t</span>
    </h1>
    <div class="row">
        <div class="img">
            <img decoding="async" src="img/contact-img.svg" alt="">
        </div>
        <form action="">
            <div class="inputBox">
                <input type="text" placeholder="name">
                <input type="email" placeholder="email">
            </div>
            <div class="inputBox">
                <input type="number" placeholder="number">
                <input type="text" placeholder="subject">
            </div>
            <textarea placeholder="message" name="" cols="30" rows="10"></textarea>
            <input type="submit" class="btn" value="send message">
        </form>
    </div>
</section>





<section class="brand-container">
    <div class="swiper mySwiper brand-slider">
        <div class="swiper-wrapper wrapper">
            <div class="swiper-slide"><img decoding="async" src="img/1.jpg" alt=""></div>
            <div class="swiper-slide"><img decoding="async" src="img/2.jpg" alt=""></div>
            <div class="swiper-slide"><img decoding="async" src="img/3.jpg" alt=""></div>
            <div class="swiper-slide"><img decoding="async" src="img/4.jpg" alt=""></div>
            <div class="swiper-slide"><img decoding="async" src="img/5.jpg" alt=""></div>
            <div class="swiper-slide"><img decoding="async" src="img/6.jpg" alt=""></div>
        </div>
    </div>
</section>



<section class="book" id="book">
    <h1 class="heading">
        <span>b</span>
        <span>o</span>
        <span>o</span>
        <span>k</span>
        <span class="space"></span>
        <span>n</span>
        <span>o</span>
        <span>w</span>
    </h1>

    <div class="row">
        <div class="img">
            <img decoding="async" src="img/book-img.svg" alt="">
        </div>

        <form action="">
            <div class="inputBox">
                <h3>where to</h3>
                <input type="text" placeholder="place name">
            </div>
            <div class="inputBox">
                <h3>how many</h3>
                <input type="number" placeholder="number of guests">
            </div>
            <div class="inputBox">
                <h3>arrivals</h3>
                <input type="date">
            </div>
            <div class="inputBox">
                <h3>leaving</h3>
                <input type="date">
            </div>
            <input type="submit" class="btn" value="book now">
        </form>
    </div>
</section>




@stop()
