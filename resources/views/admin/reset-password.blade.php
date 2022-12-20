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
      <form action="/account/submit-password" class="form w-100 m-auto p-2 py-4" method="POST"  id="resetPasswordForm">
        @csrf
        <input type="hidden" name="user" value="{{ encrypt($user_info->id) }}">
        <div class="form-group py-2 title text-center">
          <div id="alertLoginError" class="alert alert-danger d-none" role="alert"></div>
          <div for="" class="h5 text-center">Welcome to MacMetro</div>
          <label for="" class="h3">Account Reset Password</label>
        </div>
        <div class="form-group py-3">
          <label for="" class="control-label mb-1">New Password</label><small class="mx-1 text-danger"></small>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <span class="bi bi-envelope"></span> 
              </span>
            </div>
            <input type="password" id="password" name="password" class="form-control form-control-sm" aria-describedby="basic-addon1" value="">
          </div>
          <div class="mx-1">
              <input type="checkbox" class="form-check-input" id="showPassword">
              <label for="" class="form-check-label">show password</label>
          </div>
        </div>
        <div class="form-group py-3">
          <label for="" class="control-label mb-1">Confirm New Password</label><small class="mx-1 text-danger confirm-password"></small>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">
                <span class="bi bi-envelope"></span> 
              </span>
            </div>
            <input type="password" id="confirmPassword" name="confirmpassword" class="form-control form-control-sm" aria-describedby="basic-addon1" value="">
          </div>
        </div>
        <div class="">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

@include('include.footer')