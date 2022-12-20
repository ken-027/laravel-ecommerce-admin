<div class="row content p-0 m-0 d-none" id="templatingTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="templatingForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Constant</label><small class="mx-1 text-danger"></small>
                <div class="input-group input-group-sm mb-3">
                    {{-- <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> --}}
                    <select id="codeVariable" class="form-select form-select-sm" name="templatetype">
                        <option value="" {{ !$is_edit ? 'selected' : '' }}>- Select Template -</option>
                        @foreach (mail_templates($email_template)->data as $template) 
                            <option value="{{ $template }}" {{ $is_edit ? $template == $email_template->type ? 'selected' : '' : '' }}>{{ $template }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button id="copy" class="btn" type="button" data-toggle="tooltip" data-placement="top" title="copy to clipboard"><i class="bi bi-clipboard"></i></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Email Content</label>
                <div class="editor-container" style="">
                    <textarea id="ckeBrand" class="ckeEditor" name="emailcontent">{{  $is_edit ? htmlspecialchars_decode($email_template->content) : '' }}</textarea>
                </div>
            </div>
            {{-- <div class="form-group py-2 mb-2">
                <button type="submit" class="btn">Save</button>
                <button type="button" class="btn cancel mx-1">Cancel</button>
            </div> --}}
        </form>
    </div>
</div>
