<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Promo Name</label><small class="mx-1 text-danger"></small>
                <input type="text" name="promoname" class="form-control form-control-sm" value="{{ $is_edit ? $promo->name : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Promo Code</label><small class="mx-1 text-danger"></small>
                <input type="text" name="promocode" class="form-control form-control-sm" value="{{ $is_edit ? $promo->promocode : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label class="form-label" for="customFile" class="col-form-label">Image</label><small class="mx-1 text-danger"></small>
                <input type="file" name="icon" class="form-control form-control-sm" id="logoFinder" file="true" />
            </div>
            @if (!empty($promo->image) || !$is_edit)
                <div class="form-group col-lg-3 mb-2 mt-0 {{ !$is_edit ? 'd-none':'' }}">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail"><img class="form-control" id="output"
                                src="{{ $is_edit ? asset('/storage/promo/' . base64_encode($promo->id) . '/' . $promo->image) : '' }}" width="200" alt="image display here"></div>
                        <div class="fileupload-preview fileupload-exists fileupload-large flexible thumbnail"></div>
                    </div>
                </div>
                {{-- <div class="form-group py-2">
                    <button type="button" class="btn">Remove</button>
                </div> --}}
            @endif
            <div class="form-group">
                <label for="" class="form-label">Description</label>
                <div class="editor-container" style="">
                    <textarea id="ckeBrand" class="ckeEditor" name="description">{{  $is_edit ? htmlspecialchars_decode($promo->description) : '' }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">Status</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" {{  $is_edit ? $promo->status ? 'checked' : '' : 'checked' }} name="status" />
                        <label class="form-check-label" for="flexRadioDefault1">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" {{  $is_edit ? !$promo->status ? 'checked' : '' : '' }} name="status" />
                        <label class="form-check-label" for="flexRadioDefault2">Inactive</label>
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
