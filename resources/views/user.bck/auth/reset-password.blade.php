@extends('include.app')
@section('content')
  <section>
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-6">
            @if (session('success'))
               <div class="alert alert-success">{{  session('success') }}</div>
            @endif
            <div class="panel px-4 py-3 mb-5 mt-5">
               <h3 class="mb-3">Reset Your Password</h3>   
               <div id="message-wrapper">
               </div>        
               <form action="{{ route('user.update-password') }}" method="post" id="reset_psw_form" role="form">
                  @csrf
                  @method('put')               
                  <input type="hidden" name='email' value="{{ $email }}">
                  <div class="form-group">
                     <label for="username">New Password</label>
                     <input type="password" class="form-control" id="password" name="password" placeholder="" autocomplete="off">
                     <small  validator-for="password" class="help-block" style="display: none;">Please enter your email.</small>
                  </div>
                  <div class="form-group">
                     <label for="username">Confirm Password</label>
                     <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="" autocomplete="off">
                     <small  validator-for="password_confirmation" class="help-block" style="display: none;">Please enter your email.</small>
                  </div>                
                  <div class="space-between">
                     <a class="text-sm"  href="{{ route('account.login') }}">RETURN TO LOGIN</a>
                     <button type="submit" class="btn btn-primary ">SUBMIT</button>                   
                  </div>
                  
               </form>
            </div>
         </div>
      </div> 
   </div>
  </section>
@endsection

