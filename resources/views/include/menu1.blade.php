<div id="top">
   <div class="container">
      <div class="row">
         <div class="col-6 col-sm-3 col-md-4 col-lg-3 col-xl-3 mobile-logo">
            <div class="block logo pr-0 pt-0 mr-0 pb-0 clearfix">
               <a href="/"><img src="/assets/images/logo.png" alt="MacMetro.com"></a>
            </div>
         </div>
         <div class="col-3 col-sm-6 col-md-4 col-lg-6 col-xl-6 mobile-nav">
            <div class="block main-menu clearfix">
               <nav class="navbar navbar-expand-lg">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                  <img src="{{ asset('assets/images/nav-bar.png') }}" alt="">
                  </button>
                  <div class="collapse navbar-collapse" id="navbarMain">
                     <ul>
                        <li class="">
                           <a href="/blog" class="">Blog</a>
                        </li>
                        <li class="dropdown">
                           <a href="/sell" class="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sell <i class="fas fa-chevron-down"></i></a>
                           <div class="clearfix"></div>
                           <ul class="dropdown-menu">
                              <li><a href="/sell/iphone" class=""><span class="icon iphone"></span>iPhone</a></li>
                              <li><a href="/sell/samsung-phone" class=""><span class="icon samsung-phone"></span>Samsung Phone</a></li>
                              <li><a href="/sell/apple-watch" class=""><span class="icon apple-watch"></span>Apple Watch</a></li>
                              <li><a href="/sell/macbook" class=""><span class="icon macBook"></span>MacBook</a></li>
                              <li><a href="/sell/ipad" class=""><span class="icon ipad"></span>iPad</a></li>
                              <li><a href="/sell/samsung-tablet" class=""><span class="icon samsung-tablet"></span>Samsung Tablet</a></li>
                              <li><a href="/sell/android-phone" class=""><span class="icon android-phone"></span>Android Phone</a></li>
                              <li><a href="/sell/surface" class=""><span class="icon surface"></span>Surface</a></li>
                              <li><a href="/sell/laptop" class=""><span class="icon laptop"></span>Laptop</a></li>
                              <li><a href="/sell/android-tablet" class=""><span class="icon android_tablet"></span>Android Tablet</a></li>
                              <li><a href="/sell/samsung-watch" class=""><span class="icon samsung_Watch"></span>Samsung Watch</a></li>
                              <li><a href="/sell/airpods" class=""><span class="icon airpods"></span>AirPods</a></li>
                           </ul>
                        </li>
                        <li class="">
                           <a href="/reviews" class="">Reviews</a>
                        </li>
                        <li class="">
                           <a href="/order-track" class="">Track</a>
                        </li>
                        <li class="">
                           <a href="/support" class="">Support</a>
                        </li>
                        <li class="">
                           <a href="/bulk-sales" class="">Bulk Sales</a>
                        </li>
                        @guest
                           <li class="mobile-menu">
                              <a href="/account" class="login">Login</a>
                           </li> 
                        @endguest
                  
                 
                        
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
         <div class="col-3 col-sm-3 col-md-4 col-lg-3 col-xl-3 mobile-site-menu">
            <div class="block site-menu clearfix">
               <ul>
                  {{-- <li>
                     <a href="/revieworder" class="cart"><img src="{{ asset('assets/images/icons/cart.png') }}" alt="cart">Cart<span>0</span></a>
                  </li> --}}
                  @guest
                     <li>
                        <a href="/account" class="login">Login</a>
                     </li>
                  @endguest
                  @auth
                     <li>
                        <a href="/account" class="login">Account</a>
                     </li>  
                  @endauth
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>