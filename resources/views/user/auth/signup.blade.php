@extends('include.app')
@section('content')
<section class="bg-grey">
   <div class="container"> 
      <div class="panel flex bg-grey  mb-6 mt-5">         
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
                           <a id="animButton1" href="device-type-or-brand"><div class="fancy-button" style="width:230px;height:60px;" data-reactid=".2"><div class="fancy-flipper" data-reactid=".2.0"><div class="fancy-front" style="transform:rotateX(90deg) translateZ( 30px );" data-reactid=".2.0.0"><svg height="60" width="230" viewBox="0 0 230 60" data-reactid=".2.0.0.0"><rect fill="#8BB927" width="100%" height="100%" data-reactid=".2.0.0.0.0"></rect><text class="button-text" transform="matrix(1 0 0 1 115 37.5)" fill="#000000" font-family="'intro_regular'" font-size="17" text-anchor="middle" data-reactid=".2.0.0.0.1">GET OFFER NOW!</text></svg></div><div class="fancy-back" style="transform:rotateX(0deg) translateZ(30px );" data-reactid=".2.0.1"><svg height="60" width="230" viewBox="0 0 230 60" data-reactid=".2.0.1.0"><rect stroke="#8BB927" stroke-width="5" fill="transparent" width="100%" height="100%" data-reactid=".2.0.1.0.0"></rect><text class="button-text" transform="matrix(1 0 0 1 115 37.5)" fill="#8BB927" font-family="'intro_regular'" font-size="17" text-anchor="middle" data-reactid=".2.0.1.0.1">GET OFFER NOW!</text></svg></div></div></div></a>
                           </div>
                  </div>
                  <div>
                     <img style="margin-left: -30px" src="/images/slider/iphone.png" alt="">
                  </div>
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
         <div id="error-wrapper">                     
         </div>
                  <div id="signup-form">
                     <h3 class="h3 c-dark">Register</h3>
                     <form class="bv-form mt-4" action="{{ route('user.signup') }}" method="post" id="signup_form" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                           <label for="exampleInputEmail1" class="text-sm c-dark">FIRST NAME</label>
                           <input type="text" class="form-control" name="first_name" id="first_name" placeholder="" data-bv-field="name" value="{{ old('first_name')}}">
                           <small data-bv-validator="stringLength" validator-for="first_name" class="help-block" style="display: none;">This value is not valid</small>
                        </div>
                        <div class="form-group">
                           <label for="exampleInputEmail1" class="text-sm c-dark">LAST NAME</label>
                           <input type="text" class="form-control" name="last_name" id="last_name" placeholder="" data-bv-field="name" value="{{ old('last_name') }}">
                           <small data-bv-validator="stringLength" validator-for="last_name" class="help-block" style="display: none;">This value is not valid</small><small data-bv-validator="notEmpty" data-bv-validator-for="name" class="help-block" style="display: none;">Please enter your first name and last name</small>
                        </div>
                        <div class="form-group">
                           <label for="exampleInputEmail1" class="text-sm c-dark">EMAIL</label>
                           <input type="text" class="form-control" name="email" id="email" placeholder="" autocomplete="off" data-bv-field="email" value="{{ old('email') }}">
                           <small data-bv-validator="notEmpty" validator-for="email" class="help-block" style="display: none;">Please enter an email address</small><small data-bv-validator="emailAddress" data-bv-validator-for="email" class="help-block" style="display: none;">Please enter a valid email address</small>
                        </div>
                        <div class="form-group">
                           <label for="exampleInputPassword1" class="text-sm c-dark">PASSWORD</label>
                           <input type="password" class="form-control" name="password" id="password" placeholder="" autocomplete="off" data-bv-field="password">
                           <small data-bv-validator="notEmpty" validator-for="password" class="help-block" style="display: none;">Please enter your password.</small><small data-bv-validator="identical" data-bv-validator-for="password" class="help-block" style="display: none;">Password and confirm password values not matched.</small>
                        </div>
                        <div class="form-group">
                           <label for="exampleInputPassword1" class="text-sm c-dark">CONFIRM PASSWORD</label>
                           <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="" autocomplete="off" data-bv-field="confirm_password">
                           <small data-bv-validator="notEmpty" validator-for="password_confirmation" class="help-block" style="display: none;">Please confirm your password.</small><small data-bv-validator="identical" data-bv-validator-for="confirm_password" class="help-block" style="display: none;">Password and confirm password values not matched.</small>
                        </div>
                        <div class="space-between">
                           <span class="text-sm mb-2 pointer c-dark">Already a member? <a href="{{ route('account.login') }}"  id="to-login" class="sm-text mb-3mb-3">Sign In</a></span>
                        </div>  
                        <button id="btn-signup" type="submit" class="btn login-signup col-md-12 btn-lg mb-2">Submit</button>                 
                     </form>
                  </div>                 
               </div>              
      </div>
</div>
</section>
@endsection


