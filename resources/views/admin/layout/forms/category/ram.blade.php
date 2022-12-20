<div class="row content p-0 m-0 d-none" id="ramTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="ramForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            @if (!empty($category_only))
                <div class="form-group py-2 col-lg-6">
                    <label for="" class="form-label">Ram Title</label><small class="mx-1 text-danger"></small>
                    <input type="text" name="ramtitle" class="form-control form-control-sm" value="{{ $is_edit ? $category->ram_title : '' }}">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Ram Tooltip</label>
                    <div class="editor-container" style="">
                        <textarea id="" class="ckeEditor" name="description">{{ $is_edit ? htmlspecialchars_decode($category->tooltip_ram) : '' }}</textarea>
                    </div>
                </div>
            @endif
            <label for="" class="form-label">Add Ram</label><small class="mx-1 text-danger"></small>
            @if (!count($category_attributes->rams))
                <div class="cloning-container my-2">
                    <div class="form-group row col-12 justify-content-between">
                        <label for="" class="form-label">Ram</label><small class="mx-1 text-danger"></small>
                        <div class="form-group my-2 pe-0 col-lg-6">
                            <input type="number" name="ramsize[]" class="form-control form-control-sm" value="">
                        </div>
                        <div class="form-group row my-2 col-lg-6">
                            <select id="" class="form-select form-select-sm" name="ramunit[]">
                                <option value="MB">MB</option>
                                <option value="GB" selected>GB</option>
                                <option value="TB">TB</option>
                            </select>
                        </div>
                        <div class="form-group pb-3">
                            <button type="button" class="btn remove-cloned"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>    
                </div>
            @endif 
            @foreach ($category_attributes->rams as $ram)
                <div class="cloning-container my-2">
                    <div class="form-group row col-12 justify-content-between">
                        <label for="" class="form-label">Ram</label><small class="mx-1 text-danger"></small>
                        <div class="form-group my-2 pe-0 col-lg-6">
                            <input type="number" name="ramsize[]" class="form-control form-control-sm" value="{{ $ram->ram_size }}">
                        </div>
                        <div class="form-group row my-2 col-lg-6">
                            <select id="" class="form-select form-select-sm" name="ramunit[]">
                                <option value="MB" {{ $ram->ram_size_postfix == 'MB' ? 'selected' : '' }}>MB</option>
                                <option value="GB" {{ $ram->ram_size_postfix == 'GB' ? 'selected' : '' }}>GB</option>
                                <option value="TB" {{ $ram->ram_size_postfix == 'TB' ? 'selected' : '' }}>TB</option>
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