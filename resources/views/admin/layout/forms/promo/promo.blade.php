<div class="row content p-0 m-0 d-none" id="promoTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="promoForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label class="form-label" for="" class="col-form-label">Date From</label><small class="mx-1 text-danger"></small>
                <input type="date" name="datefrom" class="form-control form-control-sm" value="{{ $is_edit ? format_date_html($promo->from_date) : '' }}" />
            </div>
            <div class="form-group py-2 col-lg-6">
                <label class="form-label" for="" class="col-form-label">Date To</label><small class="mx-1 text-danger"></small>
                <input type="date" name="dateto" class="form-control form-control-sm" value="{{ $is_edit ? format_date_html($promo->to_date) : '' }}" />
            </div>
            <div class="form-group py-2">
                <div class="py-1">
                    <input name="neverexpire" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $promo->never_expire ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Never Expire</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">Surcharge Type</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="fiat" type="radio" {{  $is_edit ? $promo->discount_type == 'fiat' ? 'checked' : '' : 'checked' }} name="discounttype" />
                        <label class="form-check-label" for="flexRadioDefault1">Fiat</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="percentage" type="radio" {{  $is_edit ? $promo->discount_type == 'percentage' ? 'checked' : '' : '' }} name="discounttype" />
                        <label class="form-check-label" for="flexRadioDefault2">Percentage</label>
                    </div>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                @php if($is_edit) $currency_from_edit = $promo->discount_type == 'fiat' ? $currency : '%'  @endphp
                <label for="" class="form-label">Discount (<span class="" id="currency" data-currency="{{ $is_edit ? $currency_from_edit : $currency }}">{{ $is_edit ? $currency_from_edit : $currency }}</span>)</label><small class="mx-1 text-danger"></small>
                <input type="number" name="discount" class="form-control form-control-sm" value="{{ $is_edit ? $promo->discount_type != 'percentage' ?  number_format($promo->discount, 2) : $promo->discount : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <div class="py-1">
                    <input name="activationsamecustomer" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $promo->multiple_act_by_same_cust ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Multiple Activation by Same Customer</label>
                    <div class="my-1 quantity-container {{ $is_edit ? !$promo->multiple_act_by_same_cust ? 'd-none' : '' : '' }}">
                        <label for="" class="form-label">Quantity</label><small class="mx-1 text-danger"></small>
                        <input type="number" name="actsamecustomerquantity" class="form-control form-control-sm" value="{{ $is_edit ? $promo->multi_act_by_same_cust_qty : '' }}">
                    </div>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">How many times can this code be activated?</label><small class="mx-1 text-danger"></small>
                <input type="number" name="timescodeactivated" class="form-control form-control-sm" value="{{ $is_edit ? $promo->act_by_cust : '' }}">
            </div>
            {{-- <div class="form-group py-2 mb-2">
                <button type="submit" class="btn">Save</button>
                <button type="button" class="btn cancel mx-1">Cancel</button>
            </div> --}}
        </form>
    </div>      
