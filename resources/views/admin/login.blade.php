@include('include.header')


<div class="container vh-100 py-lg-5 p-3">
  <div class="row col-12 w-75 h-75 border m-auto">
    <div class="col-sm-12 col-lg-6 p-0">
      <div class="row h-100 w-100 m-0 login-pic">
        <a class="row login-pic" href="/">
          <img src="/assets/images/logo.png" alt="werorg" class="m-auto">
        </a>
      </div>
    </div>
    <div class="col-sm-12 col-lg-6 m-auto login-container p-3">
      <form action="/admin/profile/login" class="form w-100 m-auto p-2 py-4" method="POST"  id="loginForm">
        @csrf
        <div class="form-group py-2 title text-center">
          <div id="alertLoginError" class="alert alert-danger d-none" role="alert">Account does not exist!</div>
          <div for="" class="h5 text-center">Welcome to MacMetro</div>
          <label for="" class="h3">Login</label>
        </div>
        <div class="form-group py-2">
          <label for="" class="control-label mb-1">Email</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <span class="bi bi-envelope"></span> 
              </span>
            </div>
            <input type="email" name="email" class="form-control form-control-sm" aria-describedby="basic-addon1" value="{{ !empty(Cookie::get('email')) ? decrypt(Cookie::get('email')) : '' }}">
          </div>
        </div>
        <div class="form-group py-2">
          <label for="" class="control-label mb-1">Password</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon2">
                <span class="bi bi-key"></span> 
              </span>
            </div>
            <input type="password" name="password" class="form-control form-control-sm" aria-describedby="basic-addon2" value="{{ !empty(Cookie::get('password')) ? decrypt(Cookie::get('password')) : '' }}">
          </div>
        </div>
        <div class="form-group form-check d-flex justify-content-between">
          <div>
            <input type="checkbox" class="form-check-input" name="rememberme" value="1" {{ !empty(Cookie::get('email')) ? 'checked' : '' }}>
            <label for="" class="form-check-label">Remember me</label>
          </div>
          <a class="open-link" href="/account/forgot-password">forgot password?</a>
        </div>
        <div class="">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- <section class="vh-100 login">
    <div class="container py-5 h-100 w-100">
      <div class="row d-flex align-items-center justify-content-center h-100 image-form m-auto shadow bg-white rounded p-0 m-0">
        <div class="col-md-8 col-lg-7 col-xl-6 h-100 m-0 bg-dark">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 ">
          <form>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form1Example13">Email address</label>
              <input type="email" id="form1Example13" class="form-control form-control-sm" />
            </div>
            <!-- Password input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form1Example23">Password</label>
              <input type="password" id="form1Example23" class="form-control form-control-sm" placeholder=""/>
            </div>
            <div class="d-flex justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked/>
                <label class="form-check-label" for="form1Example3"> Remember me </label>
              </div>
              <a href="#!">Forgot password?</a>
            </div>
  
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary ">Sign in</button>
{{--   
            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
            </div> --}}
  
            {{-- <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!" role="button">
              <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
            </a>
            <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!" role="button">
              <i class="fab fa-twitter me-2"></i>Continue with Twitter</a> --}}
  
          {{-- </form>
        </div>
      </div>
    </div>
  </section>  --}}

@include('include.footer')