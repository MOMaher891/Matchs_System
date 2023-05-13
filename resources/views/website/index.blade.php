@extends('website.layouts.app')
@section('content')

<section class="home" id="home">
    <div class="content">
        <h3>welcome to A global icon of luxury</h3>
        <p>dicover new places with us, luxury awaits</p>
        <a href="#" class="btn">discover more</a>
    </div>

    <div class="controls">
        <span class="vid-btn active" data-src="img/vid-1.mp4"></span>
        <span class="vid-btn" data-src="img/vid-2.mp4"></span>
        <span class="vid-btn" data-src="img/vid-3.mp4"></span>
        <span class="vid-btn" data-src="img/vid-4.mp4"></span>
        <span class="vid-btn" data-src="img/vid-5.mp4"></span>
    </div>

    <div class="video-container">
        <video src="img/vid-1.mp4" id="video-slider" loop autoplay muted></video>
    </div>

</section>








<section class="packages" id="packages">
    <h1 class="heading">
        <span>p</span>
        <span>a</span>
        <span>c</span>
        <span>k</span>
        <span>a</span>
        <span>g</span>
        <span>e</span>
        <span>s</span>

    </h1>

    <div class="box-container">
        <div class="box">
            <img decoding="async" src="img/p-1.jpg" alt="">
            <div class="content">
                <h3><i class="fas fa-map-marker-alt"></i> mumbai </h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="price"> $90.00 <span>$120.00</span></div>
                <a href="#" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <img decoding="async" src="img/p-2.jpg" alt="">
            <div class="content">
                <h3><i class="fas fa-map-marker-alt"></i> sydney </h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="price"> $90.00 <span>$120.00</span></div>
                <a href="#" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <img decoding="async" src="img/p-3.jpg" alt="">
            <div class="content">
                <h3><i class="fas fa-map-marker-alt"></i> hawaii </h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="price"> $90.00 <span>$120.00</span></div>
                <a href="#" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <img decoding="async" src="img/p-4.jpg" alt="">
            <div class="content">
                <h3><i class="fas fa-map-marker-alt"></i> paris </h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="price"> $90.00 <span>$120.00</span></div>
                <a href="#" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <img decoding="async" src="img/p-5.jpg" alt="">
            <div class="content">
                <h3><i class="fas fa-map-marker-alt"></i> tokyo </h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="price"> $90.00 <span>$120.00</span></div>
                <a href="#" class="btn">book now</a>
            </div>
        </div>

        <div class="box">
            <img decoding="async" src="img/p-6.jpg" alt="">
            <div class="content">
                <h3><i class="fas fa-map-marker-alt"></i> eypt </h3>
                <p>Lorem Ipsum is simply dummy text of the farhan and typesetting industry.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="price"> $90.00 <span>$120.00</span></div>
                <a href="#" class="btn">book now</a>
            </div>
        </div>
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
@endsection