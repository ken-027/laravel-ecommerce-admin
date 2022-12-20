<form method="POST" class="form p-2 px-3 position-relative" id="detailsForm">
    <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
    <div class="form-group py-2">
        <div class="h5 text-center">Order ID: {{ $details->char_order_id }}</div>
        {{-- <div class="list-group mb-3">
            <div type="button" class="list-group-item text-start active view-permission">Templates</div>
            <div class="list-group-item text-start"></div>
        </div> --}}
        <div class="list-group mb-3">
            <div type="button" class="list-group-item text-start active view-permission">Staff</div>
            <div class="list-group-item text-start"><strong>Name:</strong> {{ $details->staff_name }}</div>
            <div class="list-group-item text-start"><strong>Email:</strong> {{ $details->staff_email }}</div>
        </div>
        <div class="list-group mb-3">
            <div type="button" class="list-group-item text-start active view-permission">Customer</div>
            <div class="list-group-item text-start"><strong>Name:</strong> {{ $details->customer_name }}</div>
            <div class="list-group-item text-start"><strong>Email:</strong> {{ $details->customer_email }}</div>
            <div class="list-group-item text-start"><strong>Phone:</strong> {{ $details->customer_phone }}</div>
        </div>
        <div class="list-group mb-3">
            <div type="button" class="list-group-item text-start active view-permission">Details</div>
            <div class="list-group-item text-start"><strong>Date:</strong> {{ format_datetime($details->date) }}</div>
            <div class="list-group-item text-start"><strong>Subject:</strong> {{ $details->subject }}</div>
            <div class="list-group-item text-start"><strong>From Email:</strong> {{ $details->from_email }}</div>
            <div class="list-group-item text-start"><strong>To Email:</strong> {{ $details->to_email }}</div>
            <div class="list-group-item text-start"><strong>Phone:</strong> {{ $details->sms_phone }}</div>
            <div class="list-group-item text-start"><strong>Visitor IP:</strong> {{ $details->visitor_ip }}</div>
            <div class="list-group-item text-start"><strong>Lead Source:</strong> {{ $details->leadsource }}</div>
        </div>
    </div>
</form>