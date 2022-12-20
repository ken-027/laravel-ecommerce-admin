<div class="row content p-0 m-0" id="invoiceDetailTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="invoiceDetailsForm">
            <div class="form-group py-2">
                <div class="list-group mb-3">
                    <div type="button" class="list-group-item active view-permission">Customer Details</div>
                    <div class="list-group-item text-start">
                        <dl class="row">
                            <dt class="col-sm-4">Name:</dt><dd class="col-sm-8">{{ $order_info->name }}</dd>
                            <dt class="col-sm-4">Address:</dt><dd class="col-sm-8">{{ $order_info->address }}</dd>
                            <dt class="col-sm-4"></dt><dd class="col-sm-8">{{ $order_info->city . ', ' . $order_info->state . ' ' . $order_info->postcode }}</dd>
                            <dt class="col-sm-4">Contact:</dt><dd class="col-sm-8"><a href="mailto:{{ $order_info->email }}?cc=&bcc=&subject=" target="_blank" class="open-link">{{ $order_info->email }}</a></dd>
                        </dl>
                    </div>
                </div>
                <div class="list-group mb-3">
                    <div type="button" class="list-group-item active view-permission">Billing Details</div>
                    <div class="list-group-item text-start">
                        <dl class="row">
                            <dt class="col-sm-4">Total Amount:</dt><dd class="col-sm-8"></dd>
                            <dt class="col-sm-4">Invoice Order ID:</dt><dd class="col-sm-8"></dd>
                            <dt class="col-sm-4">Order Status:</dt><dd class="col-sm-8"></dd>
                            <dt class="col-sm-4">Order Date:</dt><dd class="col-sm-8"></dd>
                            <dt class="col-sm-4">Approved Date:</dt><dd class="col-sm-8"></dd>
                            <dt class="col-sm-4">Due Date:</dt><dd class="col-sm-8"></dd>
                        </dl>
                    </div>
                </div>
                <div class="list-group mb-3">
                    <div type="button" class="list-group-item active view-permission">Payment Details</div>
                    <div class="list-group-item text-start">
                        <dl class="row">
                            <dt class="col-sm-4">Payment Method:</dt><dd class="col-sm-8">{{ $order_info->payment_method }}</dd>
                            @if ($order_info->payment_method == 'Paypal')
                                <dt class="col-sm-4">Paypal Address:</dt><dd class="col-sm-8">{{ $order_info->paypal_address }}</dd>
                            @elseif ($order_info->payment_method == 'Bank')
                                <dt class="col-sm-4">Bank Name:</dt><dd class="col-sm-8">{{ $order_info->bank_name }}</dd>
                                <dt class="col-sm-4">Account Holder Name:</dt><dd class="col-sm-8">{{ $order_info->act_name }}</dd>
                                <dt class="col-sm-4">Account Number:</dt><dd class="col-sm-8">{{ $order_info->act_number }}</dd>
                                <dt class="col-sm-4">Short Code:</dt><dd class="col-sm-8">{{ $order_info->act_short_code }}</dd>
                            @elseif ($order_info->payment_method == 'Check')
                                <dt class="col-sm-4">Name:</dt><dd class="col-sm-8">{{ $order_info->chk_name }}</dd>
                                <dt class="col-sm-4">Address:</dt><dd class="col-sm-8">{{ $order_info->chk_street_address }}</dd>
                            @elseif ($order_info->payment_method == 'Bitcoin')
                                <dt class="col-sm-4">Bitcoin Wallet Address:</dt><dd class="col-sm-8">{{ $order_info->bitcoin_number }}</dd>
                            @elseif ($order_info->payment_method == 'Zelle')
                                <dt class="col-sm-4">Zelle® Email Address:</dt><dd class="col-sm-8">{{ $order_info->zelle_email }}</dd>
                            @elseif ($order_info->payment_method == 'Cash')
                                <dt class="col-sm-4">Name:</dt><dd class="col-sm-8">{{ $order_info->cash_name }}</dd>
                                <dt class="col-sm-4">Phone:</dt><dd class="col-sm-8">{{ $order_info->cash_phone }}</dd>
                                <dt class="col-sm-4">Location:</dt><dd class="col-sm-8">{{ $order_info->cash_location_name }}</dd>
                            @endif
                        </dl>
                    </div>
                </div>
                @if ($order_info->shipping_api == 'easypost' && $order_info->shipment_id)
                    <div class="list-group mb-3">
                        <div type="button" class="list-group-item active view-permission">Shipping Info</div>
                        <div class="list-group-item text-start">
                            <dl class="row">
                                <dt class="col-sm-4">Shipping API:</dt><dd class="col-sm-8">Easy Post</dd>
                                <dt class="col-sm-4">Shipment ID:</dt><dd class="col-sm-8">{{ $order_info->shipment_id }}</dd>
                                <dt class="col-sm-4">Tracing Code:</dt><dd class="col-sm-8">{{ $order_info->shipment_tracking_code }}</dd>
                                <dt class="col-sm-4">Shipment Label:</dt><dd class="col-sm-8"><a class="open-link" href="{{ $order_info->shipment_label_url }}" target="_blank">view</a></dd>
                            </dl>
                        </div>
                    </div>
                @endif
                @if ($order_info->sales_pack == 'pickup' || true)
                    <div class="list-group mb-3">
                        <div type="button" class="list-group-item active view-permission">Pickup Information</div>
                        <div class="list-group-item text-start">
                            <dl class="row">
                                <dt class="col-sm-4">Date:</dt><dd class="col-sm-8">{{ format_date($order_info->pickup_date) }}</dd>
                                <dt class="col-sm-4">Time Slot:</dt><dd class="col-sm-8">{{ format_time($order_info->pickup_time) }}</dd>
                                <dt class="col-sm-4">Address Line1:</dt><dd class="col-sm-8">{{ $order_info->pickup_address }}</dd>
                                <dt class="col-sm-4">Address Line2:</dt><dd class="col-sm-8">{{ $order_info->pickup_address2 }}</dd>
                                <dt class="col-sm-4">City:</dt><dd class="col-sm-8">{{ $order_info->pickup_city }}</dd>
                                <dt class="col-sm-4">State:</dt><dd class="col-sm-8">{{ $order_info->pickup_state }}</dd>
                                <dt class="col-sm-4">Post Code:</dt><dd class="col-sm-8"></dd>
                            </dl>
                            <button class="btn create-shipment" data-id="{{ encrypt($order_info->order_id) }}">Create Shipment</button>
                        </div>
                    </div>
                @endif
                <div class="list-group mb-3">
                    <div type="button" class="list-group-item active view-permission">Tracking Details</div>
                    <div class="list-group-item text-start">
                        <dl class="row">
                            <dt class="col-sm-4">Shipping API:</dt><dd class="col-sm-8">{{ format_datetime($shipment_info->tracker->create_at) }}</dd>
                            <dt class="col-sm-4">Tracing Code:</dt><dd class="col-sm-8">{{ $shipment_info->tracker->tracking_code }}</dd>
                            <dt class="col-sm-4">Est. Delivery Date:</dt><dd class="col-sm-8">{{ format_datetime($shipment_info->tracker->est_delivery_date) }}</dd>
                            <dt class="col-sm-4">Status:</dt><dd class="col-sm-8">{{ $shipment_info->tracker->status }}</dd>
                            <dt class="col-sm-4">Public Url:</dt><dd class="col-sm-8"><a class="open-link" href="{{ $shipment_info->tracker->public_url }}" target="_blank">click here to see</a></dd>
                        </dl>
                    </div>
                </div>
                <div class="list-group mb-3">
                    <div type="button" class="list-group-item active view-permission">Tracking History</div>
                    <div class="list-group-item text-start">
                        <dl class="row track-history">
                            @for ($index = count($shipment_info->tracker->tracking_details) - 1; $index >= 0; $index--)
                                <dt class="col-sm-1"><span class="ball-status {{ $index == count($shipment_info->tracker->tracking_details) - 1 ? 'active' : '' }}"></dt><dd class="col-sm-11 {{ $index == count($shipment_info->tracker->tracking_details) - 1 ? 'active' : '' }}"></span><span class="datetime">| {{ format_datetime($shipment_info->tracker->tracking_details[$index]->datetime) }} |</span> {{ $shipment_info->tracker->tracking_details[$index]->message }}</dd>
                            @endfor
                            {{-- <dt class="col-sm-1"><span class="ball-status active"></dt><dd class="col-sm-11 active"></span><strong class="small">| 07-23-2021 1:38 AM |</strong> Pre-Shipment Info Sent to USPS</dd> --}}
                            {{-- <dt class="col-sm-1"><span class="ball-status"></dt><dd class="col-sm-11"></span><strong class="small">| 07-23-2021 12:38 AM |</strong> Arrived at Post Office CHARLESTON, SC, 29407</dd> --}}
                        </dl>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
