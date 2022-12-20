<section id="brands" class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center head border-line mb-0 clearfix">
                    <div class="h1">SELECT YOUR BRAND</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="block brands clearfix">
                    <ul class="brand_block">
                        @foreach (App\Models\Admin\Brand::get_all() as $brand)
                            <li class="brand_block-cell">
                                <a href="brand/{{$brand->sef_url}}"><img loading="lazy" src="{{asset('storage/brand/' . base64_encode($brand->id) . '/' . $brand->image)}}" alt="{{capitalize_word($brand->title)}}" /></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

