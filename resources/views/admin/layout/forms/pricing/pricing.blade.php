<div class="row content p-0 m-0" id="pricingTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="pricingForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <h3 for="" class="h-3">{{ ucwords($mobile->title)  }}</h3>
            @if (!count($pricing)) 
                <div class="alert-info no-pricelist">
                    <div class="h4">No Pricelist</div>
                </div>
            @endif
            @foreach ($pricing as $price)
                <div class="form-group col-lg-6 mb-2">
                    <div class="cloning-container p-0 mb-2">
                    @php $id = encrypt($price->id); @endphp
                    <label for="" class="form-label price-title">{{ ucwords($price->name)}}</label><small class="mx-1 text-danger"></small>
                        <div class="container p-0 m-0">
                            @foreach (json_decode($price->price) as $condition_title => $price)
                                <div class="row p-0 m-0">
                                    <div class="col-5">
                                        <label for="" class="form-label">{{ ucwords($condition_title)}}</label><small class="mx-1 text-danger"></small>
                                    </div>
                                    <div class="col">
                                        <input type="number" name="price[{{ $id }}][{{$condition_title}}]" class="form-control form-control-sm my-1" value="{{ $price }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
        <div class="form-group py-2 mb-2">
            {{-- <button type="button" class="btn element-clone"><i class="bi bi-plus-square"></i></button> --}}
        </div>
    </div>
</div>
