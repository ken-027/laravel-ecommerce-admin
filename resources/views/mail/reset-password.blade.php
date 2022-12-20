<div class="container" style="        
    width: 75%;
    margin: auto;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    text-align: center;
    position: relative;"
>
    <div class="header" style="
        height: 60px;
        border-radius: 5px 5px 0 0;
        background-image: linear-gradient( #212529, #5d636a);"
    >
        <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="{{ config('app.url') }}" target="_blank">
            <img height="100%" src="{{ config('app.url') }}assets/images/logo.png" class="logo" alt="">
            {{-- <img src="{{ url('') }}/assets/images/logo.png" class="logo" alt=""> --}}
        </a>
    </div>
    <h3>Forgot Password</h3>
    <p>the link will expire in 10 minutes</p>
    <a type="submit" style="
        transition: all 0.5s ease;
        text-decoration: none;
        color: green;
        cursor: pointer;
    " href="{{ config('app.url') }}account/new-password?id={{ encrypt($user_info->id) . '&date=' . encrypt(date('G:i:s m/d/Y',  strtotime('+10 minutes', strtotime(date('G:i:s m/d/Y'))))) }}">click the link to reset your password</a>
    <small style="display: none;">[{{ date('G:i:s m/d/Y') }}]</small>
    <div style="
        padding: 5px;
        margin-top: 10px;
        color: #fff;
        border-radius: 0 0 5px 5px;
        background-image: linear-gradient( #212529, #5d636a);"
    >
        <small>© 2022 MacMetro.com</small>
    </div>
</div>
