@extends('include.app')
@section('content')

<div class="container-fluid position-relative mb-6"> 
   @include('user.include.section.social-platform')
   @include('user.include.menu')
   <div class="login-container ps-5">
      <div class="panel flex bg-grey mb-6 h-80">         
         <div class="login-content carousel" data-carousel>
               <div data-index="0" class="slide" data-active>
                  <div class="flex items-center" style="margin-top: 50px">
                     <div class="header-text">
                        <h2 class="text-center">Sell your used and unused electronics at ease</h2>
                           <h5 class="text-center flex flex-wrap items-center justify-content-center">
                              <span>WE BUY FOR</span>
                              <span class="percantage ml-2"> 5%</span><span class="ml-2">MORE THAN</span>
                              <span class="ml-2"> ANY COMPETITOR</span>
                              <span class="brand_text ml-2">GUARANTEED</span>
                           </h5>
                           <div class="anim-button-space">
                              <a id="animButton1" href="device-type-or-brand"><div class="fancy-button" style="width:230px;height:60px;" data-reactid=".2"><div class="fancy-flipper" data-reactid=".2.0"><div class="fancy-front" style="transform:rotateX(90deg) translateZ( 30px );" data-reactid=".2.0.0"><svg height="60" width="230" viewBox="0 0 230 60" data-reactid=".2.0.0.0"><rect fill="#282c30" width="100%" height="100%" data-reactid=".2.0.0.0.0"></rect><text class="button-text" transform="matrix(1 0 0 1 115 37.5)" fill="#fff" font-family="'intro_regular'" font-size="17" text-anchor="middle" data-reactid=".2.0.0.0.1">GET OFFER NOW!</text></svg></div><div class="fancy-back" style="transform:rotateX(0deg) translateZ(30px );" data-reactid=".2.0.1"><svg height="60" width="230" viewBox="0 0 230 60" data-reactid=".2.0.1.0"><rect stroke="#282c30" stroke-width="5" fill="transparent" width="100%" height="100%" data-reactid=".2.0.1.0.0"></rect><text class="button-text" transform="matrix(1 0 0 1 115 37.5)" fill="#282c30" font-family="'intro_regular'" font-size="17" text-anchor="middle" data-reactid=".2.0.1.0.1">GET OFFER NOW!</text></svg></div></div></div></a>
                           </div>
                     </div>
                     <div>
                        <img style="margin-left: -30px" src="/images/slider/iphone.png" alt="">
                     </div>
                  </div>
                  <div data-index="1" class="slide">
                     <div class="offer">
                        <div class="title">
                           <h2>GET PAID IN 3 EASY STEPS</h2>
                           <small class="sub-title">WE OFFER A SIMPLER, SAFER WAY TO SELL YOUR PHONE, SMART WATCH, TABLET OR LAPTOP</small>
                        </div>                       
                        <div class="offer-list">
                           <div class="item">
                              <div class="offer-img">
                                 <img src="/images/gadgets.png" alt="">
                              </div>                              
                              <div class="text">
                                 <h5 for="">GET YOUR QUOTE</h5>
                                 <label for="">Select the device(s) you would like to sell and get an instant quote based on the condition.</label>
                              </div> 
                           </div>
   
                           <div class="item">
                              <div class="offer-img">
                                 <img src="/images/shipping.png" alt="">
                              </div>
                              <div class="text">
                                 <h5 for="">SHIP FOR FREE</h5>
                                 <label for="">We provide a free,  pre-paid shipping label with tracking for the electronics you will send to us.</label>
                              </div>                             
                           </div>
   
                           <div class="item">
                              <div class="offer-img">
                                 <img src="/images/get_paid.png" alt="">
                              </div>
                              <div class="text">
                                 <h5 for="">SHIP FOR FREE</h5>
                                 <label for="">After inspection of your device(s), we'll pay you within 2 days via PayPal, Bank Check or Cash in Person.</label>
                              </div>                             
                           </div>
   
                        </div>    
                     </div>
                  </div>
                  <ol class="carousel-indicators">
                     <li data-index="0" class="active"></li>
                     <li data-index="1"></li>                                 
                  </ol>
            </div>            
            <div class="form-box">
               <div id="login-form">
                  <h3>Login</h3>
                  
                  <div id="error-wrapper">
                     
                  </div>
                  <form class="bv-form mt-4" action="{{ route('user.login') }}" method="post" id="login_form" novalidate="novalidate">
                  @csrf
                     <div class="form-group">
                        <label for="username" class="text-sm">EMAIL</label>
                        <input type="text" class="form-control" id="username" validator-field="email" name="email" placeholder="" autocomplete="off" value="{{ isset($email) ? $email : '' }}" data-bv-field="username">
                        <small  validator-for="email" class="help-block" style="display: none;">Please enter an email address</small>                  
                     </div>
                     <div class="form-group">
                        <label for="password" class="text-sm">PASSWORD</label>
                        <input type="password" validator-field="password" class="form-control" id="password" name="password" placeholder="" autocomplete="off" data-bv-field="password">
                        <small  validator-for="password" class="help-block" style="display: none;">Please enter your password.</small>
                     </div>  
                     <div class="space-between mb-2">
                        <a href="{{ route('account.signup') }}" id="to-signup" class="text-sm">Create Account</a>
                        <a href="{{ route('account.forgot-password') }}" class="text-sm">Forgot Password?</a>
                     </div>            
                  
               
                     <button id="btn-login" type="submit"  class="btn login-signup col-md-12 btn-lg mb-5">Login</button>                 
                  </form>
               </div> 
            </div>
         </div>      
      </div>
      </div>
   </div>
</section>


@endsection