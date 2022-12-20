<div class="row content p-0 m-0 d-none" id="captchaSettings">
    <div class="tab-content">   
            {{-- <h3><span class="me-2" style="font-size: 22px"><i class="bi bi-puzzle"></i></span>Captcha</h3> --}}
            <form class="form py-1 col-lg-6 position-relative" id="captchaForm">
                <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Captcha Key</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $captcha_settings->captcha_key }}" name="captchakey">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Captcha Secret</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $captcha_settings->captcha_secret }}" name="captchasecret">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Captcha Form Settings</label>
                </div>
                <div class="py-1">
                    <input type="checkbox" value="1" name="captchacontactform" class="form-check-input" {{ $captcha_settings->contact_form ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Contact Us Form</label>
                </div>
                <div class="py-1">
                    <input type="checkbox"  value="1" name="captchawriteareviewform" class="form-check-input" {{ $captcha_settings->write_review_form ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Write A Review Form</label>
                </div>
                <div class="py-1">
                    <input type="checkbox" value="1" name="captchabulkorderform" class="form-check-input" {{ $captcha_settings->bulk_order_form ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Bulk Order Form</label>
                </div>
                <div class="py-1">
                    <input type="checkbox" value="1" name="captchaaffiliateform" class="form-check-input" {{ $captcha_settings->affiliate_form ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Affiliate Form</label>
                </div>
                <div class="py-1">
                  <input type="checkbox" value="1" name="captchaloginform" class="form-check-input" {{ $captcha_settings->login_form ? 'checked' : ''}} />
                  <label for="" class="form-check-label">Login Form</label>
                </div>
                <div class="py-1">
                    <input type="checkbox" value="1" name="captchasignupform" class="form-check-input" {{ $captcha_settings->signup_form ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Signup Form</label>
                </div>
                <div class="py-1">
                    <input type="checkbox" value="1" name="captchaordertrackform" class="form-check-input" {{ $captcha_settings->order_track_form ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Order Track Form</label>
                </div>
                <div class="py-1">
                    <input type="checkbox" value="1" name="captchanewsletterform" class="form-check-input" {{ $captcha_settings->newsletter_form ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Newsletter Form</label>
                </div>
                <div class="py-1">
                    <input type="checkbox" value="1" name="captchamissingproductform" class="form-check-input" {{ $captcha_settings->missing_product_form ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Missing Product Form</label>
                </div>
                <div class="py-1">
                    <input type="checkbox" value="1" name="captchaimeinumberbasesearchform" class="form-check-input" {{ $captcha_settings->imei_number_based_search_form ? 'checked' : ''}} />
                    <label for="" class="form-check-label">IMEI Number Based Search Form</label>
                </div>
                {{-- <div class="form-group py-2">
                    <button type="submit" class="btn">Update</button>
                </div> --}}
            </form>
    </div>
</div>