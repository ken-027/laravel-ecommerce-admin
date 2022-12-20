@include('include.header')
@include('include.menu')
<section>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="block head pb-0 mb-0 border-line text-center clearfix">
            <h1 class="h1 border-line clearfix">Reset Your Password</h1>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="block content bulk-sale-form text-center clearfix">
          <form action="{{ route('user.update-password') }}" method="post" id="reset_psw_form" role="form">
            @csrf
            @method('put')
           
            <input type="hidden" name='link' value="{{ url()->current() }}">
            <div class="form-group">
              <label for="username">New Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="username">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="" autocomplete="off">
            </div>
            <div class="form-group">
              <div class="clearfix">
                <a class="btn btn-secondary float-left"  href="{{ route('account.login') }}">RETURN TO LOGIN</a>
                <button type="submit" class="btn btn-primary float-right">SUBMIT</button>
                <input type="hidden" name="reset" id="reset" />
                <input type="hidden" name="t" id="t" value=">" />
              </div>
            </div>
          </form>
            </div>
          </div>
        </div>
      </div>
    </section>

@include('include.footer-page')
@include('include.footer')