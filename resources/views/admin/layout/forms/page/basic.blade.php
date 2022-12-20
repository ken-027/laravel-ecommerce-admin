<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Select Category</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="category">
                    <option value="" {{ !$is_edit ? 'selected' : '' }}>- Select Category -</option>
                    @foreach ($categories as $category) }}
                        <option value="{{ encrypt($category->id) }}" {{ $is_edit ? $category->id == $page->cat_id ? 'selected' : '' : '' }}>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Select Device</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="device">
                    <option value="" {{ !$is_edit ? 'selected' : '' }}>- Select Device -</option>
                    @foreach ($devices as $device) }}
                        <option value="{{ encrypt($device->id) }}" {{ $is_edit ? $device->id == $page->device_id ? 'selected' : '' : '' }}>{{ $device->title }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Select Device</label><small class="mx-1 text-danger"></small>
                <div class="list-group border devices multi-select" name='devices'>
                    @foreach ($devices as $device)
                        <input type="button" class="list-group-item list-group-item-action px-1 multi-item" data-id="{{ encrypt($device->id) }}" value="{{ $device->title }}">
                    @endforeach
                </div>
            </div> --}}
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Title</label><small class="mx-1 text-danger"></small>
                <input type="text" name="title" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $page->title : '' }}">
                <input name="showtitle" value="1" type="checkbox" class="form-check-input" {{ $is_edit ? $page->show_title ? 'checked' : '' : '' }} />
                <label for="" class="form-check-label">Show Title</label>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Url</label><small class="mx-1 text-danger"></small>
                <input type="text" name="url" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $page->url : '' }}">
                <input name="iscustomurl" value="1" type="checkbox" class="form-check-input" {{ $is_edit ? $page->is_custom_url ? 'checked' : '' : '' }} />
                <label for="" class="form-check-label">Custom Url</label>
                <div class="form-group"></div>
                <input name="opennewwindow" value="1" type="checkbox" class="form-check-input" {{ $is_edit ? $page->is_open_new_window ? 'checked' : '' : '' }} />
                <label for="" class="form-check-label">Is Open New Window</label>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">CSS Class</label><small class="mx-1 text-danger"></small>
                <input type="text" name="cssclass" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $page->css_page_class : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Module Position</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="moduleposition">
                    <option value="none" {{ $is_edit ? $page->module_position == 'none' ? 'selected' : '' : '' }}>None</option>
                    <option value="left" {{ $is_edit ? $page->module_position == 'left' ? 'selected' : '' : '' }}>Left</option>
                    <option value="right" {{ $is_edit ? $page->module_position == 'right' ? 'selected' : '' : '' }}>Right</option>
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Header Image Text</label><small class="mx-1 text-danger"></small>
                <input type="text" name="imagetext" class="form-control form-control-sm" value="{{ $is_edit ? $page->image_text : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label class="form-label" for="customFile" class="col-form-label">Header Image</label><small class="mx-1 text-danger"></small>
                <input type="file" name="headerimage" class="form-control form-control-sm" id="logoFinder"
                    file="true" />
            </div>
            @if (!empty($page->image) || !$is_edit)
                <div class="form-group col-lg-3 mb-2 mt-0 {{ !$is_edit ? 'd-none':'' }}">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail"><img class="form-control" id="output" alt=" Image display here!" src="{{ $is_edit ? asset('storage/pages/' . base64_encode($page->id) . '/' . $page->image) : '' }}" width="200"></div>
                        <div class="fileupload-preview fileupload-exists fileupload-large flexible thumbnail"></div>
                    </div>
                </div>
            @endif
            <div class="form-group py-2">
                <label for="" class="form-label">Description</label>
                <div class="editor-container" style="">
                    <textarea id="" class="ckeEditor" name="description">{{ $is_edit ? $page->content : '' }}</textarea>
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
