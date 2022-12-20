<div class="row content p-0 m-0 d-none" id="typeTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="typeForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            @if (!empty($category_only))
                <div class="form-group py-2 col-lg-6">
                    <label for="" class="form-label">Type Title</label><small class="mx-1 text-danger"></small>
                    <input type="text" name="typetitle" class="form-control form-control-sm" value="{{ $is_edit ? $category->type_title : '' }}">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Type Tooltip</label>
                    <div class="editor-container" style="">
                        <textarea id="" class="ckeEditor" name="description">{{ $is_edit ? htmlspecialchars_decode($category->tooltip_watchtype) : '' }}</textarea>
                    </div>
                </div>
            @endif
            <label for="" class="form-label">Add Type</label><small class="mx-1 text-danger"></small>
            @if (!count($category_attributes->types))
                <div class="cloning-container my-2">
                    <div class="form-group row col-12 justify-content-between">
                        <label for="" class="form-label">Type</label><small class="mx-1 text-danger"></small>
                        <div class="form-group my-2 pe-0 col-lg-6">
                            <input type="text" name="typename[]" class="form-control form-control-sm" value="">
                        </div>
                        <div class="form-group row my-2 col-lg-6">
                        <select id="" class="form-select form-select-sm" name="typestatus[]">
                                <option value="1" selected>Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>
                        <div class="form-group pb-3">
                            <button type="button" class="btn remove-cloned"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>    
                </div>
            @endif
            @foreach ($category_attributes->types as $type)
                <div class="cloning-container my-2">
                    <div class="form-group row col-12 justify-content-between">
                        <label for="" class="form-label">Type</label><small class="mx-1 text-danger"></small>
                        <div class="form-group my-2 pe-0 col-lg-6">
                            <input type="text" name="typename[]" class="form-control form-control-sm" value="{{ $type->watchtype_name }}">
                        </div>
                        <div class="form-group row my-2 col-lg-6">
                        <select id="" class="form-select form-select-sm" name="typestatus[]">
                                <option value="1" {{ $type->disabled_network == '1' ? 'selected' : '' }}>Enabled</option>
                                <option value="0" {{ $type->disabled_network == '0' ? 'selected' : '' }} >Disabled</option>
                            </select>
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