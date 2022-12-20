@include('include.header')
@include('user.include.menu')
<section id="tell_us_phone">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center tell-us-phone clearfix">
                    <h1 class="h1 border-line">Sell Your {{capitalize_word($title)}}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="block brands pt-0 mt-0 clearfix">
                    <ul class="box-styled clearfix">
                        @foreach ($models as $model)
                            <li>
                                <a href="/sell/{{strtolower(preg_replace("/[\s-]+/", "-", $model->title))}}/{{base64_encode($model->title.$model->id)}}">
                                    <div class="brand-image">
                                        <img src="{{asset('storage/models/' . base64_encode($model->id) . '/' . $model->model_img)}}" alt="{{capitalize_word($model->title)}}" />
                                    </div>
                                    <h6 class="h6">{{capitalize_word($model->title)}}</h6>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@include('user.include.section.about-us')
@include('user.include.section.footer')
@include('include.footer')