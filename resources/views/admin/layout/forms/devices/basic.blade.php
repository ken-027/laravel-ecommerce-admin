<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Title</label><small class="mx-1 text-danger"></small>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $is_edit ? $device->title : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Sef Url</label><small class="mx-1 text-danger"></small>
                <input type="text" name="sefurl" class="form-control form-control-sm" value="{{ $is_edit ? $device->sef_url : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label class="form-label" for="customFile" class="col-form-label">Icon</label><small
                    class="mx-1 text-danger"></small>
                <input type="file" name="devicepicture" class="form-control form-control-sm" id="logoFinder"
                    file="true" />
            </div>
            @if (!empty($device->device_img) || !$is_edit)
                <div class="form-group col-lg-3 mb-2 mt-0 {{ !$is_edit ? 'd-none':'' }}">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail"><img class="form-control" id="output"
                                alt=" Image display here!"
                                src="{{ $is_edit ? asset('storage/devices/' . base64_encode($device->id) . '/' . $device->device_img) : '' }}"
                                width="200"></div>
                        <div class="fileupload-preview fileupload-exists fileupload-large flexible thumbnail"></div>
                    </div>
                </div>
            @endif
            <div class="form-group py-2">
                <label for="" class="form-label">Description</label>
                <div class="editor-container" style="">
                    <textarea id="" class="ckeEditor" name="description">{{ $is_edit ? $device->description : '' }}</textarea>
                </div>
            </div>
            <div class="form-group py-2">
                <div class="py-1">
                    <input name="isdevicepopular" value="1" type="checkbox" class="form-check-input" {{ $is_edit ? $device->popular_device ? 'checked' : '' : '' }} />
                    <label for="" class="form-check-label">Check if device is popular, popular device appear in popular section</label>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">Publish</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" checked name="publish"
                            {{ $is_edit ? $device->published ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="publish"
                            {{ $is_edit ? !$device->published ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">No</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
