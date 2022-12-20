<div class="row content p-0 m-0 d-none" id="emailSettings">
    <div class="tab-content">   
            {{-- <h3><span class="me-2" style="font-size: 22px"><i class="bi bi-envelope"></i></span>Mailer</h3> --}}
            <form method="POST" class="form col-lg-6 py-1 position-relative" id="emailForm">
                <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
                <div class="form-group py-2">
                    <label for="" class="form-label">From Name</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->from_name }}" name="emailname">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">From Email</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->from_email }}" name="emailemail">
                </div>
                <div class="form-group form-check py-2 d-flex justify-content-between">
                    <div>
                      <input type="checkbox" class="form-check-input" value="1" {{ $setting_info->display_department_specific_from_email_only_in_order ? 'checked': '' }} name="emaildisplaydepartment" >
                      <label for="" class="form-check-label">Display Department Specific From Email Only In Order</label>
                    </div>
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Mailer</label><small class="mx-1 text-danger"></small>
                    <select id="" class="form-select form-select-sm" name="emailmailer">
                        <option value="mail" {{ $setting_info->mailer_type == 'mail' ? 'selected':'' }}>PHP Mail</option>
                        <option value="smtp" {{ $setting_info->mailer_type == 'smtp' ? 'selected':'' }}>SMTP</option>
                        <option value="sendgrid" {{ $setting_info->mailer_type == 'sendgrid' ? 'selected':'' }}>Send Grid</option>
                    </select>
                </div>
                {{-- <div class="form-group py-2">
                    <button type="submit" class="btn">Update</button>
                </div> --}}
            </form>
    </div>
</div>