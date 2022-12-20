<div class="container-fluid m-0 p-0 col-12 dialog-form">
    <div class="row m-0 p-0 h-100">
        <div class="col-2 p-0 m-0 h-100">
            <ul class="navbar-nav settings bg-main m-0 p-0 pb-2 h-100 position-relative">
                <li class="">
                    <a class="nav-link px-3 active" data-content="basicTab">
                        <span>Basic</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link px-3" data-content="internalNoteTab">
                        <span>Internal Note</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link px-3" data-content="emailSmsTab">
                        <span>Email/SMS</span>
                    </a>
                </li>
                <li class="">
                    <a class="nav-link px-3" data-content="paymentTab">
                        <span>Payment</span>
                    </a>
                </li>
                {{-- <li class="">
                    <a class="nav-link px-3 active" data-content="metaTab">
                        <span>Meta</span>
                    </a>
                </li> --}}
                <li class="action-button mb-1">
                    <div class="form-group col-12">
                        <div class="col-12 p-1">
                            <button type="submit" class="btn col-12 btn-submit">{{ $is_edit ? 'Update' : 'Save' }}</button>
                        </div>
                        <div class="col-12 p-1">
                            <button type="button" class="btn cancel col-12">Cancel</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-10 tab-content settings px-0 h-100 form-add-edit" id="formAddEdit" style="overflow-x: hidden" data-formtype="{{ $is_edit ? 'edit' : 'add' }}" data-id="{{ $id }}">
            @include('admin.layout.forms.order.basic')
            @include('admin.layout.forms.order.internal-note')
            @include('admin.layout.forms.order.emailsms-history')
            @include('admin.layout.forms.order.payment')
            {{-- @include('admin.layout.forms.order.') --}}
        </div>
    </div>
</div>
