<div class="row content p-0 m-0 d-none" id="blogSettings">
    <div class="tab-content">   
            {{-- <h3><span class="me-2" style="font-size: 22px"><i class="bi bi-journal-text"></i></span>Blog</h3> --}}
            <form method="POST" class="form col-lg-6 py-1 position-relative" id="blogForm">
                <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
                <div class="form-group py-2">
                    <label for="" class="form-label">excerpt Length (number of words)</label><small class="mx-1 text-danger"></small>
                    <input type="number" class="form-control form-control-sm" value="{{ $setting_info->blog_rm_words_limit }}" name="blogwordslimit">
                </div>
                <div class="form-group">
                    <label for="" class="col-form-label">Display Recent Post</label>
                    <div class="col">
                       <div class="form-check form-check-inline">
                          <input class="form-check-input" value="1" type="radio" name="blogrecentpost" {{ $setting_info->blog_recent_posts ? 'checked' : '' }} />
                          <label class="form-check-label" for="flexRadioDefault1">Show</label>
                       </div>
                       <div class="form-check form-check-inline">
                          <input class="form-check-input" value="0" type="radio" name="blogrecentpost" {{ !$setting_info->blog_recent_posts ? 'checked' : '' }} />
                          <label class="form-check-label" for="flexRadioDefault2">Hide</label>
                       </div>
                     </div>
                 </div>
                 <div class="form-group">
                    <label for="" class="col-form-label">Display Categories</label>
                    <div class="col">
                       <div class="form-check form-check-inline">
                          <input class="form-check-input" value="1" type="radio" name="blogcategories" {{ $setting_info->blog_categories ? 'checked' : '' }} />
                          <label class="form-check-label" for="flexRadioDefault1">Show</label>
                       </div>
                       <div class="form-check form-check-inline">
                          <input class="form-check-input" value="0" type="radio" name="blogcategories" {{ !$setting_info->blog_categories ? 'checked' : '' }} />
                          <label class="form-check-label" for="flexRadioDefault2">Hide</label>
                       </div>
                     </div>
                 </div>
                {{-- <div class="form-group py-2">
                    <button type="submit" class="btn">Update</button>
                </div> --}}
            </form>
    </div>
</div>