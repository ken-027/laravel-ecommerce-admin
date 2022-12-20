<div class="row content p-0 m-0 d-none" id="paymentTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="paymentForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Price Amount</label><small class="mx-1 text-danger"></small>
                <input type="number" name="price" class="form-control form-control-sm" value="{{ $is_edit ? $order_info->payment_paid_amount : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Transaction/Referrence ID</label><small class="mx-1 text-danger"></small>
                <input type="text" name="transactionid" class="form-control form-control-sm" value="{{ $is_edit ? $order_info->transaction_id : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Payment Receipt</label><small class="mx-1 text-danger"></small>
                <input type="text" name="transactionid" class="form-control form-control-sm" value="{{ $is_edit ? $order_info->transaction_id : '' }}">
            </div>
        </form>
    </div>
</div>