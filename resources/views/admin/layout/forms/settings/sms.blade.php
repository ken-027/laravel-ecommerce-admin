<div class="row content p-0 m-0 d-none" id="smsSettings">
    <div class="tab-content">   
        {{-- <h3><span class="me-2" style="font-size: 22px"><i class="bi bi-chat-text"></i></span>SMS</h3> --}}
        <form method="POST" class="form col-lg-6 py-1 position-relative" id="smsForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group">
                <label for="" class="col-form-label">SMS Sending Status</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" name="smsstatus" id="sms_sending_status_on" {{ $setting_info->sms_sending_status ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">On</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="smsstatus" id="sms_sending_status_off" {{ !$setting_info->sms_sending_status ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Off</label>
                    </div>
                    </div>
                </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Twilio Account SID</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->twilio_ac_sid }}" name="smstwilioaccountsid">
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Twilio Account Auth Token</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->twilio_ac_token }}" name="smstwilioaccountauthtoken">
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Twilio Long Code</label><small class="mx-1 text-danger"></small>
                <input type="number" class="form-control form-control-sm" value="{{ $setting_info->twilio_long_code }}" name="smstwiliolongcode">
            </div>
            {{-- <div class="form-group py-2">
                <button type="submit" class="btn">Update</button>
            </div> --}}
        </form>
    </div>
</div>