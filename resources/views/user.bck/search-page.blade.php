@extends('include.app')
@section('content')
    <section id="tell_us_phone" class="bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center tell-us-phone clearfix">
                        <h1 class="h1 border-line">SELL YOUR  DEVICE</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-grey">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-3">
                    <form id="form-search" action="{{ route('app.search') }}" method="get">
                        <div class="search-wrapper">
                            <input type="search" name="keyword"  placeholder="Search Here" value="{{ $keyword }}">
                            <span class="c-dark search-close-icon hidden" onclick="hideSeachIcon(this)"><i class="fa fa-times"></i></span>
                            <span class="c-dark" onclick="document.getElementById('form-search').submit();"><i class="fa fa-search"></i></span>
                        </div>
                    </form>                        
                    <div class="list-contianer mt-4">
                        <div class="panel no-shadow not-rounded">
                            <div class="panel-header">
                                <div class="flex items-center space-between">                                    
                                    <h5 class="c-dark">Devices Type</h5>
                                    {{-- <span class="c-dark"><i class="fa fa-angle-down"></i></span> --}}
                                </div>
                            </div>
                            <ul class="list">
                                <li class="c-dark"><a href="{{ route('sell.your-devices') }}" >All</a></li>
                                @foreach ($devices as $device)
                                        <li class="c-dark"><a href="{{ route('sell.your-device.id',[ encrypt($device->id) ]) }}" >{{$device->title}}</a></li>
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-9">
                    <div class="search-found-wrapper c-dark">{{ $mobiles->count() }} Items found for "{{ $keyword }}"</div>
                    <div class="block brands pt-0 mt-0 clearfix">
                        <ul id="device-list-wrapper" class="box-styled clearfix">
                            @foreach ($mobiles as $mobile)
                                <li>
                                    <a href="sell-samsung-phone/galaxy-s10-plus/455" style="height: 261.188px;">
                                        <div class="brand-image"><img src="/images/mobile/{{$mobile->model_img}}" alt="Galaxy S10 Plus"></div>	<h6 class="h6">{{ $mobile->title }}</h6>
                                    </a>    
                                </li>
                            @endforeach  
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection