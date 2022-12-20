@extends('include.app')
@section('content')
<section class="bg-grey">
   <div class="container">
      <div class="row items-center justify-content-center">
         <div class="col-md-6">
            <div class="mt-5"  style="min-height: calc(100vh - 662px);">  
               <div class="panel px-4 py-3 mt-2">
                  <h3 class="border-line c-dark">Forgot your password?</h3>
                  <p class="text-sm c-dark">Enter the e-mail address associated with your account, We'll email you a link to a page where you can easily create a new password.</p>
                  <div id="message-wrapper">
                  </div>
                  <form action="{{ route('user.send_link') }}" method="post" id="lost_psw_form" class="mb-2 bv-form">
                     @csrf
                     <div class="form-group">
                        <label for="username" class="text-sm c-dark">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="" autocomplete="off">
                        <small  validator-for="email" class="help-block" style="display: none;">Please enter your email.</small>
                     </div>
                     <div class="clearfix"></div>
                     <div class="space-between">
                        <a class="text-sm" href="{{ route('account.login') }}">RETURN TO LOGIN</a>
                        <button id="btn-send-email" type="submit" class="btn btn-primary">SUBMIT</button>                
                     </div>
                  </form>
               </div>
            </div>
           
         </div>
      </div> 
   </div>
</section>
@endsection