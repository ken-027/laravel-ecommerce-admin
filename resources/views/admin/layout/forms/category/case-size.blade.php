<div class="row content p-0 m-0 d-none" id="caseSizeTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="caseSizeForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            @if (!empty($category_only))
                <div class="form-group py-2 col-lg-6">
                    <label for="" class="form-label">Case Size Title</label><small class="mx-1 text-danger"></small>
                    <input type="text" name="casesizetitle" class="form-control form-control-sm" value="{{ $is_edit ? $category->case_size_title : '' }}">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Case Size Tooltip</label>
                    <div class="editor-container" style="">
                        <textarea id="" class="ckeEditor" name="description">{{ $is_edit ? htmlspecialchars_decode($category->tooltip_case_size) : '' }}</textarea>
                    </div>
                </div>
            @endif
            <label for="" class="form-label">Add Case Size</label><small class="mx-1 text-danger"></small>
            @if (!count($category_attributes->case_sizes))
                <div class="cloning-container my-2">
                    <div class="form-group row col-12 justify-content-between">
                        <div class="form-group my-2 pe-0 col-lg-6">
                            <label for="" class="form-label">Size</label><small class="mx-1 text-danger"></small>
                            <input type="text" name="casesize[]" class="form-control form-control-sm" value="">
                        </div>
                        <div class="form-group pb-3">
                            <button type="button" class="btn remove-cloned"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>    
                </div>
            @endif
            @foreach ($category_attributes->case_sizes as $case_size)
                <div class="cloning-container my-2">
                    <div class="form-group row col-12 justify-content-between">
                        <div class="form-group my-2 pe-0 col-lg-6">
                            <label for="" class="form-label">Size</label><small class="mx-1 text-danger"></small>
                            <input type="text" name="casesize[]" class="form-control form-control-sm" value="{{ $case_size->case_size }}">
                        </div>
                        <div class="form-group pb-3">
                            <button type="button" class="btn remove-cloned"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>    
                </div>
            @endforeach
        </form>
        <div class="form-group py-2 mb-2">
            <button type="button" class="btn element-clone"><i class="bi bi-plus-square"></i></button>
        </div>
    </div>
</div>