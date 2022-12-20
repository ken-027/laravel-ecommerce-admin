<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Company</label><small class="mx-1 text-danger"></small>
                <input type="text" name="company" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $customer->company_name : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Name</label><small class="mx-1 text-danger"></small>
                <input type="text" name="name" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $customer->name : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Phone</label><small class="mx-1 text-danger"></small>
                <input type="text" name="phone" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $customer->phone : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Email</label><small class="mx-1 text-danger"></small>
                <input type="email" name="email" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $customer->email : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Password</label><small class="mx-1 text-danger"></small>
                <input type="text" name="password" class="form-control form-control-sm mb-1" value="">
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">Status</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" checked name="status" {{ $is_edit ? $customer->status ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="status" {{ $is_edit ? !$customer->status ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Inactive</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
