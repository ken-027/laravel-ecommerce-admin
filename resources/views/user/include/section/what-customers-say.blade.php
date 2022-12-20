<section id="feedback">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block head border-line black-line mb-0 pb-2 text-center">
                    <div class="h1 mt-5">WHAT OUR CUSTOMERS SAY</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="block feedback pt-5 pb-5 text-center">
                    <div id="feebackSlider" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach (App\Models\Admin\Review::get_all() as $index => $review)
                                <div class="carousel-item {{!$index ? 'active' : ''}}">
                                    <div class="image">
                                        <img loading="lazy" src="{{$review->photo ?: '/images/Avatar.png'}}" alt="{{capitalize_word($review->name)}}" />
                                    </div>
                                    <div class="h4">{{capitalize_word($review->name)}}</div>
                                    <p>{{$review->content}}</p>
                                    <a href="#"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> </a>
                                </div>
                            @endforeach
                            {{-- <div class="carousel-item active">
                                <div class="image">
                                    <img loading="lazy" src="images/Avatar.png" alt="Justin Long" />
                                </div>
                                <div class="h4">Justin Long</div>
                                <p>These guys are who they say they are! The best part is; they offer the highest price you can get around and the pay fast! it was a pleasure doing business with you, MacMetro.com.</p>
                                <a href="#"> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> </a>
                            </div> --}}
                        </div>
                        <a class="carousel-control-prev arrow-box" href="#feebackSlider" role="button" data-bs-slide="prev">
                            <i class="bi bi-chevron-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next arrow-box" href="#feebackSlider" role="button" data-bs-slide="next">
                            <i class="bi bi-chevron-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>