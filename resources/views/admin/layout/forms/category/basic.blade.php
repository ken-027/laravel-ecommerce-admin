<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Title</label><small class="mx-1 text-danger"></small>
                <input type="text" name="categorytitle" class="form-control form-control-sm" value="{{ $is_edit ? $category->title : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label class="form-label" for="customFile" class="col-form-label">Model Picture</label><small
                    class="mx-1 text-danger"></small>
                <input type="file" name="icon" class="form-control form-control-sm" id="logoFinder"
                    file="true" />
            </div>
            @if (!empty($category->image) || !$is_edit)
                <div class="form-group col-lg-3 mb-2 mt-0 {{ !$is_edit ? 'd-none':'' }}">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail"><img class="form-control" id="output"
                                alt=" Image display here!"
                                src="{{ $is_edit ? asset('storage/categories/' . base64_encode($category->id) . '/' . $category->image) : '' }}"
                                width="200"></div>
                        <div class="fileupload-preview fileupload-exists fileupload-large flexible thumbnail"></div>
                    </div>
                </div>
            @endif
            <div class="form-group py-2">
                <label for="" class="form-label">Description</label>
                <div class="editor-container" style="">
                    <textarea id="" class="ckeEditor" name="description">{{ $is_edit ? htmlspecialchars_decode($category->description) : '' }}</textarea>
                </div>
            </div>
            {{-- <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Searchable Words (Comma Separated)</label><small class="mx-1 text-danger"></small>
                <textarea name="searchablewords" rows="5" class="form-control form-control-sm">{{ $is_edit ? $category->searchable_words : '' }}</textarea>
            </div> --}}
            <div class="form-group">
                <label for="" class="col-form-label">Publish</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" {{ $is_edit ? $category->published ? 'checked' : '' : 'checked'}} name="publish" />
                        <label class="form-check-label" for="flexRadioDefault1">yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" {{ $is_edit ? !$category->published ? 'checked' : '' : ''}} name="publish" />
                        <label class="form-check-label" for="flexRadioDefault2">No</label>
                    </div>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Attributes</label><small class="mx-1 text-danger"></small>
                <div class="form-group">
                    <input name="attributesnetwork" value="1" type="checkbox" data-id="networkMenu" class="form-check-input attributes-menu" {{  $is_edit ? !empty($category->network_title) ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add Network</label>
                </div>
                <div class="form-group">
                    <input name="attributesstorage" value="1" type="checkbox"  data-id="storageMenu" class="form-check-input attributes-menu" {{  $is_edit ? !empty($category->storage_title) ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add Storage</label>
                </div>
                <div class="form-group">
                    <input name="attributesscreensize" value="1" type="checkbox"  data-id="screenSizeMenu" class="form-check-input attributes-menu" {{  $is_edit ? !empty($category->screen_size_title) ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add Screen Size</label>
                </div>
                <div class="form-group">
                    <input name="attributescasesize" value="1" type="checkbox"  data-id="caseSizeMenu" class="form-check-input attributes-menu" {{  $is_edit ? !empty($category->case_size_title) ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add Case Size</label>
                </div>
                <div class="form-group">
                    <input name="attributestype" value="1" type="checkbox"  data-id="typeMenu" class="form-check-input attributes-menu" {{  $is_edit ? !empty($category->type_title) ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add Type</label>
                </div>
                <div class="form-group">
                    <input name="attributescasematerial" value="1" type="checkbox"  data-id="caseMaterialMenu" class="form-check-input attributes-menu" {{  $is_edit ? !empty($category->case_material_title) ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add Case Material</label>
                </div>
                <div class="form-group">
                    <input name="attributescondition" value="1" type="checkbox" data-id="conditionMenu" class="form-check-input attributes-menu" {{  $is_edit ? !empty($category->condition_title) ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add Condition</label>
                </div>
                <div class="form-group">
                    <input name="attributesprocessor" value="1" type="checkbox"  data-id="processorMenu" class="form-check-input attributes-menu" {{  $is_edit ? !empty($category->processor_title) ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add Processor</label>
                </div>
                <div class="form-group">
                    <input name="attributesram" value="1" type="checkbox"  data-id="ramMenu" class="form-check-input attributes-menu" {{  $is_edit ? !empty($category->ram_title) ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add Ram (Memory)</label>
                </div>
            </div>
        </form>
    </div>
</div>