<div class="row content p-0 m-0 d-none" id="conditionTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="conditionForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            {{-- <label for="" class="form-label">{{ $is_edit ? ucwords($category->condition_title) : 'Title' }}</label> --}}
            @if (!empty($category_only))
                <div class="form-group py-2 col-lg-6">
                    <label for="" class="form-label">Condition Title</label><small class="mx-1 text-danger"></small>
                    <input type="text" name="conditiontitle" class="form-control form-control-sm" value="{{ $is_edit ? $category->condition_title : '' }}">
                </div>
            @endif
            <label for="" class="form-label">Add Network</label><small class="mx-1 text-danger"></small>
            @if (!count($category_attributes->conditions))
                <div class="cloning-container my-2">
                    <div class="form-group col-12">
                        <div class="form-group my-2 col-lg-6">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="conditionname[]" class="form-control form-control-sm" value="">
                        </div>
                        <div class="form-group py-2">
                            <label for="" class="form-label">Terms</label>
                            <div class="editor-container" style="">
                                <textarea id="" class="ckeEditor cloned" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group pb-3">
                            <button type="button" class="btn remove-cloned"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>    
                </div>
            @endif
            @foreach ($category_attributes->conditions as $condition)
                <div class="cloning-container my-2">
                    <div class="form-group col-12">
                        <div class="form-group my-2 col-lg-6">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="conditionname[]" class="form-control form-control-sm" value="{{ $condition->condition_name }}">
                        </div>
                        <div class="form-group py-2">
                            <label for="" class="form-label">Terms</label>
                            <div class="editor-container" style="">
                                <textarea id="" class="ckeEditor cloned" name="description">{{ htmlspecialchars_decode($condition->condition_terms) }}</textarea>
                            </div>
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
