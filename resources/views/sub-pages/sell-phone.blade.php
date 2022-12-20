@include('include.header')
@include('include.menu')
<?php 
 $url_sell = url()->current();
?>
<section id="tell_us_phone">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="block text-center tell-us-phone clearfix">
                <h1 class="h1 border-line">SELL YOUR Apple® iPhone</h1>
             </div>
          </div>
       </div>
    </div>
 </section>

 <section>
    <div class="container">
       <div class="row justify-content-center">
          <div class="col-md-12">
             <div class="block brands pt-0 mt-0 clearfix">
                <ul class="box-styled clearfix">
@if (strstr($url_sell, '/sell/iphone'))
    @include('sub-pages.sell.iphone')
@elseif (strstr($url_sell, '/sell/samsung-phone'))
    @include('sub-pages.sell.samsung-phone')
@elseif (strstr($url_sell, '/sell/apple-watch'))
    @include('sub-pages.sell.apple-watch')
@elseif (strstr($url_sell, '/sell/airpods'))
    @include('sub-pages.sell.airpod')
@else
    <div class="text-center">
        <div class="h3">Model not available</div>
    </div>
@endif
                </ul>
             </div>
          </div>
       </div>
    </div>
 </section>

 <section id="about" class="pb-5 white-sec">
    <div class="container">
       <div class="row">
          <div class="col-md-8">
             <div class="block about-head pt-4 mt-5 mb-4 pb-4 clearfix">
                <div class="row">
                   <div class="col-md-5">
                      <h1 class="text-uppercase text-center rating-head border-line">RATINGS</h1>
                      <p class="text-center"><a class="trust_pilot" href="https://www.trustpilot.com"><img class="trust_pilot" src="images/xTrustpilot_logo.png.pagespeed.ic._t1lO17rQQ.png" alt=""></a></p>
                   </div>
                   <div class="col-md-7">
                      <div class="h1 border-line">ABOUT US</div>
                      <div class="h5">We are proudly Texan and a family-owned business.&nbsp;</div>
                      <p>We buy back your <strong>new</strong> and <strong>used phones, tablets, watches,</strong> and <strong>laptops</strong> at unbeatable prices. We have built our reputation from nothing to where we are today by the gaining trust of our customers one at a time. This is why our ratings stand out.</p>
                      <p>Give us the opportunity to earn your business and your trust today, and we assure you smooth-sailing selling experience. We put our word and reputation on the line!</p>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-md-4">
             <div class="block about-why pt-4 mt-5 mb-4 pb-4 clearfix">
                <div class="h1 border-line">WHY US</div>
                <ul>
                   <li>
                      <img src="/assets/images/wepayfirst.png" alt="" class="pa-ws"><br>
                      <div class="yel-line"></div>
                      <p>We Pay Fast</p>
                   </li>
                   <li>
                      <img src="/assets/images/bestoffer.png" alt="" class="pa-ws"><br>
                      <div class="yel-line"></div>
                      <p>Best offer</p>
                   </li>
                   <li>
                      <img src="/assets/images/trust.png" alt=""><br>
                   </li>
                </ul>
             </div>
          </div>
       </div>
    </div>
 </section>

 @include('include.footer-page')
 @include('include.footer')