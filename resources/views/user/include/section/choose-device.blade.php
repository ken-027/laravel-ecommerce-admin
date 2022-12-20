<section id="device-type" class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block head text-center clearfix">
                    <div class="h1 border-line mt-4 mb-5">CHOOSE YOUR DEVICE TYPE</div>
                    <form class="form-inline" action="search" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control srch_list_of_model" name="search" id="staticEmail2" placeholder="Search device here" autocomplete="off" />
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="block device-blocks clearfix">
                    <ul>
                        @foreach (App\Models\Admin\Device::get_all() as $device)
                            <li>
                                <a href="/device/{{$device->sef_url}}">
                                    <img loading="lazy" src="{{asset('storage/devices/' . base64_encode($device->id) . '/' . $device->device_img)}}" alt="{{capitalize_word($device->title)}}" />
                                    <h5>{{$device->title}}</h5>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
