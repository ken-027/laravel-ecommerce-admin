@foreach ($comments as $comment)
    <div class="cloning-container form-group py-2 my-2 col-lg-12">
        <div class="row">
            <label for="" class="col-md-8"><small>{{ format_datetime($comment->date) }}</small><small class="mx-2 note-status">{{ $comment->status }}</small></label>
            <label class="form-label col-md-4 text-end">{{ $comment->username }}</label>
        </div>
        <p class="col-12 p-2 m-0">{{ $comment->comment }}</p>
    </div>
@endforeach