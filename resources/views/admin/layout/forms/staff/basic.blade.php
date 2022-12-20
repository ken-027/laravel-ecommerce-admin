<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Username</label><small class="mx-1 text-danger"></small>
                <input type="text" name="username" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $staff->username : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Email</label><small class="mx-1 text-danger"></small>
                <input type="text" name="email" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $staff->email : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Password</label><small class="mx-1 text-danger"></small>
                <input type="password" name="password" id="changePassword" class="form-control form-control-sm mb-1" value="">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Confirm Password</label><small class="mx-1 text-danger"></small>
                <input type="password" name="confirmpassword" id="retypePassword" class="form-control form-control-sm mb-1" value="">
            </div>

            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Select Group</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="group">
                    <option value="" {{ !$is_edit ? 'selected' : '' }}>- Select Group -</option>
                    @foreach ($staff_groups as $staff_group) }}
                        <option value="{{ encrypt($staff_group->id) }}" {{ $is_edit ? $staff_group->id == $staff->group_id ? 'selected' : '' : '' }}>{{ $staff_group->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">Status</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" checked name="status" {{ $is_edit ? $staff->status ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="status" {{ $is_edit ? !$staff->status ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Inactive</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
