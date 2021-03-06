@extends('index')
@section('content')
    @php
    function substr_word($str, $limit)
    {
        if (stripos($str, ' ')) {
            $ex_str = explode(' ', $str);
            $str_s = '';
            if (count($ex_str) > $limit) {
                for ($i = 0; $i < $limit; $i++) {
                    $str_s .= $ex_str[$i] . ' ';
                }
                return $str_s . ' ...';
            } else {
                return $str;
            }
        } else {
            return $str;
        }
    }
    @endphp
    <!--================ Hero banner start =================-->
    <section class="hero-banner">
        <div class="container">
            <div class="row no-gutters align-items-center pt-60px">
                <div class="col-5 d-none d-sm-block">
                    <div class="hero-banner__img">
                        <img class="img-fluid" src="{{ asset('assets/img/home/hero-banner.png') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
                    <div class="hero-banner__content">
                        <h4>Shop is fun</h4>
                        <h1>Browse Our Premium Product</h1>
                        <p>Us which over of signs divide dominion deep fill bring they're meat beho upon own earth
                            without morning
                            over third. Their male dry. They are great appear whose land fly grass.</p>
                        <a class="button button-hero" href="#">Browse Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero banner start =================-->

    <!--================ Hero Carousel start =================-->
    <section class="section-margin mt-0">
        <div class="owl-carousel owl-theme hero-carousel">
            <div class="hero-carousel__slide">
                <img src="{{ asset('assets/img/home/hero-slide1.png') }}" alt="" class="img-fluid">
                <a href="#" class="hero-carousel__slideOverlay">
                    <h3>Wireless Headphone</h3>
                    <p>Accessories Item</p>
                </a>
            </div>
            <div class="hero-carousel__slide">
                <img src="{{ asset('assets/img/home/hero-slide2.png') }}" alt="" class="img-fluid">
                <a href="#" class="hero-carousel__slideOverlay">
                    <h3>Wireless Headphone</h3>
                    <p>Accessories Item</p>
                </a>
            </div>
            <div class="hero-carousel__slide">
                <img src="{{ asset('assets/img/home/hero-slide3.png') }}" alt="" class="img-fluid">
                <a href="#" class="hero-carousel__slideOverlay">
                    <h3>Wireless Headphone</h3>
                    <p>Accessories Item</p>
                </a>
            </div>
        </div>
    </section>
    <!--================ Hero Carousel end =================-->

    <!-- ================ trending product section start ================= -->
    <section class="section-margin calc-60px">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>S???n ph???m</p>
                <h2><span class="section-intro__style">B??n ch???y nh???t</span></h2>
            </div>
            <div class="row">
                @if(!empty($bestseller))
                    @foreach ($bestseller as $value)
                        <div class="col-md-6 col-lg-4 col-xl-3" title="{{ $value->name }}">
                            <div class="card text-center card-product">
                                <div class="card-product__img">
                                    @if(($value->gender_product) == 1)
                                        <a href="{{ route('men.show', $value->id) }}" class="update-view" data-url="{{ route('men.update', $value->id) }}" style="width: 100%">
                                    @elseif(($value->gender_product) == 2)
                                        <a href="{{ route('women.show', $value->id) }}" class="update-view" data-url="{{ route('women.update', $value->id) }}" style="width: 100%">
                                    @endif
                                            <img class="card-img" src="{{ asset('storage/images/product/'.$value->main_image) }}" alt="">
                                        </a>
                                    <ul class="card-product__imgOverlay">
                                        <li>
                                            @if(($value->gender_product) == 1)
                                                <button type="button" class="modal-product" data-toggle="modal" data-target="#exampleModalCenter" data-url="{{ route('men.edit', $value->id) }}"><i class="ti-search"></i></button>
                                            @elseif(($value->gender_product) == 2)
                                                <button type="button" class="modal-product" data-toggle="modal" data-target="#exampleModalCenter" data-url="{{ route('women.edit', $value->id) }}"><i class="ti-search"></i></button>
                                            @endif
                                        </li>
                                        <li>
                                            <button><i class="ti-shopping-cart"></i></button>
                                        </li>
                                        <li>
                                            <button><i class="ti-heart"></i></button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    @if(($value->gender_product) == 1)
                                        <a href="{{ route('men.show', $value->id) }}" class="update-view" data-url="{{ route('men.update', $value->id) }}" style="position: relative;">
                                    @elseif(($value->gender_product) == 2)
                                        <a href="{{ route('women.show', $value->id) }}" class="update-view" data-url="{{ route('women.update', $value->id) }}" style="position: relative;">
                                    @endif
                                            <h4 class="card-product__title">{{ substr_word($value->name, 6) }}</h4>
                                        </a>
                                        @if(($value->status) == 1)
                                            @if(($value->sale) != 0)
                                                <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Gi???m gi?? {{ $value->sale }}%</p>
                                            @else
                                                <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">M???i</p>
                                            @endif
                                        @elseif(($value->status) == 3)
                                            @if(($value->sale) != 0)
                                                <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Gi???m gi?? {{ $value->sale }}%</p>
                                            @else
                                                <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">B??n ch???y</p>
                                            @endif
                                        @elseif(($value->status) == 4)
                                            @if(($value->sale) != 0)
                                                <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Gi???m gi?? {{ $value->sale }}%</p>
                                            @endif
                                        @elseif(($value->status) == 5)
                                            <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">H???t h??ng</p>
                                        @else
                                        @endif
                                    <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                        @if(($value->sale) != 0)
                                        <del><p class="card-product__price" style="font-size: 14px">{{ number_format($value->price, 0, '', '.') }} VND</p></del>
                                        @endif
                                        <p class="card-product__price">@php $total = ($value->price) * ((100 - ($value->sale)) / 100) @endphp  {{ number_format($total, 0, '', '.') }} VND</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- ================ trending product section end ================= -->


    <!-- ================ offer section start ================= -->
    <section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px"
        data-top-bottom="background-position: 0 20px">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="offer__content text-center">
                        <h3>Up To 50% Off</h3>
                        <h4>Winter Sale</h4>
                        <p>Him she'd let them sixth saw light</p>
                        <a class="button button--active mt-3 mt-xl-4" href="#">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ offer section end ================= -->

    <!-- ================ Best Selling item  carousel ================= -->
    <section class="section-margin calc-60px">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>S???n ph???m</p>
                <h2><span class="section-intro__style">Gi???m gi?? s???c</span></h2>
            </div>
            <div class="owl-carousel owl-theme" id="bestSellerCarousel">
                {{-- @if(!empty($discount)) --}}
                    @foreach ($discount as $value)
                        <div class="card text-center card-product">
                            <div class="card-product__img">
                                @if(($value->gender_product) == 1)
                                    <a href="{{ route('men.show', $value->id) }}" class="update-view" data-url="{{ route('men.update', $value->id) }}" style="width: 100%; position: relative;">
                                @elseif(($value->gender_product) == 2)
                                    <a href="{{ route('women.show', $value->id) }}" class="update-view" data-url="{{ route('women.update', $value->id) }}" style="width: 100%; position: relative;">
                                @endif
                                        <img class="card-img" src="{{ asset('storage/images/product/'.$value->main_image) }}" alt="">
                                    </a>
                                    @if(($value->status) == 1)
                                        @if(($value->sale) != 0)
                                            <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Gi???m gi?? {{ $value->sale }}%</p>
                                        @else
                                            <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">M???i</p>
                                        @endif
                                    @elseif(($value->status) == 3)
                                        @if(($value->sale) != 0)
                                            <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Gi???m gi?? {{ $value->sale }}%</p>
                                        @else
                                            <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">B??n ch???y</p>
                                        @endif
                                    @elseif(($value->status) == 4)
                                        @if(($value->sale) != 0)
                                            <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">Gi???m gi?? {{ $value->sale }}%</p>
                                        @endif
                                    @elseif(($value->status) == 5)
                                        <p style="position: absolute; top: 0; right: 0; background: #fff; color: red; font-weight: bold;">H???t h??ng</p>
                                    @else
                                    @endif
                                <ul class="card-product__imgOverlay">
                                    <li>
                                        @if(($value->gender_product) == 1)
                                            <button type="button" class="modal-product" data-toggle="modal" data-target="#exampleModalCenter" data-url="{{ route('men.edit', $value->id) }}"><i class="ti-search"></i></button>
                                        @elseif(($value->gender_product) == 2)
                                            <button type="button" class="modal-product" data-toggle="modal" data-target="#exampleModalCenter" data-url="{{ route('women.edit', $value->id) }}"><i class="ti-search"></i></button>
                                        @endif
                                    </li>
                                    <li>
                                        <button><i class="ti-shopping-cart"></i></button>
                                    </li>
                                    <li>
                                        <button><i class="ti-heart"></i></button>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                @if(($value->gender_product) == 1)
                                    <a href="{{ route('men.show', $value->id) }}" class="update-view" data-url="{{ route('men.update', $value->id) }}">
                                @elseif(($value->gender_product) == 2)
                                    <a href="{{ route('women.show', $value->id) }}" class="update-view" data-url="{{ route('women.update', $value->id) }}">
                                @endif
                                        <h4 class="card-product__title">{{ substr_word($value->name, 6) }}</h4>
                                    </a>
                                <div style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                    @if(($value->sale) != 0)
                                    <del><p class="card-product__price" style="font-size: 14px">{{ number_format($value->price, 0, '', '.') }} VND</p></del>
                                    @endif
                                    <p class="card-product__price">@php $total = ($value->price) * ((100 - ($value->sale)) / 100) @endphp  {{ number_format($total, 0, '', '.') }} VND</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                {{-- @endif --}}
            </div>
        </div>
    </section>
    
    <!-- ================ Best Selling item  carousel end ================= -->

    <!-- ================ Blog section start ================= -->
    <section class="blog">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>Tin t???c</p>
                <h2><span class="section-intro__style">B??i vi???t m???i</span></h2>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="card card-blog">
                        <div class="card-blog__img">
                            <img class="card-img rounded-0" src="{{ asset('assets/img/blog/blog1.png') }}" alt="">
                        </div>
                        <div class="card-body">
                            <ul class="card-blog__info">
                                <li><a href="#">By Admin</a></li>
                                <li><a href="#"><i class="ti-comments-smiley"></i> 2 Comments</a></li>
                            </ul>
                            <h4 class="card-blog__title"><a href="single-blog.html">The Richland Center Shooping
                                    News and weekly shooper</a></h4>
                            <p>Let one fifth i bring fly to divided face for bearing divide unto seed. Winged
                                divided light Forth.</p>
                            <a class="card-blog__link" href="#">Read More <i class="ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="card card-blog">
                        <div class="card-blog__img">
                            <img class="card-img rounded-0" src="{{ asset('assets/img/blog/blog2.png') }}" alt="">
                        </div>
                        <div class="card-body">
                            <ul class="card-blog__info">
                                <li><a href="#">By Admin</a></li>
                                <li><a href="#"><i class="ti-comments-smiley"></i> 2 Comments</a></li>
                            </ul>
                            <h4 class="card-blog__title"><a href="single-blog.html">The Shopping News also offers
                                    top-quality printing services</a></h4>
                            <p>Let one fifth i bring fly to divided face for bearing divide unto seed. Winged
                                divided light Forth.</p>
                            <a class="card-blog__link" href="#">Read More <i class="ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="card card-blog">
                        <div class="card-blog__img">
                            <img class="card-img rounded-0" src="{{ asset('assets/img/blog/blog3.png') }}" alt="">
                        </div>
                        <div class="card-body">
                            <ul class="card-blog__info">
                                <li><a href="#">By Admin</a></li>
                                <li><a href="#"><i class="ti-comments-smiley"></i> 2 Comments</a></li>
                            </ul>
                            <h4 class="card-blog__title"><a href="single-blog.html">Professional design staff and
                                    efficient equipment you???ll find we offer</a></h4>
                            <p>Let one fifth i bring fly to divided face for bearing divide unto seed. Winged
                                divided light Forth.</p>
                            <a class="card-blog__link" href="#">Read More <i class="ti-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ Blog section end ================= -->

    <!-- ================ Subscribe section start ================= -->
    <section class="subscribe-position">
        <div class="container">
            <div class="subscribe text-center">
                <h3 class="subscribe__title">Get Update From Anywhere</h3>
                <p>Bearing Void gathering light light his eavening unto dont afraid</p>
                <div id="mc_embed_signup">
                    <form target="_blank"
                        action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                        method="get" class="subscribe-form form-inline mt-5 pt-1">
                        <div class="form-group ml-sm-auto">
                            <input class="form-control mb-1" type="email" name="EMAIL" placeholder="Enter your email"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '">
                            <div class="info"></div>
                        </div>
                        <button class="button button-subscribe mr-auto mb-1" type="submit">Subscribe Now</button>
                        <div style="position: absolute; left: -5000px;">
                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>
    <!-- ================ Subscribe section end ================= -->
        
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1140px">
            <div class="modal-content" id="view-modal">
            
            </div>
        </div>
    </div>
@endsection

@section('ajax')
<script>
    $(document).on('click', '.update-view', function(){
        var url = $(this).attr('data-url');
        if(url != ''){
            $.ajax({
                type: "PATCH",
                url: url,
                success: function () {
                }
            });
        }
    });

    $(document).on('click', '.modal-product', function(){
        var url = $(this).attr('data-url');
        if(url != ''){
            $.ajax({
                type: "GET",
                url: url,
                // data: { view: view },
                dataType: "html",
                success: function (data) {
                    $('#view-modal').html(data);
                }
            });
        }
    });
</script>
@endsection