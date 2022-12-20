<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Name</label><small class="mx-1 text-danger"></small>
                <input type="text" name="name" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $staff_group->name : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Email</label><small class="mx-1 text-danger"></small>
                <input type="text" name="email" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $staff_group->email : '' }}">
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">Publish</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" checked name="status" {{ $is_edit ? $staff_group->status ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="status" {{ $is_edit ? !$staff_group->status ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">No</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
