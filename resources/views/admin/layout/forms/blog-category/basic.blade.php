<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Title</label><small class="mx-1 text-danger"></small>
                <input type="text" name="title" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $blog_category->catTitle : '' }}">
            </div>
        </form>
    </div>
</div>
