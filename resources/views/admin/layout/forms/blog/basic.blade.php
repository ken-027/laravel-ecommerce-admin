<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Title</label><small class="mx-1 text-danger"></small>
                <input type="text" name="title" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $blog->postTitle : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label class="form-label" for="customFile" class="col-form-label">Icon</label><small class="mx-1 text-danger"></small>
                <input type="file" name="icon" class="form-control form-control-sm" id="logoFinder" file="true" />
            </div>
            @if (!empty($blog->image) || !$is_edit)
                <div class="form-group col-lg-3 mb-2 mt-0 {{ !$is_edit ? 'd-none':'' }}">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail"><img class="form-control" id="output"
                                src="{{ $is_edit ? asset('/storage/blogs/' . base64_encode($blog->postID) . '/' . $blog->image) : '' }}" width="200" alt="image display here"></div>
                        <div class="fileupload-preview fileupload-exists fileupload-large flexible thumbnail"></div>
                    </div>
                </div>
                {{-- <div class="form-group py-2">
                    <button type="button" class="btn">Remove</button>
                </div> --}}
            @endif
            <div class="form-group">
                <label for="" class="form-label">Content</label>
                <div class="editor-container" style="">
                    <textarea id="ckeBrand" class="ckeEditor" name="content">{{  $is_edit ? htmlspecialchars_decode($blog->postCont) : '' }}</textarea>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Categories</label><small class="mx-1 text-danger"></small>
                @foreach ($blog_categories as $key => $blog_category)
                    <div class="form-group col-lg-6">
                            <input name="categories[{{ encrypt($blog_category->catID) }}]" value="1" type="checkbox" class="form-check-input" 
                            @php
                                if ($is_edit) { 
                                    foreach ($blog_post_categories as $bpc) {
                                        if($bpc->catID == $blog_category->catID) echo 'checked';
                                    }
                                }
                            @endphp />                            
                        {{-- <input name="categories[{{encrypt($blog_category->catID)}}]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $blog_category->catTitle ? 'checked' : '' : ''}} /> --}}
                        <label for="" class="form-check-label">{{ $blog_category->catTitle }}</label>
                    </div>
                @endforeach
            </div>
        </form>
    </div>
</div>
