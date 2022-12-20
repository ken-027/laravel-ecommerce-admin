<div class="row content p-0 m-0 d-none" id="metaTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="metaForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Meta Title</label><small class="mx-1 text-danger"></small>
                <input type="text" name="metatitle" class="form-control form-control-sm" value="{{ $is_edit ? $blog->meta_title : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Meta Description</label><small class="mx-1 text-danger"></small>
                <textarea name="metadescription" rows="5" class="form-control form-control-sm">{{ $is_edit ? $blog->meta_desc : '' }}</textarea>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Meta Keywords</label><small class="mx-1 text-danger"></small>
                <textarea name="metakeywords" rows="5" class="form-control form-control-sm">{{ $is_edit ? $blog->meta_keywords : '' }}</textarea>
            </div>
        </form>
    </div>
</div>
