<div class="row content p-0 m-0" id="emailMessageTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="emailMessageForm">
            <div for="" class="h5 mt-2 text-center form-label">{{ $details->subject }}</div>
            <div class="p-2">{!!  htmlspecialchars_decode($details->body) !!}</div>
        </form>
    </div>
</div>
