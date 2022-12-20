<div class="row content p-0 m-0 d-none" id="pricingTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="storageForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <h1>Underconstruction</h1>
            {{-- <label for="" class="form-label">{{ ucwords($mobile->storage_title) }}</label>
            @foreach ($storage_list as $storage)
                <div class="form-group row cloning-container col-12 justify-content-between">
                    <div class="form-group my-2 pe-0 col-lg-4">
                        <input type="text" name="metatitle" class="form-control form-control-sm" value="{{ $storage->storage_size }}">
                    </div>

                    <div class="form-group row my-2 col-lg-4">
                        <select id="" class="form-select form-select-sm" name="category">
                            <option value="MB" {{ $storage->storage_size_postfix == 'MB' ? 'selected' : '' }}>MB</option>
                            <option value="GB" {{ $storage->storage_size_postfix == 'GB' ? 'selected' : '' }}>GB</option>
                            <option value="TB" {{ $storage->storage_size_postfix == 'TB' ? 'selected' : '' }}>TB</option>
                        </select>
                    </div>
                    <div class="form-group row my-2 col-lg-4">
                        <select id="" class="form-select form-select-sm" name="category">
                            <option value="1" {{ $storage->top_seller ? 'selected' : '' }}>ON</option>
                            <option value="0" {{ !$storage->top_seller ? 'selected' : '' }}>OFF</option>
                        </select>
                    </div>
                    <div class="form-group pb-3">
                        <button type="button" class="btn remove-cloned"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            @endforeach --}}
        </form>
        <div class="form-group py-2 mb-2">
            {{-- <button type="button" class="btn element-clone"><i class="bi bi-plus-square"></i></button> --}}
        </div>
    </div>
</div>
