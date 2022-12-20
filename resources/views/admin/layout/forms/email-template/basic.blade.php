<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Template Type</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="templatetype" {{ $is_edit ? $email_template->is_fixed ? 'disabled' : '' : '' }}>
                    <option value="" {{ !$is_edit ? 'selected' : '' }}>- Select Template -</option>
                    @foreach (order_status_list() as $key => $value)
                    @php
                        $opt_val = "order_{$key}_status";
                        $disp_val = "Order {$value} Status";
                    @endphp
                        <option value="{{ $opt_val }}" {{ $is_edit ? $opt_val == $email_template->type ? 'selected' : '' : ''  }}>{{ $disp_val }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Subject</label><small class="mx-1 text-danger"></small>
                <input type="text" name="subject" class="form-control form-control-sm" value="{{ $is_edit ? $email_template->subject : '' }}">
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">SMS Section</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" {{  $is_edit ? $email_template->status ? 'checked' : '' : 'checked' }} name="smssection" />
                        <label class="form-check-label" for="flexRadioDefault1">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" {{  $is_edit ? !$email_template->status ? 'checked' : '' : '' }} name="smssection" />
                        <label class="form-check-label" for="flexRadioDefault2">Inactive</label>
                    </div>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">SMS Content</label><small class="mx-1 text-danger"></small>
                <textarea name="smscontent" rows="5" class="form-control form-control-sm">{{ $is_edit ? $email_template->sms_content : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">Publish</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" {{  $is_edit ? $email_template->status ? 'checked' : '' : 'checked' }} name="publish" />
                        <label class="form-check-label" for="flexRadioDefault1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" {{  $is_edit ? !$email_template->status ? 'checked' : '' : '' }} name="publish" />
                        <label class="form-check-label" for="flexRadioDefault2">No</label>
                    </div>
                </div>
            </div>
            {{-- <div class="form-group py-2 mb-2">
                <button type="submit" class="btn">Save</button>
                <button type="button" class="btn cancel mx-1">Cancel</button>
            </div> --}}
        </form>
    </div>
</div>
