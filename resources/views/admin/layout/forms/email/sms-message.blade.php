<div class="row content p-0 m-0" id="emailMessageTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="emailMessageForm">
            <div for="" class="h5 mt-2 text-center form-label">{{ $details->subject }}</div>
            @if (!empty($details->sms_content))
                <div class="p-2 mb-3 sms-content">{!!  htmlspecialchars_decode($details->sms_content) !!}</div>
            @else
                <div class="p-4 mb-3 sms-content text-center">No SMS message</div>
            @endif
        </form>
    </div>
</div>
