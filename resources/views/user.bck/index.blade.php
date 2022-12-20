@include('include.header')
<div class="container-fluid position-relative pe-0">
    @include('user.include.section.social-platform')
    <div class="banner section d-flex flex-column">
        @include('user.include.menu')
        <div class="d-flex slider-images ps-5">
            <div id="carouselExampleIndicators" class="carousel slide slider col-12" data-bs-ride="carousel">
    {{-- <div class="slider-button-container prev"><div class="slider-button prev"><i class="bi bi-chevron-left"></i></div></div> --}}
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    {{-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button> --}}
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="slider-image-container prev">
                            <img src="/images/slider/iphone.png" alt="Iphone">
                        </div>
                        <div class="info col-10">
                            <div class="flex items-center h-100" style="margin-top: 50px">
                                <div class="header-text h-100 description">
                                    <h2 class="text-center">Sell your used and unused electronics at ease</h2>
                                    <h5 class="text-center flex flex-wrap items-center justify-content-center">
                                        <span>WE BUY FOR</span>
                                        <span class="percantage ml-2"> 5%</span><span class="ml-2">MORE THAN</span>
                                        <span class="ml-2"> ANY COMPETITOR</span>
                                        <span class="brand_text ml-2">GUARANTEED</span>
                                    </h5>
                                    <div class="anim-button-space">
                                        <a id="animButton1" href="device-type-or-brand"><div class="fancy-button" style="width:230px;height:60px;" data-reactid=".2"><div class="fancy-flipper" data-reactid=".2.0"><div class="fancy-front" style="transform:rotateX(90deg) translateZ( 30px );" data-reactid=".2.0.0"><svg height="60" width="230" viewBox="0 0 230 60" data-reactid=".2.0.0.0"><rect fill="#fff" width="100%" height="100%" data-reactid=".2.0.0.0.0"></rect><text class="button-text" transform="matrix(1 0 0 1 115 37.5)" fill="#282c30" font-family="'intro_regular'" font-size="17" text-anchor="middle" data-reactid=".2.0.0.0.1">GET OFFER NOW!</text></svg></div><div class="fancy-back" style="transform:rotateX(0deg) translateZ(30px );" data-reactid=".2.0.1"><svg height="60" width="230" viewBox="0 0 230 60" data-reactid=".2.0.1.0"><rect stroke="#fff" stroke-width="5" fill="transparent" width="100%" height="100%" data-reactid=".2.0.1.0.0"></rect><text class="button-text" transform="matrix(1 0 0 1 115 37.5)" fill="#fff" font-family="'intro_regular'" font-size="17" text-anchor="middle" data-reactid=".2.0.1.0.1">GET OFFER NOW!</text></svg></div></div></div></a>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class="slider-image-container next">
                            <img src="/images/slider/Samsong_phone.png" alt="Samsung">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="slider-image-container prev">
                            <img src="/images/slider/surface-pro-6-press-1200x630-c-ar1.91 copy.png" alt="Iphone">
                        </div>
                        <div class="info col-10">
                            <div class="flex items-center h-100" style="margin-top: 50px">
                                <div class="header-text h-100 description">
                                    <h2 class="text-center">Sell your used and unused electronics at ease</h2>
                                    <h5 class="text-center flex flex-wrap items-center justify-content-center">
                                        <span>WE BUY FOR</span>
                                        <span class="percantage ml-2"> 5%</span><span class="ml-2">MORE THAN</span>
                                        <span class="ml-2"> ANY COMPETITOR</span>
                                        <span class="brand_text ml-2">GUARANTEED</span>
                                    </h5>
                                    <div class="anim-button-space">
                                        <a id="animButton1" href="device-type-or-brand"><div class="fancy-button" style="width:230px;height:60px;" data-reactid=".2"><div class="fancy-flipper" data-reactid=".2.0"><div class="fancy-front" style="transform:rotateX(90deg) translateZ( 30px );" data-reactid=".2.0.0"><svg height="60" width="230" viewBox="0 0 230 60" data-reactid=".2.0.0.0"><rect fill="#fff" width="100%" height="100%" data-reactid=".2.0.0.0.0"></rect><text class="button-text" transform="matrix(1 0 0 1 115 37.5)" fill="#282c30" font-family="'intro_regular'" font-size="17" text-anchor="middle" data-reactid=".2.0.0.0.1">GET OFFER NOW!</text></svg></div><div class="fancy-back" style="transform:rotateX(0deg) translateZ(30px );" data-reactid=".2.0.1"><svg height="60" width="230" viewBox="0 0 230 60" data-reactid=".2.0.1.0"><rect stroke="#fff" stroke-width="5" fill="transparent" width="100%" height="100%" data-reactid=".2.0.1.0.0"></rect><text class="button-text" transform="matrix(1 0 0 1 115 37.5)" fill="#fff" font-family="'intro_regular'" font-size="17" text-anchor="middle" data-reactid=".2.0.1.0.1">GET OFFER NOW!</text></svg></div></div></div></a>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class="slider-image-container next">
                            <img src="/images/slider/MacBook-Pro-Transparent-Background-PNG copy.png" alt="Samsung">
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="bi bi-chevron-left" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="bi bi-chevron-right" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                {{-- <div class="slider-button-container next"><div class="slider-button next"><i class="bi bi-chevron-right"></i></div></div> --}}
            </div>
            {{-- <div class="slider-2 col-xl-4">
                image 2
            </div>
            <div class="slider-3 col-xl-4">
                image 3
            </div> --}}
        </div>
    </div>
    @include('user.include.section.choose-device')
    @include('user.include.section.get-paid')
    @include('user.include.section.select-brand')
    @include('user.include.section.what-customers-say')
    @include('user.include.section.about-us')
    @include('user.include.section.location')
    @include('user.include.section.footer')
</div>

@include('include.footer')