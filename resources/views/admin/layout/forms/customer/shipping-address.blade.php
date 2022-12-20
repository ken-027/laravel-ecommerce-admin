<div class="row content p-0 m-0 d-none" id="shippingTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="shippingForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Address Line</label><small class="mx-1 text-danger"></small>
                <textarea name="addressline" rows="5" class="form-control form-control-sm">{{ $is_edit ? $customer->address : '' }}</textarea>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Address Line 2</label><small class="mx-1 text-danger"></small>
                <textarea name="addressline2" rows="5" class="form-control form-control-sm">{{ $is_edit ? $customer->address2 : '' }}</textarea>           
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">City</label><small class="mx-1 text-danger"></small>
                <input type="text" name="city" class="form-control form-control-sm" value="{{ $is_edit ? $customer->city : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">State</label><small class="mx-1 text-danger"></small>
                <input type="text" name="state" class="form-control form-control-sm" value="{{ $is_edit ? $customer->state : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Postal Code</label><small class="mx-1 text-danger"></small>
                <input type="text" name="postalcode" class="form-control form-control-sm" value="{{ $is_edit ? $customer->postcode : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <div class="form-group">
                    <input name="sendoccasionaloffer" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $customer->occasional_special_offers ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Send me Occasional Special Offers</label>
                </div>
                <div class="form-group">
                    <input name="sendimportantsms" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $customer->important_sms_notifications ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Semd me Important SMS Notifiactions</label>
                </div>
            </div>
        </form>
    </div>
</div>
