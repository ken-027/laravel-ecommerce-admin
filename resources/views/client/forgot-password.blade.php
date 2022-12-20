@include('include.header')
@include('include.menu')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block head pb-0 mb-0 border-line text-center clearfix">
          <h1 class="h1 border-line clearfix">Forgot your password?</h1>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if (session('success'))
          <div class="alert alert-success">{{  session('success') }}</div>
        @endif
        <div class="block content bulk-sale-form text-center clearfix">
        <p>Enter the e-mail address associated with your account, then click "Submit." We'll email you a link to a page where you can easily create a new password.</p>
        <form action="{{ route('user.send_link') }}" method="post" id="lost_psw_form" class="pb-5 mb-5 bv-form">
            @csrf
          <div class="form-group">
            <label for="username">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="" autocomplete="off">
          </div>
          <div class="clearfix"></div>
          <div class="form-group">
              <a class="btn btn-secondary float-left" href="{{ route('account.login') }}">RETURN TO LOGIN</a>
              <button type="submit" class="btn btn-primary float-right">SUBMIT</button>
              <input type="hidden" name="reset" id="reset" />
              <input type="hidden" name="user_id" id="user_id" value="" />
          </div>
          </form>
        </div>
      </div>
    </div>  
  </div>

@include('include.footer-page')
@include('include.footer')