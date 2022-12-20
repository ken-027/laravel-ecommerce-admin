<div class="menu">
    <div id="top">
        <div class="container">
           <div class="row items-center">
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
                             <li>
                                <a href="/sell" class="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sell Your Device</a>
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
                           
                           
                             <li class="mobile-menu">
                                <a href="/account" class="login">Login</a>
                             </li> 
                            
                            
                          </ul>
                       </div>
                    </nav>
                 </div>
              </div>
              <div class="col-3 col-sm-3 col-md-4 col-lg-3 col-xl-3 mobile-site-menu">
                 <div class="block site-menu clearfix">
                    <ul>                    
                    
                       <li>
                          <a href="/revieworder"  class="text-lg">
                           <i class="fas fa-shopping-cart"></i>
                           <span>0</span></a>
                       </li> 

                       @auth
                        <li>
                           <a href="/account"  class="text-lg"><i class="far fa-user"></i></a>  
                        </li>  
                       @endauth 
                       
                       @guest 
                       <li><a href="/account"  class="text-lg">
                          <i class="far fa-user"></i>
                          <span>Login / Register</span></a>
                       </li> 
                    @endguest
                    </ul>
                 </div>
              </div>
           </div>
        </div>
     </div>
</div>