<div class="row content p-0 m-0 d-none" id="shippingAPISettings">
    <div class="tab-content">   
        {{-- <h3><span class="me-2" style="font-size: 22px"><i class="bi bi-truck"></i></span>Shipping Api</h3> --}}
        <form method="POST" class="form col-lg-6 py-1 position-relative" id="shippingAPIForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2">
                <label for="" class="form-label">Shipping API</label><small class="mx-1 text-danger"></small>
                <select name="shippingapi" id="" class="form-select  form-select-sm">
                    <option value="royal_mail" {{ $setting_info->shipping_api == 'royal_mail' ? 'selected' : '' }}>Royal Mail</option>
                    <option value="easypost" {{ $setting_info->shipping_api == 'easypost' ? 'selected' : '' }}>Easy Post</option>
                </select>
            </div>
            <div class>
                <div class="py-2">
                    <input name="allowshipmentbycustomer" value="1" type="checkbox" class="form-check-input" {{ $setting_info->shipment_generated_by_cust ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Allow shipment Generated to Customer</label>
                </div>          
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Shipping API Key</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->shipping_api_key }}" name="shippingapikey">
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Default Carrier Account</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="usps" type="radio" name="shippingdefaultcarrieraccount" {{ $setting_info->default_carrier_account == 'usps' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">USPS</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="ups" type="radio" name="shippingdefaultcarrieraccount" {{ $setting_info->default_carrier_account == 'ups' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">UPS</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="fedex" type="radio" name="shippingdefaultcarrieraccount" {{ $setting_info->default_carrier_account == 'fedex' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">FedEx</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="dhl" type="radio" name="shippingdefaultcarrieraccount" {{ $setting_info->default_carrier_account == 'dhl' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">DHL</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="other" type="radio" name="shippingdefaultcarrieraccount" {{ $setting_info->default_carrier_account == 'other' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Other</label>
                     </div>
                </div>
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Carrier Account ID</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->carrier_account_id }}" name="shippingcarrieraccountid">
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Shipping Parcel Length</label><small class="mx-1 text-danger"></small>
                <input type="number" class="form-control form-control-sm" value="{{ number_format($setting_info->shipping_parcel_length, 2) }}" name="shippingparcellength">
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Shipping Parcel Width</label><small class="mx-1 text-danger"></small>
                <input type="number" class="form-control form-control-sm" value="{{ number_format($setting_info->shipping_parcel_width, 2) }}" name="shippingparcelwidth">
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Shipping Parcel Height</label><small class="mx-1 text-danger"></small>
                <input type="number" class="form-control form-control-sm" value="{{ number_format($setting_info->shipping_parcel_height, 2) }}" name="shippingparcelheight">
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Shipping Parcel Weight</label><small class="mx-1 text-danger"></small>
                <input type="number" class="form-control form-control-sm" value="{{ number_format($setting_info->shipping_parcel_weight, 2) }}" name="shippingparcelweight">
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Webhook URL</label><small class="mx-1 text-danger"></small>
                <input type="text" readonly class="form-control form-control-sm" value="{{ url('/easypost/hook') }}" name="webhookurl">
            </div>
            {{-- <div class="form-group py-2">
                <button type="submit" class="btn">Update</button>
            </div> --}}
        </form>
    </div>
</div>