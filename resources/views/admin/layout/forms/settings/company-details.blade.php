<div class="row content p-0 m-0 d-none" id="companyDetailsSettings">
    <div class="tab-content position-relative">   
            {{-- <h3><span class="me-2" style="font-size: 22px"><i class="bi bi-building"></i></span>Company Details</h3> --}}
            <form method="POST" class="form col-lg-6 py-1 position-relative" id="companyDetailsForm">
                <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
        {{-- @csrf --}}
                <div class="form-group py-2">
                    <label for="" class="form-label">Company Name</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->company_name }}" name="companycompany">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Address</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->company_address }}" name="companyaddress">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">City</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->company_city }}" name="companycity">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">State</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->company_state }}" name="companystate">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Country</label><small class="mx-1 text-danger"></small>
                    <input type="text" class="form-control form-control-sm" value="{{ $setting_info->company_country }}" name="companycountry">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Zipcode</label><small class="mx-1 text-danger"></small>
                    <input type="number" class="form-control form-control-sm" value="{{ $setting_info->company_zipcode }}" name="companyzipcode">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Phone</label><small class="mx-1 text-danger"></small>
                    <input type="number" class="form-control form-control-sm" value="{{ $setting_info->company_phone }}" name="companyphone">
                </div>
                {{-- <div class="form-group py-2">
                    <button type="submit" class="btn">Update</button>
                </div> --}}
        </form>
    </div>
</div>