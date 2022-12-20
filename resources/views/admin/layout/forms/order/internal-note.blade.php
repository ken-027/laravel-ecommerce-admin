<div class="row content p-0 m-0 d-none" id="internalNoteTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="internalNoteForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Comment</label><small class="mx-1 text-danger"></small>
                <input type="text" name="orderid" hidden value="{{ $order_info->order_id }}">
                <input type="text" name="status" hidden value="{{ $order_info->status_label }}">
                <textarea name="comment" rows="5" class="form-control form-control-sm">{{ $is_edit ? '' : '' }}</textarea>
            </div>
            <div class="form-group pb-3">
                <button type="submit" class="btn add-internal-note" title="Add Comment" data-toggle="tooltip" data-placement="top"><i class="bi bi-journal-plus"></i></button>
            </div>
            <div class="comments-container ">
                @include('admin.layout.forms.order.comment')
            </div>
        </form>
    </div>
</div>