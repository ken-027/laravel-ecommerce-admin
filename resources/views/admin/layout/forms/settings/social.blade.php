<div class="row content p-0 m-0 d-none" id="socialSettings">
    <div class="tab-content">   
        <div class="col-lg-6 form">
            {{-- <h3><span class="me-2" style="font-size: 22px"><i class="bi bi-person-badge-fill"></i></span>Links & Login</h3> --}}
            <form method="POST" class="form py-1 position-relative" id="socialForm">
                <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Facebook Link</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->fb_link }}" name="socialfacebook">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Twitter Link</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->twitter_link }}" name="socialtwitter">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">LinkedIn Link</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->linkedin_link }}" name="sociallinkedin">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Youtube Link</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->youtube_link }}" name="socialyoutube">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Msg Link</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->msg_link }}" name="socialmsg">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Instagram Link</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->instagram_link }}" name="socialinstagram">
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label">Social Login</label>
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="1" name="sociallogin" {{ $setting_info->social_login ? 'checked' : '' }} />
                            <label class="form-check-label" for="flexRadioDefault1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="0" name="sociallogin" {{ !$setting_info->social_login ? 'checked' : '' }} />
                            <label class="form-check-label" for="flexRadioDefault2">No</label>
                        </div>
                        </div>
                    </div>
                <div class="form-group">
                    <label for="" class="col-form-label">Social Login Option</label>
                    <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="socialloginoption" value="g_f" {{ $setting_info->social_login_option == 'g_f' ? 'checked' : '' }} />
                            <label class="form-check-label" for="flexRadioDefault1">Google & Facebook</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="socialloginoption" value="g" {{ $setting_info->social_login_option == 'g' ? 'checked' : '' }} />
                            <label class="form-check-label" for="flexRadioDefault2">Google</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="socialloginoption" value="f" {{ $setting_info->social_login_option == 'f' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Facebook</label>
                        </div>
                        </div>
                    </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Google Client ID</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->google_client_id }}" name="socialgoogleclientid">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Google Client Secret</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->google_client_secret }}" name="socialgoogleclientsecret">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Facebook App ID</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->fb_app_id }}" name="socialfacebookappid">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Facebook App Secret</label>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->fb_app_secret }}" name="socialfacebookappsecret">
                </div>
                {{-- <div class="form-group py-2">
                    <button type="submit" class="btn">Update</button>
                </div> --}}
            </form method="POST">
        </div>
    </div>
</div>