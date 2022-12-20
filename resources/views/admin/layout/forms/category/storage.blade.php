<div class="row content  p-0 m-0 d-none" id="storageTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="storageForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            @if (!empty($category_only))
                <div class="form-group py-2 col-lg-6">
                    <label for="" class="form-label">Storage Title</label><small class="mx-1 text-danger"></small>
                    <input type="text" name="storagetitle" class="form-control form-control-sm" value="{{ $is_edit ? $category->storage_title : '' }}">
                </div>
                <div class="form-group py-2">
                    <label for="" class="form-label">Storage Tooltip</label>
                    <div class="editor-container" style="">
                        <textarea id="" class="ckeEditor" name="storagetooltip">{{ $is_edit ? htmlspecialchars_decode($category->tooltip_storage) : '' }}</textarea>
                    </div>
                </div>
            @endif
            <label for="" class="form-label">Add Storage</label><small class="mx-1 text-danger"></small>
            @if (!count($category_attributes->storages))
                <div class="cloning-container my-2">
                    <div class="form-group row col-12 justify-content-between">
                        <label for="" class="form-label">Storage</label><small class="mx-1 text-danger"></small>
                        <div class="form-group my-2 pe-0 col-lg-4">
                            <input type="number" name="storagesize[]" class="form-control form-control-sm" value="">
                        </div>

                        <div class="form-group row my-2 col-lg-4">
                            <select id="" class="form-select form-select-sm" name="storageunit[]">
                                <option value="MB" selected>MB</option>
                                <option value="GB">GB</option>
                                <option value="TB">TB</option>
                            </select>
                        </div>
                        <div class="form-group row my-2 col-lg-4">
                            <select id="" class="form-select form-select-sm" name="storagestatus[]">
                                <option value="1" selected>ON</option>
                                <option value="0">OFF</option>
                            </select>
                        </div>
                        <div class="form-group pb-3">
                            <button type="button" class="btn remove-cloned"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>    
                </div>
            @endif
            @foreach ($category_attributes->storages as $storage)
                <div class="cloning-container my-2">
                    <div class="form-group row col-12 justify-content-between">
                        <label for="" class="form-label">Storage</label><small class="mx-1 text-danger"></small>
                        <div class="form-group my-2 pe-0 col-lg-4">
                            <input type="number" name="storagesize[]" class="form-control form-control-sm" value="{{ $storage->storage_size }}">
                        </div>

                        <div class="form-group row my-2 col-lg-4">
                            <select id="" class="form-select form-select-sm" name="storageunit[]">
                                <option value="MB" {{ $storage->storage_size_postfix == 'MB' ? 'selected' : '' }}>MB</option>
                                <option value="GB" {{ $storage->storage_size_postfix == 'GB' ? 'selected' : '' }}>GB</option>
                                <option value="TB" {{ $storage->storage_size_postfix == 'TB' ? 'selected' : '' }}>TB</option>
                            </select>
                        </div>
                        <div class="form-group row my-2 col-lg-4">
                            <select id="" class="form-select form-select-sm" name="storagestatus[]">
                                <option value="1" {{ $storage->top_seller == '1' ? 'selected' : '' }}>ON</option>
                                <option value="0" {{ $storage->top_seller == '0' ? 'selected' : '' }}>OFF</option>
                            </select>
                        </div>
                        <div class="form-group pb-3">
                            <button type="button" class="btn remove-cloned delete-db"><i class="bi bi-trash"></i></button>
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
