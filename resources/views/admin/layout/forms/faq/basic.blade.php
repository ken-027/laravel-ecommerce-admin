<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Group</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="group">
                    <option value="" {{ !$is_edit ? 'selected' : '' }}>- Select Category -</option>
                    @foreach ($faq_groups as $faq_group) }}
                        <option value="{{ encrypt($faq_group->id) }}" {{ $is_edit ? $faq_group->id == $faq->group_id ? 'selected' : '' : '' }}>{{ $faq_group->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Question</label><small class="mx-1 text-danger"></small>
                <input type="text" name="question" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $faq->title : '' }}">
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Answer</label>
                <div class="editor-container" style="">
                    <textarea id="" class="ckeEditor" name="answer">{{ $is_edit ? htmlspecialchars_decode($faq->description) : '' }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">Publish</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" checked name="publish" {{ $is_edit ? $faq->status ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="publish" {{ $is_edit ? !$faq->status ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">No</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
