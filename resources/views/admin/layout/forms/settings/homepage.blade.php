<div class="row content p-0 m-0 d-none" id="homePageSettings">
    <div class="tab-content">   
        {{-- <h3><span class="me-2" style="font-size: 22px"><i class="bi bi-house"></i></span>Home Page</h3> --}}
        <form method="POST" class="form py-1 position-relative" id="homepageForm">
            <div class="alert d-none text-center position-sticky top-0 col-lg-6" style="z-index: 100" role="alert"></div>
            <div class="form-group">
                <label for="" class="form-label">Process Works & Slider</label>
                <div class="editor-container" style="">
                    <textarea id="editor2" name="" class="ckeEditor">{!! htmlspecialchars_decode($setting_info->home_slider) !!}</textarea>
                </div>
            </div>
            <div class="form-group py-2">
                <div class="py-1">
                    <input name="allowofferpopup" value="1" type="checkbox" class="form-check-input" {{ $setting_info->allow_offer_popup ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Allow Offer Popup</label>
                </div>                   
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Offer Popup Title</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->offer_popup_title }}" name="offerpoptitle">
            </div>
            <div class="form-group mb-2">
                <label for="" class="form-label">Offer Popup Content</label>
                <div class="editor-container" style="">
                    <textarea id="editor3" class="ckeEditor" name="">{!! htmlspecialchars_decode($setting_info->offer_popup_content) !!}</textarea>
                </div>
            </div>
            {{-- <div class="form-group py-2">
                <button type="submit" class="btn">update</button>
            </div> --}}
        </form>
    </div>
</div>