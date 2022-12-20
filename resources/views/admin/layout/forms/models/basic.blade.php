<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Title</label><small class="mx-1 text-danger"></small>
                <input type="text" name="title" class="form-control form-control-sm" value="{{ $is_edit ? $mobile->title : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Category</label><small class="mx-1 text-danger"></small>
                <select id="modelSelectCategory" class="form-select form-select-sm" name="category">
                    <option value="">- Select Category -</option>
                    @foreach ($categories as $category)
                        <option value="{{ encrypt($category->id) }}" {{ $is_edit ? $category->id == $mobile->cat_id ? 'selected' : '' : '' }}>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Device</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="device">
                    <option value="">- Select Device -</option>
                    @foreach ($devices as $device)
                        <option value="{{ encrypt($device->id) }}" {{ $is_edit ? $device->id == $mobile->device_id ? 'selected' : '' : '' }}>{{ $device->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Brand</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="brand">
                    <option value="">- Select Brand -</option>
                    @foreach ($brand as $brand_item)
                        <option value="{{ encrypt($brand_item->id) }}" {{ $is_edit ? $brand_item->id == $mobile->brand_id ? 'selected' : '' : '' }}>{{ $brand_item->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label class="form-label" for="customFile" class="col-form-label">Model Picture</label><small
                    class="mx-1 text-danger"></small>
                <input type="file" name="icon" class="form-control form-control-sm" id="logoFinder"
                    file="true" />
            </div>
            @if (!empty($mobile->model_img) || !$is_edit)
                <div class="form-group col-lg-3 mb-2 mt-0 {{ !$is_edit ? 'd-none':'' }}">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail"><img class="form-control" id="output"
                                alt=" Image display here!"
                                src="{{ $is_edit ? asset('storage/models/' . base64_encode($mobile->id) . '/' . $mobile->model_img) : '' }}"
                                width="200"></div>
                        <div class="fileupload-preview fileupload-exists fileupload-large flexible thumbnail"></div>
                    </div>
                </div>
            @endif
            <div class="form-group py-2">
                <label for="" class="form-label">Description</label>
                <div class="editor-container" style="">
                    <textarea id="" class="ckeEditor" name="description">{{ $is_edit ? htmlspecialchars_decode($mobile->description) : '' }}</textarea>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Searchable Words (Comma Separated)</label><small class="mx-1 text-danger"></small>
                <textarea name="searchablewords" rows="5" class="form-control form-control-sm">{{ $is_edit ? $mobile->searchable_words : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">Publish</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" {{ $is_edit ? $mobile->published ? 'checked' : '' : 'checked'}} name="publish" />
                        <label class="form-check-label" for="flexRadioDefault1">yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" {{ $is_edit ? !$mobile->published ? 'checked' : '' : ''}} name="publish" />
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