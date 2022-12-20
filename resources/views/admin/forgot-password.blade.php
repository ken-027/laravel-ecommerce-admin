@include('include.header')


<div class="container vh-100 py-lg-5 p-3">
  <div class="row col-12 w-75 h-75 border m-auto">
    <div class="col-sm-12 col-lg-6 p-0">
      <div class="row h-100 w-100 m-0 login-pic">
        <a class="row login-pic" href="/admin">
          <img src="/assets/images/logo.png" alt="werorg" class="m-auto">
        </a>
      </div>
    </div>
    <div class="col-sm-12 col-lg-6 m-auto login-container p-3">
      <form action="/account/reset-password" class="form w-100 m-auto p-2 py-4" method="POST"  id="forgotPasswordForm">
        @csrf
        <div class="form-group py-2 title text-center">
          <div id="alertLoginError" class="alert d-none" role="alert"></div>
          <div for="" class="h5 text-center">Welcome to MacMetro</div>
          <label for="" class="h3">Forgot Password?</label>
        </div>
        <div class="form-group py-3">
          <label for="" class="control-label mb-1" name='email'>Email</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <span class="bi bi-envelope"></span> 
              </span>
            </div>
            <input type="email" name="email" class="form-control form-control-sm" aria-describedby="basic-addon1" value="{{ !empty(Cookie::get('email')) ? decrypt(Cookie::get('email')) : '' }}">
          </div>
          <small class="px-1">we will send you an email with a link to reset your password</small>
        </div>
        <div class="">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@include('include.footer')