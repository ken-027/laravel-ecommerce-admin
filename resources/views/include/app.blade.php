@include('include.header')
<div class="container-fluid position-relative pe-0 " style="padding-left: 0;">   
    <div class="banner d-flex flex-column">
        @include('user.include.menu')
        @yield('content')
    </div>
    @include('user.include.section.footer')
</div>

@include('include.footer')